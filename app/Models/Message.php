<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $table = 'messages';
    public $timestamps = true;
    protected $fillable = array('chat_id', 'message', 'sender', 'seen_at');

    public function chat()
    {
        return $this->belongsTo('Models\Chat');
    }

    public function model()
    {
        return $this->morphTo();
    }

    public function file()
    {
        return $this->morphMany('Models\Attachment')->where('type',3);
    }

}
