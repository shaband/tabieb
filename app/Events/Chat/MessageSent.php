<?php

namespace App\Events\Chat;

use App\Models\Message;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $msg_html;
    /**
     * @var string|null
     */
    private $type;
    private $chat_id;

    /**
     * MessageSent constructor.
     * @param Message $message
     * @param string $type
     * @param bool $include_html
     * @throws \Throwable
     */
    public function __construct(Message $message, string $type = null, bool $include_html = false)
    {

        $this->chat_id = $message->chat_id;

        if (!$include_html) {
            $this->message = $message;
        } elseif ($include_html) {
            $this->msg_html = view('website.partials._chat_message',
                [
                    'message' => $message,
                    'type' => $type
                ])->render();
        }

    }

    public function broadcastOn()
    {
        return new PrivateChannel('App.chat.' . $this->chat_id);
    }

    public function broadcastAs()
    {
        return 'new-message';
    }
}
