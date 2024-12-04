@extends('dashboard.partials.master')
@push('styles')
    <link href="{{ asset('assets/dashboard/css/datatables' . (isDarkMode() ? '.dark' : '') . '.bundle.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('assets/dashboard/plugins/custom/datatables/datatables.bundle' . (isArabic() ? '.rtl' : '') . '.css') }}"
        rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <!--begin::Tab Content-->
    <!--begin::Row-->

    <div class="row  ">
        <h3 class="text-dark mb-7" style="width:fit-content;">{{ __('Car List') }}</h3>

        <div class="spinner-border d-none" id="loading-alert" role="status">
            <span class="sr-only">{{ __('Loading...') }}</span>
        </div>
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row g-6 g-xl-9 cars-container">

    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row g-6 g-xl-9">
        <!--begin::Col-->
        <div class="col-md-12 col-xxl-12" style="display: none" id="no-results-alert">
            <!--begin::Button-->
            <div class=" d-flex flex-column flex-center">
                <!--begin::Illustration-->
                <img src="/assets/vendor-dashboard/media/illustrations/unitedpalms-1/no_results.png" alt=""
                    class="mw-100 mh-250px">
                <!--end::Illustration-->
                <!--begin::Label-->
                <div class="fs-4 text-gray-800 fw-bold mb-0">
                    {{ __('There is no result try another search method') }}
                </div>
                <!--end::Label-->
            </div>
            <!--begin::Button-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Pagination-->
    <div class="d-flex flex-stack flex-wrap pt-10 mt-5" id="pagination-container">
        <div class="fs-6 fw-semibold pagination-info" style="color: #2D3A4A"></div>
        <!--begin::Pages-->
        <ul class="pagination">

        </ul>
        <!--end::Pages-->
    </div>
    <!--end::Pagination-->
    <!--end::Tab Content-->
    <div class="row attachments">
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/dashboard/js/forms/cars/index.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
@endpush
