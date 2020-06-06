@if(auth()->guard('doctor')->check() ||auth()->guard('patient')->check())

    <meta name="notification" content="private-App.notifications.{!! $client_type !!}.{{$client_id}}">

    <script>


        var messenger = pusher.subscribe($('meta[name="notification"]').attr('content'));

        messenger.bind('call-refused', function (data) {

            Swal.fire({
                title: 'doctor refused the your call',
                showConfirmButton: false,
                timer: 1500
            })
            setTimeout(function () {
                window.open('', '_self').close()
            }, 1500);


        });
        messenger.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function (data) {

            $('notification-bar').prepend('  <li>\n' +
                '                                    <a href="' + route('{!! $client_type !!}.notifications') + '">' +
                data.html +
                '                                    </a>\n' +
                '                                </li>');

        });

    </script>
@endif
