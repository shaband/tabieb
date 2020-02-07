<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Name In Arabic") !!}</th>
        <th>{!! __("Name In English") !!}</th>
        <th>{!! __("District") !!}</th>

        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($areas as $area)
        <tr>
            <td>{!! $area->name_ar !!}</td>
            <td>{!! $area->name_en !!}</td>
            <td>{!! optional($area->district)->name !!}</td>
            <td>
                <a href="{!! route('admin.areas.edit',$area->id) !!}" class="btn btn-primary">
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
                       if (result.value) {document.getElementById('destroy-{!! $area->id !!}').submit();}
                       });event.preventDefault()">
                    <i class=" fas fa-times"></i>
                </a>
                <form action="{{ route('admin.areas.destroy',$area->id) }}" method="POST"
                      style="display: none;"
                      id="destroy-{!! $area->id !!}">
                    @csrf
                    @method('delete')
                </form>
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
