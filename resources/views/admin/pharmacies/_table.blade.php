<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Name") !!}</th>
        <th>{!! __("Email") !!}</th>
        <th>{!! __("Phone") !!}</th>
        <th>{!! __("Address") !!}</th>
        <th>{!! __("Status") !!}</th>
        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($pharmacies as $pharmacy)
        <tr>
            <td>{!! $pharmacy->name !!}</td>
            <td>{!! $pharmacy->email !!}</td>
            <td>{!! $pharmacy->phone !!}</td>
            <td>{!! $pharmacy->address !!}</td>

            <td>
                @component('admin.partials._block',
                            [
                             'id'=>$pharmacy->id,
                             'blocked_at'=>$pharmacy->blocked_at,
                             'routeName'=>'pharmacies',
                             'textMessage'=>__('This Pharmacy Would Not Be Available On System')
                             ])
                @endcomponent

            </td>
            <td>
                @component('admin.partials._action_buttons',['routeName'=>'pharmacies','id'=>$pharmacy->id])
                @endcomponent
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
