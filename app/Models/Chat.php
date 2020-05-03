<?php

namespace App\Models;

use App\Repositories\interfaces\ChatRepository;
use App\Traits\ModelHasLogs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use ModelHasLogs;

    protected $table = 'chats';
    public $timestamps = true;
    protected $fillable = array('doctor_id', 'patient_id', 'reservation_id');

    public function messages()
    {
        return $this->hasMany(Message::class)->with('sender');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }


    public function scopeOfDoctor(Builder $builder, $value): void
    {

        $builder->where('doctor_id', $value);

    }

    public function scopeOfPatient(Builder $builder, $value): void
    {

        $builder->where('patient_id', $value);

    }

    public function scopeLastMessage(Builder $builder)
    {
        $builder->AddSelect(
            [
                'last_message' => Message::query()->select('message')
                    ->whereColumn('messages.chat_id', 'chats.id')
                    ->latest()
                    ->limit(1)]);
    }

    public function scopeUnreadCount(Builder $builder)
    {

        $builder->addSelect([
                'unread_count' => Message::query()->selectRaw('count(IF(isnull(seen_at),0,1))')
                    ->whereColumn('messages.chat_id', 'chats.id')
                    ->where('sender_type', '!=', app(ChatRepository::class)->getMorphedAlias((new \ReflectionClass(auth()->user()))->getName()))
            ]
        );
    }
}
