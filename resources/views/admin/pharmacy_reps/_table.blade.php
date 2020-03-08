<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Image") !!}</th>
        <th>{!! __("Name") !!}</th>
        <th>{!! __("Pharmacy") !!}</th>
        <th>{!! __("Email") !!}</th>
        <th>{!! __("Phone") !!}</th>
        {{-- <th>{!! __("Block") !!}</th>
        --}} <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($pharmacy_reps as $pharmacy_rep)
        <tr>
            <td>
                <img src="{!! url($pharmacy_rep->img) !!}" width="100" height="100">
            </td>
            <td>{!! $pharmacy_rep->name !!}</td>
            <td>{!! optional($pharmacy_rep->pharmacy)->name !!}</td>
            <td>{!! $pharmacy_rep->email !!}</td>
            <td>{!! $pharmacy_rep->phone !!}</td>
           {{-- <td>
                @component('admin.partials._block',
                            [
                             'id'=>$pharmacy_rep->id,
                             'blocked_at'=>$pharmacy_rep->blocked_at,
                             'routeName'=>'pharmacy-reps',
                             ])
                @endcomponent

            </td>
           --}} <td>
                @component('admin.partials._action_buttons',
                ['routeName'=>'pharmacy-reps',
                'id'=>$pharmacy_rep->id,
                'permission'=>'Pharmacyrep'
                ])
                @endcomponent
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
