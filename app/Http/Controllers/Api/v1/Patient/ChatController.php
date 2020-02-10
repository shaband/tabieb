<?php

namespace App\Http\Controllers\Api\v1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\Chat\ChatResource;
use App\Repositories\interfaces\ChatRepository;
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
        $chats = $this->repo->model()->Where('patient_id', auth()->id)->get();

        return responseJson(['chats' => ChatResource::collection($chats), __("Loaded Successfully")]);
    }

    public function create(Request $request)
    {
        $chat = $this->repo->create(['doctor_id' => $request->doctor_id, 'reservation_id' => $request->reservation_id])->get();

        return responseJson(['chats' => new ChatResource($chat), __("Loaded Successfully")]);
    }
}
