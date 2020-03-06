$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'Accept-Language': document.documentElement.lang
    }
});

$(".datatable-buttons").DataTable(
    {
        responsive: true,
        lengthChange: !1,
        buttons: ["copy", "excel", "pdf"],
        keys: !0
    }
);

$("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
    var datatables = $($.fn.dataTable.tables(true));
    datatables.css('width', '100%');
    datatables.DataTable()
        .columns.adjust()
        .responsive.recalc()
        .draw();
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
    data = data || {};
    method = method || 'post';
    $.ajax({
        method: method,
        url: route(route_name),
        data: data,
        success: function (res) {

            var data = res.data[res_key];
            var selector = 'select[name="' + select_name + '"]';
            var placeholder = getPlaceholder(selector);
            var options = placeholder + getOptions(data);
            $(selector).html(options);
        }
    })
}


function getOptions(list) {
    var options = '';
    list.forEach(function (val) {

        var obj_string = JSON.stringify(val);
        options += '<option value="' + val.id + '" data-attrs=\'' + obj_string + ' \'>' + val.name + ' </option>'
    });

    return options;
}

function getPlaceholder(selector) {
    var select_options = $(selector).children('option');

    return (select_options.length != 0) ? '<option disabled selected value="">' + select_options[0].innerHTML + '</option>' : "";

}


