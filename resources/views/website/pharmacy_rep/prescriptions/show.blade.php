<h4>{!! __("Prescription Info") !!}</h4>
<table class="table d-table table-bordered table-hover table-centered">
    <tbody>
    <tr>
        <td>{!! __("Doctor") !!}</td>
        <td>{!! $prescription->doctor->name !!}</td>
    </tr>
    <tr>
        <td>{!! __("Patient") !!}</td>
        <td>{!! $prescription->patient->name!!}</td>
    </tr>
    <tr>
        <td>{!! __("Code") !!}</td>
        <td>{!! $prescription->code!!}</td>
    </tr>
    <tr>
        <td>{!! __("Diagnosis") !!}</td>
        <td>{!! $prescription->diagnosis!!}</td>
    </tr>
    <tr>
        <td>{!! __("Description") !!}</td>
        <td>{!! $prescription->description!!}</td>
    </tr>

    </tbody>
</table>
<h4>{!! __("Prescription Items") !!}</h4>

<table class="table d-table table-bordered table-hover table-centered">
    <thead>
    <tr>
        {{--'medicine', 'dose', 'description'--}}
        <th>{!! __("Medicine") !!} </th>
        <th> {!! __("Dose") !!}</th>
        <th> {{ __("Description") }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($prescription->items as $item)
        <tr>
            <td>{!! $item->medicine !!}</td>
            <td> {!! $item->dose !!}</td>
            <td> {!! $item->description !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>

