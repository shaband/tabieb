<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Name In Arabic") !!}</th>
        <th>{!! __("Name In English") !!}</th>
        <th>{!! __("Status") !!}</th>

        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($districts as $district)
        <tr>
            <td>{!! $district->name_ar !!}</td>
            <td>{!! $district->name_en !!}</td>
            <td>
                <a class="btn btn-{!! $district->blocked_at?'danger':'success' !!} text-white"
                   onclick="
                       Swal.fire({
                       title: '{!! __('Are you sure?') !!}',
                       text: '{!! __('This District Would Not Be Selected To Patients') !!}',
                       icon: 'warning',
                       showCancelButton: true,
                       confirmButtonColor: '#3085d6',
                       cancelButtonColor: '#d33',
                       confirmButtonText: ' {!! $district->blocked_at?__('Yes, Open it!') : __('Yes, block it!') !!}'
                       }).then((result) => {
                       if (result.value) {document.getElementById('block-{!! $district->id !!}').submit();}
                       });event.preventDefault()">
                    <i class="fas fa-shield-alt"></i>
                    {!! $district->blocked_at?__('blocked'):__('open') !!}
                </a>
                <form action="{{ route('admin.districts.block',$district->id) }}" method="POST"
                      style="display: none;"
                      id="block-{!! $district->id !!}">
                    @csrf
                    @method('post')
                    <input type="hidden" name="block" value="{!! $district->blocked_at?0:1 !!}">
                </form>


            </td>
            <td>
                <a href="{!! route('admin.districts.edit',$district->id) !!}" class="btn btn-primary text-white">
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
                       if (result.value) {document.getElementById('destroy-{!! $district->id !!}').submit();}
                       });event.preventDefault()">
                    <i class=" fas fa-times"></i>
                </a>
                <form action="{{ route('admin.districts.destroy',$district->id) }}" method="POST"
                      style="display: none;"
                      id="destroy-{!! $district->id !!}">
                    @csrf
                    @method('delete')
                </form>
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
