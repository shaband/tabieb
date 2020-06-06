@extends('website.layouts.app')

@push('meta')
    <meta name="authEndpoint" content="{{url($type.'/broadcasting/auth')}}">
    <meta name="channel" content="private-App.chat.{{$chat->id}}">

@endpush

@push('header')
    <style>
        input.star {
            display: none;
        }

        label.star {
            float: right;
            padding: 10px;
            font-size: 36px;
            color: #444;
            transition: all .2s;
        }

        input.star:checked ~ label.star:before {
            content: '\f005';
            color: #FD4;
            transition: all .25s;
        }


        input.star-5:checked ~ label.star:before {
            color: #FE7;
            text-shadow: 0 0 20px #952;
        }

        input.star-1:checked ~ label.star:before {
            color: #F62;
        }

        label.star:hover {
            transform: rotate(-15deg) scale(1.3);
        }

        label.star:before {
            content: '\f005';
            font-family: Font Awesome 5 Free;
        }


        label.review {
            display: block;
            transition: opacity .25s;
        }


        input.star:checked ~ .rev-box {
            height: 125px;
            overflow: visible;
        }
    </style>

    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
@endpush
@section('title')
    {!! __("Chat") !!}
@endsection

@section('content')
    @include('website.partials._title_section')
    <!-- background-color: #f3fffb; -->
    <div id="call-pg">
        <div class="container">
            <div id="call-container hidden-chat">
                <div class="call-inner-container">
                    <!-- <div class="row">
                                <div class="col-md-8"> -->
                    <div class="call-blk">
                        <div class="call-header">
                            <a id="toggle-fs" class="call-icon btn"><i class="fas fa-compress"></i></a>
                        </div>
                        <div class="call-body">
                            <div id="subscriber" class="call-wrapper">
                                {{--     <img src="images/doc-02.png">
                                             --}}</div>
                            <div id="publisher" class="transmitter-wrapper">
                                {{--         <img src="images/doc-03.png">
                                         --}} </div>
                        </div>
                        <div class="call-footer">
                            <a id="microphone" class="call-icon btn" onClick="toggleAudio()">
                                <i class="fas fa-microphone-alt aval"></i>
                                <i class="fas fa-microphone-alt-slash unaval"></i>
                            </a>
                            <a id="camera" class="call-icon btn" onClick="toggleCamera()">
                                <i class="fas fa-video aval"></i>
                                <i class="fas fa-video-slash unaval"></i>
                            </a>
                            {{-- <a id="toggle-chat" class="call-icon btn">
                                     <i class="fas fa-comment aval"></i>
                                     <i class="fas fa-comment-slash unaval"></i>
                                 </a>--}}
                            <a id="finish-class" class="call-icon btn btn-danger" onclick="finishCall()"><i
                                    class="fas fa-phone"></i></a>
                        </div>
                    </div>
                    <!-- </div>
                                <div class="col-md-4"> -->
                {{--         <div class="chat-blk">
                             <div class="chat-header">
                                 <div class="recipient-data">
                                     <img class="usr-ico" src="images/doc-02.png">
                                     <div class="rec-tit">
                                         <h6>user name 1</h6>
                                         <div class="usr-status active">available</div>
                                     </div>
                                 </div>
                                 <div class="chat-close">
                                     <a id="hide-chat"><i class="fas fa-times"></i></a>
                                 </div>
                             </div>
                             <div class="chat-body">
                                 <div class="chat-item">
                                     <img class="usr-ico" src="images/doc-03.png">
                                     <div class="chat-item-dets">
                                         <h6>user name 2</h6>
                                         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                     </div>
                                 </div>
                                 <div class="chat-item">
                                     <img class="usr-ico" src="images/doc-03.png">
                                     <div class="chat-item-dets">
                                         <h6>user name 1</h6>
                                         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit
                                             amet
                                             consectetur adipisicing elit.</p>
                                     </div>
                                 </div>
                                 <div class="chat-item">
                                     <img class="usr-ico" src="images/doc-03.png">
                                     <div class="chat-item-dets">
                                         <h6>user name 2</h6>
                                         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                     </div>
                                 </div>
                                 <div class="chat-item">
                                     <img class="usr-ico" src="images/doc-03.png">
                                     <div class="chat-item-dets">
                                         <h6>user name 1</h6>
                                         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit
                                             amet
                                             consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing
                                             elit.</p>
                                     </div>
                                 </div>
                                 <div class="chat-item">
                                     <img class="usr-ico" src="images/doc-03.png">
                                     <div class="chat-item-dets">
                                         <h6>user name 1</h6>
                                         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit
                                             amet
                                             consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing
                                             elit.</p>
                                     </div>
                                 </div>
                                 <div class="chat-item">
                                     <img class="usr-ico" src="images/doc-03.png">
                                     <div class="chat-item-dets">
                                         <h6>user name 1</h6>
                                         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit
                                             amet
                                             consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing
                                             elit.</p>
                                     </div>
                                 </div>
                             </div>
                             <div class="chat-footer">
                                 <form>
                                     <input class="form-control" placeholder="write your message...">
                                 </form>
                             </div>
                         </div>
                --}}
                <!-- </div>
                        </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Main Content -->
    @if($client_type=='patient')
        <!-- Modal -->

        <div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            {!! Form::open(['method'=>'post','route'=>['patient.reservation.rate',$reservation->id]]) !!}
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Rate Reservation')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center flex-row-reverse">
                            <input class="star star-5" id="star-5-2" type="radio" value="5" name="rate"/>
                            <label class="star star-5 fas fa-star" for="star-5-2"></label>
                            <input class="star star-4 " id="star-4-2" type="radio" value="4" name="rate"/>
                            <label class="star star-4 fas fa-star" for="star-4-2"></label>
                            <input class="star star-3 " id="star-3-2" type="radio" value="3" name="rate"/>
                            <label class="star star-3 fas fa-star" for="star-3-2"></label>
                            <input class="star star-2 " id="star-2-2" type="radio" value="2" name="rate"/>
                            <label class="star star-2 fas fa-star" for="star-2-2"></label>
                            <input class="star star-1" id="star-1-2" type="radio" value="1" name="rate"/>
                            <label class="star star-1 fas fa-star" for="star-1-2"></label>
                        </div>
                        <div {{--class="rev-box"--}}>
                            <textarea class="{{--review--}} form-control" name="description"
                                      placeholder="{!! __("Enter Your Notes") !!}"></textarea>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                        <button type="submit" class="btn btn-success">{{ __("Add Rate")}}</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        /* //chat
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

             //end chat*/
        var client_type = '{{$client_type}}';
        var API_KEY = '{!!config('services.tokbox.key') !!}';
        var SESSION_ID = '{!! $sessionId !!}';
        var TOKEN = '{!! $token !!}';
        var callAudio = true;
        var callVideo = true;
        var session, publisher, sub;

        function handleError(error) {
            if (error) {
                console.error(error);
            }
        }


        function initializeSession() {
            session = OT.initSession(apiKey, sessionId);

            // Subscribe to a newly created stream
            session.on('streamCreated', function streamCreated(event) {
                var subscriberOptions = {
                    insertMode: 'append',
                    width: '100%',
                    height: '100%',
                    //           subscribeToAudio: true,
                    // convert to false for audio calls
                    //   subscribeToVideo:true

                };
                sub = session.subscribe(event.stream, 'subscriber', subscriberOptions, handleError);

                sub.on('disconnected destroyed', function ($e) {

                })
            });

            session.on('sessionDisconnected', function sessionDisconnected(event) {
                // debugger;
                redirectionAfterEnd()

                console.log('You were disconnected from the session.', event.reason);
            });

            session.on("c~onnectionDestroyed", function (event) {
                redirectionAfterEnd()
            });
            // initialize the publisher
            var publisherOptions = {
                insertMode: 'append',
                width: '100%',
                height: '100%',
                // convert to false for audio calls
                videoSource: true,
            };
            publisher = OT.initPublisher('publisher', publisherOptions, handleError);
            // Connect to the session
            session.connect(token, function callback(error) {
                if (error) {
                    handleError(error);
                } else {
                    // If the connection is successful, publish the publisher to the session
                    session.publish(publisher, handleError);
                }
            });
        }


        // See the config.js file.
        if (API_KEY && TOKEN && SESSION_ID) {
            apiKey = API_KEY;
            sessionId = SESSION_ID;
            token = TOKEN;
            initializeSession();
        }


        function toggleAudio() {
            callAudio = !callAudio;
            publisher.publishAudio(callVideo)
        }

        function toggleCamera() {
            callVideo = !callVideo;
            publisher.publishVideo(callVideo)
        }

        function finishCall() {
            session.disconnect();
        }


        function redirectionAfterEnd() {
            if (client_type === 'doctor') {
                window.location.replace(route('doctor.prescription.create',{!! $reservation->id !!}));
            } else {
                $("#ratingModal").modal('toggle')
            }


        }
    </script>

@endpush
