<!DOCTYPE html>
<html lang="{!! app()->getLocale() !!}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{!! __(env('APP_NAME')) !!} - @yield('title') </title>
    <link rel="icon" href="{!! asset('design/images/favicon.png') !!}" type="image/png">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.standalone.min.css"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{!! asset('design/css/aos.css')!!}">
    <link rel="stylesheet" href="{!! asset('design/css/bootstrap.min.css')!!}">
    <link rel="stylesheet" href="{!! asset('design/css/all.css')!!}">
    <link rel="stylesheet" href="{!! asset('design/css/jquery-ui.css')!!}">
    <link rel="stylesheet" href="{!! asset('design/css/owl.carousel.min.css')!!}">
    <link href="{!! asset('dashboard/dark/assets/libs/dropify/dropify.min.css')!!}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{!! asset('design/css/styles.css')!!}">
    @if(app()->getLocale()=='ar')
        <link rel="stylesheet" href="{!! asset('design/css/styles-ar.css')!!}">

    @endif
    <link rel="stylesheet" href="{!! asset('design/css/colors.css')!!}">
    <script src="{!! asset('design/js/jquery.min.js')!!}"></script>
    <script src="{!! asset('design/js/jquery-ui.js')!!}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="{!! asset('design/js/popper.min.js')!!}"></script>
    <script src="{!! asset('design/js/bootstrap.min.js')!!}"></script>
    <script src="{!! asset('design/js/aos.js')!!}"></script>
    <script src="{!! asset('design/js/owl.carousel.min.js')!!}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <link href="{!! asset('dashboard/dark/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') !!}"
          rel="stylesheet">


    <script src="{!! asset('dashboard/dark/assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js')!!}"></script>

    <script src="{!! asset('dashboard/dark/assets/libs/dropify/dropify.min.js')!!}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
            charset="UTF-8"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ar.min.js"></script>
    <script src="{!! asset('design/js/scripts.js')!!}"></script>

    @yield('header')
</head>
<body @if(app()->getLocale()=='ar')
      class="rtl" dir="rtl"
    @endif >

<div class="main-wrapper">
    @include('sweetalert::alert')

    @include('website.layouts._header')

    @yield('content')

    @include('website.layouts._footer')

    @routes

    @stack('footer')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept-Language': document.documentElement.lang
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

    </script>
    @stack('scripts')
</div>


</body>
</html>

