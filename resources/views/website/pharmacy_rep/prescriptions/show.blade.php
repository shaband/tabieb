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


<a class="btn btn-success text-white col-md-12 w-100"
   onclick="
       Swal.fire({
       title: '{!! __('Are you sure?') !!}',
       text: '{!! __('You Will Not be able to revert this!') !!}',
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: '{!! __('Yes, Finish it!') !!}'
       }).then((result) => {
       if (result.value) {document.getElementById('finish-prescription-{!! $prescription->id !!}').submit();}
       });event.preventDefault()">
    <i class=" fas fa-check"></i>

    {{ __("Finish")}}
</a>
@if($prescription->phramacy_id==null)
    <form action="{{ route('pharmacy.prescription.finish',$prescription->id) }}" method="POST"
          style="display: none;"
          id="finish-prescription-{!! $prescription->id !!}">
        {!! csrf_field() !!}
        @method('patch')
    </form>
@endif
