<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Name") !!}</th>
        <th>{!! __("Description") !!}</th>
        @if(isset($type)&& $type=='main')
            <th>{!! __("Sub Categories") !!}</th>
        @endif
        @if(isset($type)&& $type=='sub')
            <th>{!! __("Main Category") !!}</th>
        @endif
        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($categories as $category)
        <tr>
            <td>{!! $category->name !!}</td>
            <td>{!! $category->description !!}</td>
            @if(isset($type)&& $type=='main')

                <td>
                    @foreach($category->sub_categories as $sub)
                        {!! $sub->name !!}
                        @if(!$loop->last) - @endif
                    @endforeach
                </td>
            @endif
            @if(isset($type)&& $type=='sub')
                <td>       {!! optional($category->main_category)->name !!}</td>
            @endif
            <td>

                @component('admin.partials._action_buttons',
                ['routeName'=>'categories',
                'id'=>$category->id,
                'permission'=>'Category'

                ])
                @endcomponent
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
