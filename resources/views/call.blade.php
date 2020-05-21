@extends('website.layouts.app')

@push('meta')
    <meta name="authEndpoint" content="{{url($type.'/broadcasting/auth')}}">
    <meta name="channel" content="private-App.chat.{{$chat->id}}">

@endpush

@push('header')

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
            <div id="call-container">
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
                            <a id="toggle-chat" class="call-icon btn">
                                <i class="fas fa-comment aval"></i>
                                <i class="fas fa-comment-slash unaval"></i>
                            </a>
                            <a id="finish-class" class="call-icon btn btn-danger"><i class="fas fa-phone"></i></a>
                        </div>
                    </div>
                    <!-- </div>
                            <div class="col-md-4"> -->
                    <div class="chat-blk">
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
                    <!-- </div>
                        </div> -->
                </div>
            </div>
        </div>
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

  /*      var pusher = new Pusher($('meta[name="pusher-key"]').attr('content'), {
            cluster: 'eu',
            authEndpoint: $('meta[name="authEndpoint"]').attr('content'),
            auth: {
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            }
        });


        var channel = pusher.subscribe($('meta[name="channel"]').attr('content'));

        channel.bind('new-message', function (data) {
            var type = '{{$type}}';
            if (data.message['sender_type'] !== type + 's') {
                var msg = data['msg_html'].replace('msg-sent', 'msg-received')
            }
            $('.inbox-msgs-container').append(msg);
            $('.inbox-msgs-body').scrollTop(999999999)
        });

*/
        /* eslint-disable no-unused-vars */
        // Make a copy of this file and save it as config.js (in the js directory).

        // Set this to the base URL of your sample server, such as 'https://your-app-name.herokuapp.com'.
        // Do not include the trailing slash. See the README for more information:


        // OR, if you have not set up a web server that runs the learning-opentok-php code,
        // set these values to OpenTok API key, a valid session ID, and a token for the session.
        // For test purposes, you can obtain these from https://tokbox.com/account.

        var API_KEY = '{!!config('services.tokbox.key') !!}';
        var SESSION_ID = '{!! $sessionId !!}';
        var TOKEN = '{!! $token !!}';
        var callAudio = true;
        var callVideo = true;

        function handleError(error) {
            if (error) {
                console.error(error);
            }
        }

        var session;

        var publisher;
        var sub;

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
            });

            session.on('sessionDisconnected', function sessionDisconnected(event) {
                console.log('You were disconnected from the session.', event.reason);
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

        /*  else if (SAMPLE_SERVER_BASE_URL) {
            // Make an Ajax request to get the OpenTok API key, session ID, and token from the server
            fetch(SAMPLE_SERVER_BASE_URL + '/session').then(function fetch(res) {
                return res.json();
            }).then(function fetchJson(json) {
                apiKey = json.apiKey;
                sessionId = json.sessionId;
                token = json.token;

                initializeSession();
            }).catch(function catchErr(error) {
                handleError(error);
                alert('Failed to get opentok sessionId and token. Make sure you have updated the config.js file.');
            });
        }
     */


        function toggleAudio() {
            callAudio = !callAudio;

            publisher.publishAudio(callVideo)
        }

        function toggleCamera() {
            callVideo = !callVideo;

            publisher.publishAudio(callVideo)
        }

    </script>

@endpush
