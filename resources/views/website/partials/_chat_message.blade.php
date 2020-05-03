
<div class="inbox-msg-item
                                            @if($type=='doctor' && $message->sender_type=='doctors')
    msg-sent
@else
    msg-received
@endif
    ">
    <div class="inbox-msg-user-img">
        <img src="{!! asset($message->sender->img) !!}">
    </div>
    <div class="inb0x-msg-dets">
        <div class="inbox-msg-txt">{!! $message->message !!}
        </div>
        <div
            class="inbox-msg-time">{!! $message->created_at->diffForHumans() !!}</div>
    </div>
</div>
