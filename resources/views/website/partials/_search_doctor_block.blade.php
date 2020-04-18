<div class="doc-item doc-full-dets" data-aos="fade-in">
    <div class="row">
        <div class="col-md-4 col-lg-2">
            <div class="doc-img">
                <img src="{!! asset($doctor->img) !!}">
            </div>
        </div>
        <div class="col-md-8 col-lg-6">
            <div class="doc-dets">
                <h6 class="doc-n">{!! $doctor->name !!}
                    @if($doctor->is_active)
                    <span class="doc-status active"> {{ __('online now')}}</span>
                    @endif
                </h6>
                <div class="doc-s">
                    {!! $doctor->title !!}
                </div>
                <div class="doc-rating">
                    @for($i=1;$i<=5;$i++) <i class="fas fa-star @if ($doctor->ratings->avg('rate')>=$i) active @endif">
                        </i>
                        @endfor
                </div>
                <div class="doc-plus-dets">
                    <div class="doc-price">
                        <ins>{!! $doctor->price !!} {{ __('sr/h')}}</ins>
                        {{--                                                <del>120 sr/h</del>--}}
                    </div>
                    <div class="doc-badges">
                        @foreach($doctor->sub_categories as $sub_category)
                        <span class="badge">{!! $sub_category->name !!}</span>
                        @endforeach
                    </div>
                    <div class="doc-desc">
                        {!! substr($doctor->description,0,49) !!}
                        <a href="{{route('reservation.doctor',$doctor->id)}}" class="link-secondary">
                            {{ __('read more')}}
                        </a>
                    </div>
                </div>
                @if($doctor->available!=null)
                <div class="doc-extra-dets">
                    <div><img src="{{url('design/images/icons/time-date.png')}}"> {{ __('available')}}
                        {{$doctor->available_day->format('d-M')}} </div>
                    <div><img src="{{url('design/images/icons/clock.png')}}"> {{ __('from')}}:
                        {{optional($doctor->available_time['start'] ?? null)->format('H:i')}} {{ __('to')}} :
                        {{optional($doctor->available_time['end']?? null)->format('H:i')}}
                    </div>
                </div>
                @endif
                <div class="doc-controls">
                    <a href="#" class="doc-book-btn btn btn-secondary btn-sm"><img
                            src="{{ url('design/images/icons/phone-White.png')}}">{{ __('quick call')}}
                    </a>
                    <a href="#" class="doc-book-btn btn btn-thirdly btn-sm"><img
                            src="{{ url('design/images/icons/tag.png')}}"> {{ __('book now')}}</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 align-self-center">
            @include('website.partials._weakly_schedule')
        </div>
    </div>


</div>
