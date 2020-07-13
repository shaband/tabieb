@extends('website.layouts.app')

@section('title')
    {!! __("Notifications") !!}
@endsection
@section('content')
    @include('website.partials._title_section')
    <!-- START Main Content -->
    <section class="main-content">
        <div id="notifications-pg" class="py-5 bg-greyColor6">
            <!-- START Contact Block -->
            <div class="container">
                @foreach($notifications as $notification)
                    <div class="doc-single-about doc-single-blk" data-aos="fade-in">
                        <a href="{!!$notification->data['url']??'#' !!}">
                            {!!  $notification->data['html']??null !!}
                        </a>
                    </div>
                @endforeach
            </div>
            <!-- END Contact Block -->
        </div>
    </section>
    <!-- END Main Content -->
@endsection
