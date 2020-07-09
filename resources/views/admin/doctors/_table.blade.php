<table  class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Name ") !!}</th>
        <th>{!! __("Title") !!}</th>
        <th>{!! __("Email") !!}</th>
        <th>{!! __("Phone") !!}</th>
        <th>{!! __("Price") !!}</th>
        <th>{!! __("Status") !!}</th>

        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($doctors as $doctor)
        <tr>
            <td>{!! $doctor->name !!}</td>
            <td>{!! $doctor->title !!}</td>
            <td>{!! $doctor->email !!}</td>
            <td>{!! $doctor->phone !!}</td>
            <td>{!! $doctor->price !!}</td>
            <td>
                @component('admin.partials._block',
                            [
                             'id'=>$doctor->id,
                             'blocked_at'=>$doctor->blocked_at,
                             'routeName'=>'doctors',
                             'textMessage'=>__('This Doctor Would Not Be Available For Patients'),
                             'permission'=>'Doctor'

                             ])
                @endcomponent

            </td>
            <td>
                @component('admin.partials._action_buttons',[
                'routeName'=>'doctors',
                'id'=>$doctor->id,
                'permission'=>'Doctor'
                ])
                @endcomponent
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
