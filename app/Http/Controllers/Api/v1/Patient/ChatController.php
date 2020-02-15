<?php

namespace App\Http\Controllers\Api\v1\Patient;

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

    public function __construct(ChatRepository $repo)
    {
        $this->repo = $repo;
    }

    public function inbox()
    {
        $chats = $this->repo->makeModel()->with('doctor')->Where('patient_id', auth()->id())->get();

        $chats = ChatResource::collection($chats);
        return responseJson(compact('chats'), __("Loaded Successfully"));
    }

    public function create(Request $request, MessageRepository $messageRepo)
    {
        $this->validate($request, [
            'reservation_id' => 'required|integer|exists:reservations,id,patient_id,' . auth()->id() . ',doctor_id,' . $request->doctor_id,
            'doctor_id' => 'required|integer|exists:doctors,id'
        ]);

        $inputs = $request->all();
        $inputs['patient_id'] = auth()->id();
        $chat = $this->repo->firstOrCreate($inputs);

        $chat = new ChatResource($chat->load('messages', 'doctor'));
        $chat->messages()
            ->where('sender_type', 'doctors')
            ->update(['seen_at' => Carbon::now()]);
        return responseJson(compact('chat'), __("Loaded Successfully"));
    }

    public function addMessage(Request $request, MessageRepository $messageRepo)
    {

        $this->validate($request, [
            'chat_id' => 'required|integer|exists:chats,id,patient_id,' . auth()->id(),
            'message' => 'required|string',
        ]);
        $inputs = $request->all();
        $inputs['sender_type'] = 'patients';
        $inputs['sender_id'] = auth()->id();
        $message = $messageRepo->Create($inputs);
        $message = new MessageResource($message);
        return responseJson(compact('message'), __("Loaded Successfully"));
    }
}
