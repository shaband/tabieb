<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Image") !!}</th>
        <th>{!! __("Name") !!}</th>
        <th>{!! __("Email") !!}</th>
        <th>{!! __("Phone") !!}</th>
{{--        <th>{!! __("Block") !!}</th>--}}
        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($admins as $admin)
        <tr>
            <td>
                <img src="{!! url($admin->img) !!}" width="100" height="100">
            </td>
            <td>{!! $admin->name !!}</td>
            <td>{!! $admin->email !!}</td>
            <td>{!! $admin->phone !!}</td>
            <td>
                <a href="{!! route('admin.admins.edit',$admin->id) !!}" class="btn btn-primary">
                    <i class="fas fa-pencil-alt text-white"></i>
                </a>


                <a {{--href="{!! route('admin.admins.destroy',$admin->id) !!}"--}} class="btn btn-warning  text-white" onclick="
                    Swal.fire({
                    title: '{!! __('Are you sure?') !!}',
                    text: '{!! __('You Will Not be able to revert this!') !!}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{!! __('Yes, delete it!') !!}'
                    }).then((result) => {
                    if (result.value) {document.getElementById('destroy-{!! $admin->id !!}').submit();}
                    });event.preventDefault()">
                    <i class=" fas fa-times"></i>
                </a>
                <form action="{{ route('admin.admins.destroy',$admin->id) }}" method="POST" style="display: none;"
                      id="destroy-{!! $admin->id !!}">
                    @csrf
                    @method('delete')
                </form>
                {{-- <a href="{!! route('admin.admins.destroy',$admin->id) !!}" class="btn btn-warning">
                     <i class=" fas fa-times"></i>

                 </a>--}}
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
