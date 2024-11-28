<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RMS') }}</title>

    <script src="{{ url('/') }}/jquery.js"></script>
    <script src="{{ url('/') }}/admin/assets/datatable.js"></script>
    <link rel="stylesheet" href="{{ url('/') }}/admin/assets/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/admin/assets/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/admin/assets/datatable.css">

    <link rel="icon" type="image/x-icon" href="{{ url('/') }}/icon.png" />
    <script src="{{ url('/') }}/moment.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ url('/') }}/admin/assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="{{ url('/') }}/admin/assets/vendor/css/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('/') }}/admin/assets/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('/') }}/admin/assets/css/demo.css" />
    <link rel="stylesheet"
        href="{{ url('/') }}/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ url('/') }}/admin/assets/vendor/libs/apex-charts/apex-charts.css" />


    {{-- Date Range Picker --}}
    <script src="{{ url('/') }}/admin/assets/daterange.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css"
        integrity="sha512-gp+RQIipEa1X7Sq1vYXnuOW96C4704yI1n0YB9T/KqdvqaEgL6nAuTSrKufUX3VBONq/TPuKiXGLVgBKicZ0KA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"
        integrity="sha512-Ixzuzfxv1EqafeQlTCufWfaC6ful6WFqIz4G+dWvK0beHw0NVJwvCKSgafpy5gwNqKmgUfIBraVwkKI+Cz0SEQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.css"
        integrity="sha512-Woz+DqWYJ51bpVk5Fv0yES/edIMXjj3Ynda+KWTIkGoynAMHrqTcDUQltbipuiaD5ymEo9520lyoVOo9jCQOCA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ url('/') }}/admin/libs/stteper/stteper.css" />
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.1.0/dist/geosearch.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-geosearch@3.1.0/dist/bundle.min.js"></script>
    {{-- <link href="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/css/nepali.datepicker.v4.0.1.min.css"
        rel="stylesheet" type="text/css" />
    <script src="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.1.min.js"
        type="text/javascript"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>


    <script>
        (function($) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
        })(jQuery);
    </script>

    @yield('customCss')

    <style>
        div.dataTables_wrapper div.dataTables_info {
            padding-top: 0 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            padding: .5em 1em;
            margin-left: 2px;
            text-align: center;
            text-decoration: none !important;
            cursor: pointer;
            color: white !important;
            border: 1px solid transparent;
            border-radius: 5px;
            background: #3252A4;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next:hover {
            cursor: pointer;
            color: white !important;
            background-color: #1B43A9 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:active {
            color: white !important;
            background-color: #1B43A9 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #1B43A9 !important;
            border: 1px solid #1B43A9;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: white !important;
            background-color: #1B43A9 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            cursor: default;
            color: white !important;
            background-color: gray !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            cursor: default;
            color: white !important;
            background-color: gray !important;
        }

        div.dataTables_wrapper div.dataTables_length label {
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        div.dataTables_wrapper div.dataTables_length select {
            --bs-form-select-bg-img: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            display: block;
            padding: .375rem 2.25rem .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            background-image: var(--bs-form-select-bg-img), var(--bs-form-select-bg-icon, none);
            background-repeat: no-repeat;
            background-position: right .75rem center;
            background-size: 16px 12px;
            border: var(--bs-border-width) solid var(--bs-border-color);
            border-radius: var(--bs-border-radius);
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none
        }
    </style>


    <style>
        fieldset.scheduler-border {
            border: 1px groove #ddd !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow: 0px 0px 0px 0px #000;
            box-shadow: 0px 0px 0px 0px #000;
            margin-top: 30px !important;
        }

        legend.scheduler-border {
            font-size: 1.1em !important;
            text-transform: uppercase;
            font-weight: 400;
            text-align: left !important;
            width: auto;
            padding: 0 10px;
            border-bottom: none;
            margin-top: -12.5px;
            background-color: white;
            color: gray;
        }
    </style>
</head>

<body class="" style="background-color: #e4e4e4">
    @include('alerts.sweet-alerts')
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @yield('sidebar')
            <div class="layout-page">
                @include('layouts.include.navbar')
                <div class="content-wrapper">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        {{ $slot }}
                    </div>
                    <!-- Footer -->
                    @include('layouts.include.footer')
                    <!-- / Footer -->
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
</body>

{{-- Moment Js --}}
<script>
    (function($) {
        $('.nav-link').click(function() {
            var tabId = $(this).attr('href');
            $('.nav-link').removeClass('active');
            $(this).addClass('active');
            $('.tab-pane').removeClass('show active');
            $(tabId).addClass('show active');
            history.pushState({}, '', tabId);
        });
        var hash = window.location.hash;
        if (hash) {
            $('.nav-link[href="' + hash + '"]').click();
        }
    })(jQuery);
</script>
@yield('customJs')

<script src="{{ url('/') }}/admin/assets/vendor/js/helpers.js"></script>
<script src="{{ url('/') }}/admin/assets/js/config.js"></script>
<script src="{{ url('/') }}/admin/assets/iconify.min.js"></script>
<script src="{{ url('/') }}/admin/assets/vendor/libs/jquery/jquery.js"></script>
<script src="{{ url('/') }}/admin/assets/vendor/libs/popper/popper.js"></script>
<script src="{{ url('/') }}/admin/assets/vendor/js/bootstrap.js"></script>
<script src="{{ url('/') }}/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="{{ url('/') }}/admin/assets/vendor/js/menu.js"></script>
<script src="{{ url('/') }}/admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="{{ url('/') }}/admin/assets/js/main.js"></script>
<script src="{{ url('/') }}/admin/assets/js/dashboards-analytics.js"></script>

</html>
