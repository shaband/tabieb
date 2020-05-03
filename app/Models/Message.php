<?php

namespace App\Models;

use App\Traits\ModelHasLogs;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use  ModelHasLogs;

    protected $table = 'messages';
    public $timestamps = true;
    protected $fillable = array('chat_id', 'message', 'sender_type', 'sender_id', 'seen_at');

    protected $dates = ['seen_at'];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function sender()
    {
        return $this->morphTo();
    }

    public function file()
    {
        return $this->morphOne(Attachment::class, 'model')->where('type', 3);
    }



}
