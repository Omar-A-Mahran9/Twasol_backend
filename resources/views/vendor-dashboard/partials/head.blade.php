<base href="" />
<title>{{ __('Tawasol-Technology') }}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="shortcut icon" href="{{ asset('placeholder_images/favicon_Al-raqi.svg') }}" />
<!--begin::Fonts(mandatory for all pages)-->
<!--begin::Fonts-->
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
<!--end::Fonts-->
<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
@if (isArabic())
    <link href="{{ asset('assets/vendor-dashboard/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendor-dashboard/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    {{--  <link href="{{ asset('assets/dashboard/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />  --}}
    <link href="{{ asset('assets/vendor-dashboard/css/custom.css') }}" rel="stylesheet" type="text/css" />
@else
    <link href="{{ asset('assets/vendor-dashboard/plugins/global/plugins.bundle.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('assets/vendor-dashboard/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
@endif
<!--end::Global Stylesheets Bundle-->
<style>
    * :not(i) {
        font-family: "Cairo", Helvetica, "sans-serif" !important;
    }

    input[type=number].no-arrow {
        -moz-appearance: textfield;
    }

    input[type=number].no-arrow::-webkit-outer-spin-button,
    input[type=number].no-arrow::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
