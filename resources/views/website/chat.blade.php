@extends('website.layouts.app')

@push('meta')
    <meta name="channel" content="private-App.chat.{{optional($chat)->id}}">
@endpush

@section('title')
    {!! __("Chat") !!}
@endsection

@section('content')
    @include('website.partials._title_section')


    <!-- START Main Content -->
    <section class="main-content">
        <div id="chat-pg" class="py-5 bg-greyColor6">
            <!-- START Contact Block -->
            <div class="container">
                <div class="doc-single-about doc-single-blk" data-aos="fade-in">
                    <div class="row">
                        <div class="col-md-4">
                            <!-- START Inbox Chats -->
                            <div class="inbox-chats">
                                <!-- START Chat Search -->
                            {{--   <div class="inbox-chats-search">
                                   <form class="basic-form form-label-inline">
                                       <div class="form-group m-0">
                                           <label><i class="fas fa-search"></i></label>
                                           <input type="text" placeholder="search here..." class="form-control">
                                       </div>
                                   </form>
                               </div>--}}
                            <!-- END Chat Search -->
                                <!-- START Chats Container -->
                                <div class="inbox-chats-container">
                                @foreach($inbox as $item )

                                    <!-- START Chat Item -->
                                        <a
                                            href="{{route("$type.chat.inbox",$item->id)}}"
                                            class="inbox-chat-item
                                        @if($type=='doctor'&& auth()->guard('doctor')->check()) {!! $item->patient->isOnline()?'active':null!!} @else {!! $item->doctor->isOnline()?'active':null!!} @endif ">

                                            <div class="inbox-chat-user-img">
                                                @if($type=='doctor'&& auth()->guard('doctor')->check())
                                                    <img class="w-100 h-100"
                                                         src="{{asset(optional($item->patient)->img)}}">
                                                @else
                                                    <img class="w-100 h-100"
                                                         src="{{asset(optional($item->doctor)->img)}}">

                                                @endif
                                            </div>

                                            <div class="inbox-chat-user-text">
                                                @if($type=='doctor'&&  auth()->guard('doctor')->check())
                                                    <h6 class="text-capitalize mb-1 font-weight-bold">
                                                        {{$item->patient->name}}
                                                    </h6>
                                                @else
                                                    <h6 class="text-capitalize mb-1 font-weight-bold">
                                                        {{$item->doctor->name}}
                                                    </h6>
                                                @endif

                                                <p class="m-0">{{substr($item->last_message,0,382)}}</p>
                                            </div>
                                        </a>
                                        <!-- END Chat Item -->
                                    @endforeach

                                </div>
                                <!-- END Chats Container -->
                            </div>
                            <!-- END Inbox Chats -->
                        </div>
                        <div class="col-md-8">
                            <!-- START Inbox Chat Messages -->
                       @if(!is_null($chat))
                            <div class="inbox-msgs">
                                <!-- START Inbox Messages Header -->
                                <div class="inbox-msgs-header
                                    @if($type=='doctor'&& auth()->guard('doctor')->check())
                                {!! $chat->patient->isOnline()?'active':null!!}

                                @else
                                {!! $chat->doctor->isOnline()?'active':null!!}
                                @endif
                                    ">
                                    <div class="back-control">
                                        <a class="back-to-chats btn btn-thirdly btn-sm" href="javascript:void(0)"><i
                                                class="fas fa-arrow-left"></i></a>
                                    </div>
                                    <div class="inbox-chat-user-img">
                                        @if( $type=='doctor'&&  auth()->guard('doctor')->check())
                                            <img class="w-100 h-100"
                                                 src="{{asset(optional($chat->patient)->img)}}">
                                        @else
                                            <img class="w-100 h-100"
                                                 src="{{asset(optional($chat->doctor)->img)}}">

                                        @endif
                                    </div>
                                    <div class="inbox-msgs-user-name">

                                        @if( $type=='doctor'&&  auth()->guard('doctor')->check())
                                            <h6 class="text-capitalize mb-1 font-weight-bold">
                                                {{$chat->patient->name}}
                                            </h6>
                                        @else
                                            <h6 class="text-capitalize mb-1 font-weight-bold">
                                                {{$chat->doctor->name}}
                                            </h6>
                                        @endif
                                        @if($type=='doctor'&& auth()->guard('doctor')->check())
                                            {!! $item->patient->isOnline()?'active':null!!}

                                        @else
                                            {!! $item->doctor->isOnline()?'active':null!!}
                                        @endif


                                        <p class="m-0 font-reg-sm text-light">active now</p>
                                    </div>
                                </div>
                                <!-- END Inbox Messages Header -->
                                <!-- START Inbox Messages Body -->
                                <div class="inbox-msgs-body">
                                    <!-- START Inbox Messages Container -->
                                    <div class="inbox-msgs-container">
                                        @foreach($chat->messages as $message)

                                            @include('website.partials._chat_message')                                        @endforeach

                                    </div>
                                    <!-- END Inbox Messages Container -->
                                </div>
                                <!-- END Inbox Messages Body -->
                                <!-- START Inbox Messages Footer -->
                                <div class="inbox-msgs-footer">
                                    <div class="uploads"></div>
                                    <form id="message-form" enctype="multipart/form-data" class="basic-form"
                                          method="post"
                                          action="{!! route($type.'.chat.message',$chat->id) !!}">
                                        {!! csrf_field() !!}

                                        <div class="form-group m-0">
                                            <input type="text" class="msg-input form-control w-100"
                                                   name="message"
                                                   placeholder="{{ __('write your message here...')}}">
                                        </div>
                                        <div class="msg-send-controls">
                                            {{--    <div class="msg-send-upload">
                                                    <input name="image" type="file" id="upload-attach">
                                                    <label for="upload-attach" title="Upload File"><img
                                                            src="{{asset('design/images/icons/attach.png')}}"></label>
                                                </div>
                                            --}}
                                            <button type="submit" title="send" class="btn p-0"><img
                                                    src="{{asset('design/images/icons/send.png')}}"></button>
                                        </div>
                                    </form>
                                </div>
                                <!-- END Inbox Messages Body -->
                            </div>
                            <!-- END Inbox Chat Messages -->
                            @else
                           <h3 class="red"> {!! __("There is No Chats") !!}</h3>
                           @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Contact Block -->
        </div>
    </section>
    <!-- END Main Content -->

@endsection

@push('scripts')
    <script>
        $('form').submit(function (e) {
            e.preventDefault(); // prevents page reloading
            var form = $('#message-form');
            var data = new FormData(form[0])

            $.ajax({
                method: 'POST',
                url: form.attr('action'),
                cache: false,
                contentType: false,
                data: data,
                processData: false,
                enctype: 'multipart/form-data',
                success: function (data) {

                    $('input[name="message"]').val('');
                    var file_input = $('input[name="image"]')
                    file_input.replaceWith(file_input.val('').clone(true));
                },
                fail: function (err) {
                }
            })
            return false;
        });


        var messenger = pusher.subscribe($('meta[name="channel"]').attr('content'));

        messenger.bind('new-message', function (data) {
            var type = '{{$type}}';
            if (data.message['sender_type'] !== type + 's') {
                var msg = data['msg_html'].replace('msg-sent', 'msg-received')
            }
            $('.inbox-msgs-container').append(msg);
            $('.inbox-msgs-body').scrollTop(999999999)
        });

    </script>
@endpush
