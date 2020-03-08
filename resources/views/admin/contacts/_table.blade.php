<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
    <thead>
    <tr>
        <th>{!! __("Name") !!}</th>
        <th>{!! __("Email") !!}</th>
        <th>{!! __("Subject") !!}</th>
        <th>{!! __("Message") !!}</th>
        <th>{!! __("Replay") !!}</th>
        <th>{!! __("Seen At") !!}</th>
        <th>{!! __("Seen By") !!}</th>
        <th>{!! __('Actions') !!}</th>

    </tr>
    </thead>
    @foreach($contacts as $contact)

        <tr>
            <td>{!! $contact->name !!}</td>
            <td>{!! $contact->email !!}</td>
            <td>{!! $contact->subject !!}</td>
            <td>{!! $contact->message !!}</td>
            <td>{!! $contact->reply !!}</td>
            <td>{!! optional($contact->seen_at)->format('Y-m-d H:i A') !!}</td>
            <td>{!! optional($contact->admin)->name !!}</td>
            <td>
                @component('admin.partials._action_buttons',
                [
                'id'=>$contact->id,
                'routeName'=>'contacts',
                'permission'=>'Contact'
                ])
                @endcomponent
            </td>

        </tr>
    @endforeach
    <tbody>

    </tbody>
</table>
