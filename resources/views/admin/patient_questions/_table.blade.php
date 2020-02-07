<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Name In Arabic") !!}</th>
        <th>{!! __("Name In English ") !!}</th>

        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($patient_questions as $patient_question)
        <tr>
            <td>{!! $patient_question->name_ar !!}</td>
            <td>{!! $patient_question->name_en !!}</td>
            <td>
                <a href="{!! route('admin.patient-questions.edit',$patient_question->id) !!}" class="btn btn-primary">
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
                       if (result.value) {document.getElementById('destroy-{!! $patient_question->id !!}').submit();}
                       });event.preventDefault()">
                    <i class=" fas fa-times"></i>
                </a>
                <form action="{{ route('admin.patient-questions.destroy',$patient_question->id) }}" method="POST"
                      style="display: none;"
                      id="destroy-{!! $patient_question->id !!}">
                    @csrf
                    @method('delete')
                </form>
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
