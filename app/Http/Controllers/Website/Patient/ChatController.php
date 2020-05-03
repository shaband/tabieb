<?php

namespace App\Http\Controllers\Website\Patient;

use App\Events\Chat\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Website\ChatRequest;
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

    public function inbox($chat_id = null)
    {
        $inbox = $this->repo->PatientInbox()->each(function ($chat) {
            $chat->setRelation('patient', auth()->user());
        });

        $chat = optional($inbox->first())->load('messages');

        if ($chat_id) {
            $chat = $this->repo
                ->with(['patient', 'messages'])
                ->find($chat_id)
                ->setRelation('patient', auth()->user());
        }

        return view('website.chat', [
            'inbox' => $inbox,
            'chat' => $chat,
            'type' => 'doctor'
        ]);
    }

    public function addMessage($id, ChatRequest $request)
    {
        $inputs = $request->all() + [
                'sender_type' => 'patients',
                'sender_id' => auth()->user()->id,
                'chat_id' => $id,
            ];
        $message = $this->repo->saveMessage($inputs);
        MessageSent::dispatch($message->load('sender'), 'patient', true);
        return responseJson([
            'message' => new MessageResource($message)
        ], __("Loaded Successfully"));
    }
}
