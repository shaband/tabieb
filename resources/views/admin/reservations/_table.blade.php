<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Doctor") !!}</th>
        <th>{!! __("Patient") !!}</th>
        <th>{!! __("Day") !!}</th>
        <th>{!! __("From") !!}</th>
        <th>{!! __("To") !!}</th>
        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($reservations as $reservation)
        <tr>
            <td>{!! optional($reservation->doctor)->name !!}</td>
            <td>{!! optional($reservation->patient)->name !!}</td>
            <td>{!! days()[$reservation->day] !!}</td>
            <td>{!! $reservation->from_time !!}</td>
            <td>{!! $reservation->to_time !!}</td>
            <td>{!! $reservation->description !!}</td>
            <td>
                @component('admin.partials._action_buttons',['routeName'=>'reservations','id'=>$reservation->id])
                @endcomponent
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
