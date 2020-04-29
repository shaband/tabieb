<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Patient") !!}</th>
        <th>{!! __("Doctor") !!}</th>
{{--
        <th>{!! __("Rep") !!}</th>
--}}
        <th>{!! __("diagnosis") !!}</th>
        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($prescriptions as $prescription)
        <tr>
            <td>{!! $prescription->patient->name !!}</td>
            <td>{!! $prescription->doctor->name !!}</td>
            <td>{!! $prescription->diagnosis !!}</td>
            <td>
                <a href="{!! route('pharmacy.prescriptions.show',$prescription->id) !!}" class="btn btn-primary">
                    <i class="fas fa-eye text-white"></i>
                </a>
            </td>
        </tr>
    @endforeach

    <tbody>

    </tbody>
</table>
