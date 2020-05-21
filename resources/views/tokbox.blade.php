<!DOCTYPE html>
<html>

<head>
{{--
https://tokbox.com/developer/sdks/js/reference/Publisher.html
https://tokbox.com/developer/sdks/js/reference/Subscriber.html#events
--}}
    <title> OpenTok Getting Started </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>

        body, html {
            background-color: gray;
            height: 100%;
        }

        #videos {
            position: relative;
            width: 100%;
            height: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        #subscriber {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 10;
        }

        #publisher {
            position: absolute;
            width: 360px;
            height: 240px;
            bottom: 10px;
            left: 10px;
            z-index: 100;
            border: 3px solid white;
            border-radius: 3px;
        }

    </style>
    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>

    <!-- Polyfill for fetch API so that we can fetch the sessionId and token in IE11 -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@7/dist/polyfill.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fetch/2.0.3/fetch.min.js" charset="utf-8"></script>
</head>

<body>

<div id="videos">
    <div id="subscriber"></div>
    <div id="publisher"></div>
</div>

<script>
    /* eslint-disable no-unused-vars */
    // Make a copy of this file and save it as config.js (in the js directory).

    // Set this to the base URL of your sample server, such as 'https://your-app-name.herokuapp.com'.
    // Do not include the trailing slash. See the README for more information:

    var SAMPLE_SERVER_BASE_URL = '{!! url('/') !!}';

    // OR, if you have not set up a web server that runs the learning-opentok-php code,
    // set these values to OpenTok API key, a valid session ID, and a token for the session.
    // For test purposes, you can obtain these from https://tokbox.com/account.

    var API_KEY = '{!!config('services.tokbox.key') !!}';
    var SESSION_ID = '{!! $sessionId !!}';
    var TOKEN = '{!! $token !!}';


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
                name: 'aaa',
                style: {
                    nameDisplayMode: "on",
                    buttonDisplayMode: 'on',
                    audioBlockedDisplayMode: "on"
                }

            };
            console.log('heere');
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
            name: 'wwww',

            style: {
                nameDisplayMode: "on",
                buttonDisplayMode: 'on',
                audioBlockedDisplayMode: "on",
            }

        };
        publisher = OT.initPublisher('publisher', publisherOptions, handleError);
        console.log('wwwwwwwww');
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
    } else if (SAMPLE_SERVER_BASE_URL) {
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


</script>

<script type="text/javascript" src="js/app.js"></script>
</body>

</html>
