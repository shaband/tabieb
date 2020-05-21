<?php

namespace App\Repositories\SQL;

use App\Events\Chat\MessageSent;
use App\Models\Attachment;
use App\Models\Message;
use App\Repositories\interfaces\MessageRepository;
use App\Repositories\SQL\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\ChatRepository;
use App\Models\Chat;

// use App\Validators\ChatValidator;

/**
 * Class ChatRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class ChatRepositoryEloquent extends BaseRepository implements ChatRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Chat::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function DoctorInbox()
    {
        return $this->query()
            ->lastMessage()
            ->unreadCount()
            ->ofDoctor(auth()->id())
            ->with('patient')
            ->get();
    }

    public function PatientInbox()
    {
        return $this->query()
            ->lastMessage()
            ->unreadCount()
            ->ofPatient(auth()->id())
            ->with('doctor')
            ->get();
    }


    public function getSelectedOrFirst($chats, ?int $chat_id = null)
    {
        if ($chat_id) {
            $chat = $this->with(['patient',
                'messages' => function (Builder $message) {
                    $message->with('sender');
                }, 'doctor'])
                ->find($chat_id)
                ->setRelation('doctor', auth()->user());
        } else {
            $chat = optional($chats->first())->load('messages');
        }

        return $chat;

    }


    public function saveMessage(array $inputs)
    {

        DB::beginTransaction();
        $message = app(MessageRepository::class)->Create($inputs);
        if (isset($inputs['file'])) {
            $this->saveMessageFile($message, $inputs['file']);
        }
        DB::commit();
        MessageSent::dispatch($message->load('sender'));

        return $message;
    }


    public function saveMessageFile(Message &$message, UploadedFile $file)
    {
        $file_data = $this->saveFile($file, "chat/" . $message->chat_id . "/messages/" . $message->id . '/', Attachment::MESSAGE_FILE);
        $file = $message->file()->Create($file_data);
        $message->setRelation('file', $file);
    }
}

