<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Name ") !!}</th>
        <th>{!! __("Title") !!}</th>
        <th>{!! __("Email") !!}</th>
        <th>{!! __("Phone") !!}</th>
        <th>{!! __("Price") !!}</th>
        <th>{!! __("Status") !!}</th>

        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($doctors as $doctor)
        <tr>
            <td>{!! $doctor->name !!}</td>
            <td>{!! $doctor->title !!}</td>
            <td>{!! $doctor->email !!}</td>
            <td>{!! $doctor->phone !!}</td>
            <td>{!! $doctor->price !!}</td>
            <td>
                <a class="btn btn-{!! $doctor->blocked_at?'danger':'success' !!} text-white"
                   onclick="
                       Swal.fire({
                       title: '{!! __('Are you sure?') !!}',
                       text: '{!! __('This Doctor Would Not Be Available For Patients') !!}',
                       icon: 'warning',
                       showCancelButton: true,
                       confirmButtonColor: '#3085d6',
                       cancelButtonColor: '#d33',
                       input: 'textarea',
                       inputPlaceholder: '{!! __('Type your message here...') !!}',
                       inputAttributes: {
                       'aria-label': '{!! __('Type your message here') !!}'
                       },
                       confirmButtonText: ' {!! $doctor->blocked_at?__('Yes, Open it!') : __('Yes, block it!') !!}'
                       }).then((result) => {
                       if (result.value) {
                       var form= document.getElementById('block-{!! $doctor->id !!}');
                       var block_reason = document.createElement('INPUT');
                       block_reason.name='block_reason';
                       block_reason.value=result.value;
                       form.appendChild(block_reason);
                       form.submit();
                       }
                       });event.preventDefault()">
                    <i class="fas fa-shield-alt"></i>
                    {!! $doctor->blocked_at?__('blocked'):__('open') !!}
                </a>
                <form action="{{ route('admin.doctors.block',$doctor->id) }}" method="POST"
                      style="display: none;"
                      id="block-{!! $doctor->id !!}">
                    @csrf
                    @method('post')
                    <input type="hidden" name="block" value="{!! $doctor->blocked_at?0:1 !!}">
                </form>


            </td>
            <td>
                <a href="{!! route('admin.doctors.edit',$doctor->id) !!}" class="btn btn-primary text-white">
                    <i class="fas fa-pencil-alt"></i>
                </a>


                <a class="btn btn-warning  text-white"
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
                       if (result.value) {document.getElementById('destroy-{!! $doctor->id !!}').submit();}
                       });event.preventDefault()">
                    <i class=" fas fa-times"></i>
                </a>
                <form action="{{ route('admin.doctors.destroy',$doctor->id) }}" method="POST"
                      style="display: none;"
                      id="destroy-{!! $doctor->id !!}">
                    @csrf
                    @method('delete')
                </form>
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
