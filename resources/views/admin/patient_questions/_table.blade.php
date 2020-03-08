<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Name In Arabic") !!}</th>
        <th>{!! __("Name In English ") !!}</th>

        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($patient_questions as $patient_question)
        <tr>
            <td>{!! $patient_question->name_ar !!}</td>
            <td>{!! $patient_question->name_en !!}</td>
            <td>

                @component('admin.partials._action_buttons',
                ['routeName'=>'patient-questions',
                'id'=>$patient_question->id,
                'permission'=>'Patientquestions'
                ])
                @endcomponent
            </td>
        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
