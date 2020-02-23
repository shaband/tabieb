<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Doctor") !!}</th>
        <th>{!! __("Day") !!}</th>
        <th>{!! __("From") !!}</th>
        <th>{!! __("To") !!}</th>
        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($schedules as $schedule)
        <tr>
            <td>{!! $schedule->doctor->name !!}</td>
            <td>{!!days()[$schedule->day] ??null !!}</td>
            <td>{!! \Carbon\Carbon::parse($schedule->from_time)->format('H:i A') !!}</td>
            <td>{!! \Carbon\Carbon::parse($schedule->to_time)->format('H:i A')!!}</td>
            <td>
                @component('admin.partials._action_buttons',['id'=>$schedule->id,'routeName'=>'schedules'])
                @endcomponent

            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
