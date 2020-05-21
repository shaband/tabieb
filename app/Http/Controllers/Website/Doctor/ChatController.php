<?php

namespace App\Http\Controllers\Website\Doctor;

use App\Events\Chat\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Website\ChatRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\Chat\MessageResource;
use App\Models\Attachment;
use App\Repositories\interfaces\ChatRepository;
use App\Repositories\interfaces\MessageRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public $repo;

    public function __construct(ChatRepository $repo)
    {
        $this->repo = $repo;
    }

    public function inbox($chat_id = null)
    {
        $inbox = $this->repo->DoctorInbox()->each(function ($chat) {
            $chat->setRelation('doctor', auth()->user());
        });

        return view('website.chat', [
            'inbox' => $inbox,
            'chat' => $this->repo->getSelectedOrFirst($inbox, $chat_id),
            'type' => 'doctor'
        ]);
    }

    public function addMessage($id, ChatRequest $request, MessageRepository $messageRepo)
    {
        $inputs = $request->all() + [
                'sender_type' => 'doctors',
                'sender_id' => auth()->user()->id,
                'chat_id' => $id,
            ];
        $message = $this->repo->saveMessage($inputs);
        return responseJson([
            'message' => new MessageResource($message)
        ], __("Loaded Successfully"));
    }
}
