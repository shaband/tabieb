<div class="notif-item">
    <div class="notif-icon"><img
            src="{!! $image !!}"></div>
    <div class="notif-dets">
        <p>{!! $Message !!} <span></span>

        </p>
        <p><i class="far fa-clock"></i> {!!$date->diffForHumans() !!}</p>
    </div>
</div>
