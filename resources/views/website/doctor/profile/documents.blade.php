@extends('website.doctor.profile.profile_layout')
@section('title')
    {!! __("Profile") !!} - {!! $user->name !!}
@endsection

@section('form')
    <div class="heading-blk mb-2">
        <h5 class="heading-tit-wz-after font-weight-bold">{{ __('my')}} <span
                class="text-secondary">{{ __('medical documents')}}</span><br><img
                src="{{ asset('design/images/heading-after.png')}}"></h5>
    </div>


    <div class="med-docs-container">
        <div class="row">
            @foreach($attachments as $attachment)

                <div class="col-6 col-sm-4 col-lg-3">
                    <div class="med-doc-item">
                        <a class="doc-delete" onclick="
                            Swal.fire({
                            title: '{!! __('Are you sure?') !!}',
                            text: '{!! __('You Will Not be able to revert this!') !!}',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '{!! __('Yes, delete it!') !!}'
                            }).then((result) => {
                            if (result.value) {document.getElementById('destroy-document-{!! $attachment->id !!}').submit();}
                            });event.preventDefault()"><i class="fas fa-trash-alt"></i></a>

                        <form action="{{ route('doctor.profile.documents.destroy',$attachment->id) }}" method="POST"
                              style="display: none;"
                              id="destroy-document-{!! $attachment->id !!}">
                            {!! csrf_field() !!}
                            @method('delete')
                        </form>

                        <img src="{!! asset($attachment->file) !!}" class="w-100" alt="">
                        <h6 class="text-capitalize text-center my-3">{{ __($attachment->name)}}</h6>
                    </div>
                </div>
            @endforeach

        </div>
    </div>


    <div class="doc-upload">
        <button for="doc-up" class="btn btn-thirdly text-uppercase mt-2 font-reg-norm cursor-pointer"
                data-toggle="modal" data-target="#uploadDocument">{{ __('upload document')}}
        </button>
    </div>

    <!-- Modal -->
@endsection

@push('scripts')
    <div class="modal fade" id="uploadDocument" tabindex="-1" role="dialog" aria-labelledby="uploadDocumentLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{!! route('doctor.profile.documents') !!}" enctype="multipart/form-data">
                    @method('post')
                    {!! csrf_field() !!}
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadDocumentLabel">{{__('Upload new document')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">{!! __("Name") !!}:</label>
                            <input name="name" type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">{!! __("Document") !!}:</label>
                            <input type="file" name="file" class="dropify"/>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close')}}</button>
                        <button type="submit" class="btn btn-secondary">{{ __('Save changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('.dropify').dropify();

    </script>
@endpush
