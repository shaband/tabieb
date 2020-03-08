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
                @component('admin.partials._action_buttons',[
                'routeName'=>'areas',
                'id'=>$area->id,
                'permission'=>'Area'
                ])
                @endcomponent
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
