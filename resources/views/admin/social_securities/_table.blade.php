<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Name In Arabic") !!}</th>
        <th>{!! __("Name In English ") !!}</th>
        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($social_securities as $social_security)
        <tr>
            <td>{!! $social_security->name_ar !!}</td>
            <td>{!! $social_security->name_en !!}</td>
            <td>
                @component('admin.partials._action_buttons',
                ['routeName'=>'social-securities',
                'id'=>$social_security->id,
                'permission'=>'Socialsecurity'])
                @endcomponent
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
