<div class="app-item app-new">
    <div class="app-img"><img src="{!! asset('design/images/app-icon.png') !!}"></div>
    <div class="app-dets">
        <div>
            <b>{{ __('doctor full name')}}:</b>
            <span>{!! $reservation->doctor->name !!}</span>
        </div>
        <div>
            <b>{{ __('appointment time')}}:</b>
            <span>{!! $reservation->from_date->diffForHumans() !!}</span>
        </div>
        <div>
            <b>{{ __('appointment way')}}:</b>
            <span>{!! $reservation->communication_type_string !!}</span>
        </div>
        @if(\Carbon\Carbon::now()->between($reservation->from_date,$reservation->to_date))
            <div class="app-control">
                <a href="#" class="btn btn-thirdly btn-sm text-uppercase"><img
                        src="{!! asset('design/images/icons/video-white.png') !!}">{{ __('start call now')}}</a>
            </div>
        @endif

        @if(\Carbon\Carbon::now()->gt($reservation->from_date))
            <div>
                <b>call summary:</b>
                <span>11 hours / 20 minutes / 30 seconds</span>
            </div>
    </div>
    <div class="app-remove"><a><i class="fas fa-trash-alt"></i></a></div>
   @endif
</div>


