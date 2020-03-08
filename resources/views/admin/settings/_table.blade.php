<table class="table table-striped table-bordered dt-responsive nowrap table-responsive d-table">
    <thead>
    <tr>
        <th>{!! __("Name") !!}</th>
        <th>{!! __("Value") !!}</th>
        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($settings as $setting)
        <tr>
            <td>{!! $setting->slug !!}</td>
            <td>{!! $setting->value !!}</td>
            <td>
                @component('admin.partials._edit_button',
                            [
                                'id'=>$setting->id,
                                'routeName'=>'settings',
                                'permission'=>"Setting"
                            ])
                @endcomponent
            </td>

        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
