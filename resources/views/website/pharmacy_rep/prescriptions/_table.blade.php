<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Image") !!}</th>
        <th>{!! __("Name") !!}</th>
        <th>{!! __("Email") !!}</th>
        <th>{!! __("Phone") !!}</th>
        {{-- <th>{!! __("Block") !!}</th>
        --}} <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($pharmacy_reps as $pharmacy_rep)
        <tr>
            <td>
                <img src="{!! url($pharmacy_rep->img) !!}" width="100" height="100">
            </td>
            <td>{!! $pharmacy_rep->name !!}</td>
            <td>{!! $pharmacy_rep->email !!}</td>
            <td>{!! $pharmacy_rep->phone !!}</td>
           {{-- <td>
                @component('admin.partials._block',
                            [
                             'id'=>$pharmacy_rep->id,
                             'blocked_at'=>$pharmacy_rep->blocked_at,
                             'routeName'=>'pharmacy-reps',
                             ])
                @endcomponent

            </td>
           --}} <td>
                <a href="{!! route('pharmacy.pharmacy-reps.edit',$pharmacy_rep->id) !!}" class="btn btn-primary">
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
                       if (result.value) {document.getElementById('destroy-pharmacy-reps-{!! $pharmacy_rep->id !!}').submit();}
                       });event.preventDefault()">
                    <i class=" fas fa-times"></i>
                </a>
                <form action="{{ route('admin.pharmacy-reps.destroy',$pharmacy_rep->id) }}" method="POST"
                      style="display: none;"
                      id="destroy-destroy-pharmacy-reps-{!! $pharmacy_rep->id !!}">
                    {!! csrf_field() !!}
                    @method('delete')
                </form>

            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
