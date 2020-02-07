<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Question") !!}</th>
        <th>{!! __("Answer ") !!}</th>

        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($questions as $question)
        <tr>
            <td>{!! $question->name !!}</td>
            <td>{!! $question->answer !!}</td>
            <td>
                <a href="{!! route('admin.questions.edit',$question->id) !!}" class="btn btn-primary">
                    <i class="fas fa-pencil-alt text-white"></i>
                </a>


                <a class="btn btn-warning text-white"
                   onclick="
                       Swal.fire({
                       title: '{!! __('Are you sure?') !!}',
                       text: '{!! __('You Will Not be able to revert this!') !!}',
                       icon: 'warning',
                       showCancelButton: true,
                       confirmButtonColor: '#3085d6',
                       cancelButtonColor: '#d33',
                       confirmButtonText: '{!! __('Yes, delete it!') !!}'
                       }).then((result) => {
                       if (result.value) {document.getElementById('destroy-{!! $question->id !!}').submit();}
                       });event.preventDefault()">
                    <i class=" fas fa-times"></i>
                </a>
                <form action="{{ route('admin.questions.destroy',$question->id) }}" method="POST"
                      style="display: none;"
                      id="destroy-{!! $question->id !!}">
                    @csrf
                    @method('delete')
                </form>
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
