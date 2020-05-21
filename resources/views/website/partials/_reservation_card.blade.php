<div class="app-item app-new">
    <div class="app-img"><img src="{!! asset('design/images/app-icon.png') !!}"></div>
    <div class="app-dets">
        <div>

            @if(auth()->user()->getTable()=='patients')
                <b>{{ __('doctor full name')}}:</b>

                <span>
                    {!! $reservation->doctor->name !!}
            </span>
            @elseif(auth()->user()->getTable()=='doctors')
                <b>{{ __('patient full name')}}:</b>
                <span>
                {!! $reservation->patient->name !!}
            </span>
            @endif

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

                <a href="{!! route('doctor.medical-history',$reservation->patient_id) !!}"
                   class="btn btn-outline-secondary btn-sm text-capitalize">{{ __('view medical history')}}</a>

            </div>


        @endif


        @if(\Carbon\Carbon::now()->gt($reservation->from_date))
            <div>
                <b>{{ __('call summary')}}:</b>
                <span>{!! $reservation->doctor->period !!}</span>
            </div>

            {{--    <div class="app-remove"><a><i class="fas fa-trash-alt"></i></a></div>--}}
        @endif
        @if(\Carbon\Carbon::now()->gt($reservation->from_date) &&$reservation->status==$reservation::STATUS_ACTIVE)
            <div class="app-control">
                <a class="btn btn-secondary btn-sm text-capitalize" onclick="
                    Swal.fire({
                    title: '{!! __('Are you sure?') !!}',
                    text: '{!! __('You Will Not be able to revert this!') !!}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{!! __('Yes, Accept it!') !!}'
                    }).then((result) => {
                    if (result.value) {document.getElementById('accept-reservation-{!! $reservation->id !!}').submit();}
                    });event.preventDefault()">{{ __('accept')}}</a>

                <form action="{{ route('doctor.profile.status.update',$reservation->id) }}" method="POST"
                      style="display: none;"
                      id="accept-reservation-{!! $reservation->id !!}">
                    {!! csrf_field() !!}
                    @method('put')
                    <input type="hidden" name="status" value="{!! $reservation::STATUS_ACCEPTED !!}">

                    <a href="{!! route('doctor.medical-history',$reservation->patient_id) !!}"
                       class="btn btn-outline-secondary btn-sm text-capitalize">{{ __('view medical history')}}</a>

                </form>

                <a class="btn btn-danger btn-sm text-capitalize text-white" onclick="
                    Swal.fire({
                    title: '{!! __('Are you sure?') !!}',
                    text: '{!! __('You Will Not be able to revert this!') !!}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{!! __('Yes, Reject it!') !!}'
                    }).then((result) => {
                    if (result.value) {document.getElementById('reject-reservation-{!! $reservation->id !!}').submit();}
                    });event.preventDefault()">{{ __('reject')}}</a>

                <form action="{{ route('doctor.profile.status.update',$reservation->id) }}" method="POST"
                      style="display: none;"
                      id="reject-reservation-{!! $reservation->id !!}">
                    {!! csrf_field() !!}
                    @method('put')
                    <input type="hidden" name="status" value="{!! $reservation::STATUS_REFUSED !!}">
                </form>

                <a href="{!! route('doctor.medical-history',$reservation->patient_id) !!}"
                   class="btn btn-outline-secondary btn-sm text-capitalize">{{ __('view medical history')}}</a>

            </div>
        @endif
    </div>
</div>


