<form class="basic-form form-label-inline" method="post" action="{!! route('doctor.profile.schedules') !!}">
    {!! csrf_field() !!}
    <div class="heading-blk mb-2 mt-2">
        <h5 class="heading-tit-wz-after font-weight-bold">{{ __('appointments')}} <span
                class="text-secondary">{!! __("Time") !!}</span><br><img
                src="{{ asset('design/images/heading-after.png')}}"></h5>
    </div>
    @foreach(days() as $day_number=>$day_str)
        @include('website.doctor.profile.schedules._day')
    @endforeach

    <div>
        <button class="btn btn-thirdly text-capitalize btn-sm">{{ __('save changes')}}</button>
    </div>
</form>

@push('scripts')
    <script>

        function schedule_row(day, index) {
            var slot = 'schedule[' + day + '][' + index + ']';
            var row = '<div class="appointment-time-item">\n' +
                '    <input type="hidden" name="' + slot + '[day]" value="' + day + '">\n' +
                '    <div class="row">\n' +
                '        <div class="col-5">\n' +
                '            <div class="form-group">\n' +
                '                <label>{{ __('from')}}:</label>\n' +
                '                <input type="time" name="' + slot + '[from_time]" class="timepicker form-control"/>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="col-5">\n' +
                '            <div class="form-group">\n' +
                '                <label>{{ __('to') }}:</label>\n' +
                '                <input type="time" name="' + slot + '[to_time]" class="timepicker form-control"/>\n' +
                '            </div>\n' +
                '        </div>\n' +

                '<div class="col-2">' +
                '<a class="btn btn-danger text-white"  onclick="removeItem(this)"><i class="fas fa-times"></i></a>' +
                '</div>' +
                '    </div>\n' +
                '</div>';
            return row;
        }

        function addPeriod(day) {
            var day_schedules = $('#day-' + day),
                index = day_schedules.children().length,
                new_row = schedule_row(day, index);
            day_schedules.append(new_row);
            // $('.timepicker').timepicker();

        }

        function removeItem(btn) {
            var row = $(btn).closest('.appointment-time-item').remove()
        }
    </script>
@endpush
