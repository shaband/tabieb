$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'Accept-Language': document.documentElement.lang
    }
});


$(".select2").select2();

$('.datepicker').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'yyyy-mm-dd',
});

$('.timepicker').timepicker({
    defaultTIme: false,
    icons: {
        up: 'mdi mdi-chevron-up',
        down: 'mdi mdi-chevron-down'
    }
});


///select helpers

function getOptionsForSelect(select_name, route_name, data, res_key, method) {
    method = method || 'post';
    $.ajax({
        method: method,
        url: route(route_name),
        data: data,
        success: function (res) {
            var areas = res.data[res_key];
            var selector = 'select[name="' + select_name + '"]';
            var placeholder = getPlaceholder(selector);
            var options = placeholder + getOptions(areas);
            $(selector).html(options);
        }
    })
}


function getOptions(list) {
    var options = '';
    list.forEach(function (val) {
        options += '<option value="' + val.id + '">' + val.name + ' </option>'
    });

    return options;
}

function getPlaceholder(selector) {
    var select_options = $(selector).children('option');

    return (select_options.length != 0) ? '<option disabled selected value="">' + select_options[0].innerHTML + '</option>' : "";

}

