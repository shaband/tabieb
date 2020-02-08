$(".select2").select2();

jQuery('.datepicker').datepicker({
    autoclose: true,
    todayHighlight: true
});

$('.timepicker').timepicker({
    defaultTIme: false,
    icons: {
        up: 'mdi mdi-chevron-up',
        down: 'mdi mdi-chevron-down'
    }
});

///select helpers
function getOptions(list) {
    var options = '';
    list.forEach(function (val) {
        options += '<option value="' + val.id + '">' + val.name + ' </option>'
    });

    return options;
}

function getPlaceholder(selector) {
    var select_options = $(selector).children('options');
    return (select_options.length != 0) ? select_options[0] : "";

}
