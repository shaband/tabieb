<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Question") !!}</th>
        <th>{!! __("Answer ") !!}</th>

        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($questions as $question)
        <tr>
            <td>{!! $question->name !!}</td>
            <td>{!! $question->answer !!}</td>
            <td>
                @component('admin.partials._action_buttons',['routeName'=>'questions','id'=>$question->id])
                @endcomponent
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
