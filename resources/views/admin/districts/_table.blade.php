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

                @component('admin.partials._block',
            [
             'id'=>$district->id,
             'blocked_at'=>$district->blocked_at,
             'routeName'=>'districts',
             'textMessage'=>__('This District Would Not Be Available For Patients')
             ])
                @endcomponent
            </td>
            <td>
                @component('admin.partials._action_buttons',['routeName'=>'districts','id'=>$district->id])
                @endcomponent
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
