<div class="prescription-container" id="prescription-container">
    <div class="pres-header">
        <div class="pres-logo">
            <img class="w-100" src="{{asset($prescription->doctor->logo)}}">
        </div>
        <div class="pres-main-dets">
            <div class="d-name">{!! $prescription->doctor->name !!}</div>
            <div class="d-title text-secondary">{!! $prescription->doctor->title !!}</div>
            <div class="d-desc text-light">{!! $prescription->doctor->description !!}</div>
        </div>
    </div>
    <div class="pres-sub-header">
        <table>
            <tr>
                <th>{{ __('patient name')}}:</th>
                <td>{!! $prescription->patient->name !!}</td>
            </tr>
            <tr>
                <th>age:</th>
                <td>{!! $prescription->patient->birthdate ? \Carbon\Carbon::now()->diffInYears($prescription->patient->birthdate) : null !!}</td>
            </tr>
            <tr>
                <th>date:</th>
                <td>{!! $prescription->created_at->format("Y-m-d") !!}</td>
            </tr>
            <tr>
                <th>desease:</th>
                <td>{!! $prescription->diagnosis !!}</td>
            </tr>
        </table>
    </div>
    <div class="pres-desc font-weight-bold">
        {!! $prescription->description !!}
    </div>
    <div class="pres-content">
        <table class="table table-striped m-0">
            <tbody>
            <tr>
                <th>{{ __('Medicine')}}</th>
                <th>{{ __('Dose')}}</th>
                <th>{{ __('Note')}}</th>
            </tr>
            @foreach($prescription->items  ??[] as $item)
                <tr>
                    <th>{!! $item->medicine !!}</th>
                    <th>{!! $item->dose !!}</th>
                    <th>{!! $item->description !!}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <img class="pres-bottom" src="{{asset('design/images/sharasheeb.png')}}">
</div>
