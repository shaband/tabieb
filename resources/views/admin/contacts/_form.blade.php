{{--'name', 'email', 'model_id', 'model_type', 'subject', 'message', 'seen_at', 'seen_by', 'reply'--}}
<div class="form-group">
    <label for="name">{!! __("Name") !!} *</label>
    {!! Form::text('name',null,['class'=>'form-control','id'=>'name','disabled']) !!}
</div>

<div class="form-group">
    <label for="email">{!! __("Email") !!} *</label>
    {!! Form::text('email',null,['class'=>'form-control','id'=>'email','disabled']) !!}
</div>
<div class="form-group">
    <label for="subject">{!! __("Subject") !!} *</label>
    {!! Form::text('subject',null,['class'=>'form-control','id'=>'subject','disabled']) !!}
</div>
<div class="form-group">
    <label for="message">{!! __("Message") !!} *</label>
    {!! Form::textarea('message',null,['class'=>'form-control','id'=>'message','disabled']) !!}
</div>
<div class="form-group">
    <label for="reply">{!! __("Reply") !!} *</label>
    {!! Form::textarea('reply',null,['class'=>'form-control','id'=>'reply','required','parsley-trigger'=>'change']) !!}
</div>
