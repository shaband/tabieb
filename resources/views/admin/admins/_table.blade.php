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
                @component('admin.partials._action_buttons',['routeName'=>'admins','id'=>$admin->id])
                @endcomponent
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
