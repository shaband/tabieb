    <meta name="channel" content="private-App.chat.{{$chat->id}}">

<script>


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
