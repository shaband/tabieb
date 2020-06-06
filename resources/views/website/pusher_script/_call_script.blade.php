@if(auth()->guard('doctor')->check() )
    <meta name="calls" content="private-App.calls.{!! $client_type !!}.{{$client_id}}">


    <script>

        var call_channel = $('meta[name="calls"]').attr('content')
        var calls = pusher.subscribe(call_channel);
        calls.bind('new-call', function (data) {
            var audio = new Audio('{{url('tokbox/ring.mp3')}}');
            audio.play();
            Swal.fire({
                //       position: 'top-end',
                icon: 'info',
                title: data.reservation.patient.name + '{{ __ (' is calling')}}',
                showConfirmButton: true,
                timer: 1000 * 29,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: true,
                confirmButtonText:
                    '{{ __('Accept')}}!',
                cancelButtonText:
                    '{{ __('Refuse')}}',
            }).then((result) => {
                audio.pause();
                audio.currentTime = 0;
                var status = 4;
                if (result.value) {
                    status = 2;
                }
                $.ajax({
                    method: 'get',
                    url: route('quick-call.respond'),
                    data: {
                        status: status,
                        reservation_id: data.reservation.id,
                    },
                    success: function (data) {
                        if (status === 2) {
                            window.open(route('quick-call.accept', {
                                reservation_id: data.id,
                            }), '_blank')
                        }

                    }
                })

            })
        });


        function autoLogIn(reservation_id) {
            var form = document.createElement("form");
            var reservation = document.createElement("input");

            form.method = "POST";
            form.action = route('quick-call.respond');
            form.target = "_blank"

            token.value = $('meta[name="csrf-token"]').attr('content');
            token.name = "_token";
            form.appendChild(token);

            reservation.value = reservation_id;
            reservation.name = "reservation_id";
            form.appendChild(reservation);

            document.body.appendChild(form);

            form.submit();
        }
    </script>
@endif
