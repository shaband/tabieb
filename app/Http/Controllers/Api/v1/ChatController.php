<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\Chat\MessageResource;
use App\Repositories\interfaces\ChatRepository;
use App\Repositories\interfaces\MessageRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public $repo;
    public $sender_type = 'patients';
    public $other_type = 'doctors';
    public $auth_column = 'patient_id';

    public function __construct(ChatRepository $repo)
    {
        $this->repo = $repo;
    }

    public function inbox()
    {
        $chats = $this->repo->with('doctor')->Where($this->auth_column, auth()->id())->get();

        $chats = ChatResource::collection($chats);
        return responseJson(compact('chats'), __("Loaded Successfully"));
    }

    public function create(Request $request, MessageRepository $messageRepo)
    {
        $this->validate($request, static::ChatValidation());

        $inputs = $request->all();
        $inputs[$this->auth_column] = auth()->id();
        $chat = $this->repo->firstOrCreate($inputs);

        $chat = new ChatResource($chat->load('messages', 'doctor'));
        $chat->messages()
            ->where('sender_type', $this->other_type)
            ->update(['seen_at' => Carbon::now()]);
        return responseJson(compact('chat'), __("Loaded Successfully"));
    }

    public function addMessage(Request $request, MessageRepository $messageRepo)
    {

        $this->validate($request, static::MessageValidation());
        $inputs = $request->all();
        $inputs['sender_type'] = $this->sender_type;
        $inputs['sender_id'] = auth()->id();
        $message = $messageRepo->Create($inputs);
        $message = new MessageResource($message);
        return responseJson(compact('message'), __("Loaded Successfully"));
    }

    public static function ChatValidation(): array
    {
        return [
            'reservation_id' => "required|integer|exists:reservations,id," . app(static::class)->auth_column . "," . auth()->id() . ',doctor_id,' . \request()->doctor_id,
            'doctor_id' => 'required|integer|exists:doctors,id'

        ];
    }

    public static function MessageValidation(): array
    {
        return [
            [
                'chat_id' => 'required|integer|exists:chats,id,' . app(static::class)->auth_column . ',' . auth()->id(),
                'message' => 'required|string',
            ]
        ];
    }
}
