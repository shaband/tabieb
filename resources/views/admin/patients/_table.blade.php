<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Name ") !!}</th>
        <th>{!! __("Email") !!}</th>
        <th>{!! __("Phone") !!}</th>

        <th>{!! __("Status") !!}</th>

        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($patients as $patient)
        <tr>
            <td>{!! $patient->name !!}</td>
            <td>{!! $patient->title !!}</td>
            <td>{!! $patient->email !!}</td>
            <td>{!! $patient->phone !!}</td>
            <td>{!! $patient->price !!}</td>
            <td>
                @component('admin.partials._block',
                            [
                             'id'=>$patient->id,
                             'blocked_at'=>$patient->blocked_at,
                             'routeName'=>'patients',
                             'textMessage'=>__('This Doctor Would Not Be Available For Patients')
                             ])
                @endcomponent

            </td>
            <td>
                @component('admin.partials._action_buttons',['routeName'=>'patients','id'=>$patient->id])
                @endcomponent
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
