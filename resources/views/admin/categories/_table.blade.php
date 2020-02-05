<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Name") !!}</th>
        <th>{!! __("Description") !!}</th>
        @if(isset($type)&& $type=='main')
            <th>{!! __("Sub Categories") !!}</th>
        @endif
        @if(isset($type)&& $type=='sub')
            <th>{!! __("Main Category") !!}</th>
        @endif
        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($categories as $category)
        <tr>
            <td>{!! $category->name !!}</td>
            <td>{!! $category->description !!}</td>
            @if(isset($type)&& $type=='main')

                <td>
                    @foreach($category->sub_categories as $sub)
                        {!! $sub->name !!}
                        @if(!$loop->last) - @endif
                    @endforeach
                </td>
            @endif
            @if(isset($type)&& $type=='sub')
                <td>       {!! optional($category->main_category)->name !!}</td>
            @endif
            <td>
                <a href="{!! route('admin.categories.edit',$category->id) !!}" class="btn btn-primary">
                    <i class="fas fa-pencil-alt"></i>
                </a>


                <a class="btn btn-warning"
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
                       if (result.value) {document.getElementById('destroy-{!! $category->id !!}').submit();}
                       });event.preventDefault()">
                    <i class=" fas fa-times"></i>
                </a>
                <form action="{{ route('admin.categories.destroy',$category->id) }}" method="POST"
                      style="display: none;"
                      id="destroy-{!! $category->id !!}">
                    @csrf
                    @method('delete')
                </form>
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
