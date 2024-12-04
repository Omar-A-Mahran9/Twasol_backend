@extends('dashboard.partials.master')
@push('styles')
    <link href="{{ asset('assets/dashboard/css/datatables' . (isDarkMode() ? '.dark' : '') . '.bundle.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('assets/dashboard/plugins/custom/datatables/datatables.bundle' . (isArabic() ? '.rtl' : '') . '.css') }}"
        rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <!--begin::Form-->
    <form id="filter-form" action="{{ route('dashboard.products.index') }}" method="get">
        @csrf
        <input type="hidden" name="advanced_search">
        <!--begin::Card-->
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Compact form-->
                <div class="d-flex align-items-center justify-content-between">
                    <!--begin::Input group-->
                    <div class="position-relative w-md-400px me-md-2">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                    transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                <path
                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" class="form-control form-control-solid ps-10" name="name"
                            placeholder="{{ __('write product name') }}" />
                    </div>
                    <!--end::Input group-->

                    <!--begin:Action-->
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center collapsible py-3 toggle mb-0 active" data-bs-toggle="collapse"
                            data-bs-target="#kt_advanced_search_form" aria-expanded="true">
                            <!--begin::Icon-->
                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary ms-5">
                                <i class="ki-outline ki-setting-4 fs-1"></i>
                            </div>
                            <!--end::Icon-->
                        </div>
                    </div>
                    <!--end:Action-->
                </div>
                <!--end::Compact form-->
                <!--begin::Advance form-->
                <div class="collapse" id="kt_advanced_search_form">
                    <!--begin::Separator-->
                    <div class="separator separator-dashed mt-9 mb-6"></div>
                    <!--end::Separator-->
                    <!--begin::Row-->
                    <div class="row g-12 mb-5">
                        <!--begin::Col-->
                        <div class="col-lg-4">
                            <label class="fs-6 form-label fw-bold text-dark">{{ __('Sort by') }}</label>
                            <!--begin::Select-->
                            <select class="form-select form-select-solid" data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}"
                                name="arrange_by" id="arrange_by" data-control="select2"
                                data-placeholder="{{ __('Select sort method') }}" data-allow-clear="true">
                                <option value=""></option>
                                <option value="oldest">{{ __('Oldest') }}</option>
                                <option value="latest">{{ __('Newest') }}</option>
                            </select>
                            <!--end::Select-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-lg-4">
                            <label class="fs-6 form-label fw-bold text-dark">{{ __('Sort by status') }}</label>
                            <!--begin::Select-->
                            <select class="form-select form-select-solid" data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}"
                                name="status" id="status" data-control="select2"
                                data-placeholder="{{ __('Select sort method') }}" data-allow-clear="true">
                                <option value=""></option>
                                <option value="In Stock">{{ __('In Stock') }}</option>
                                <option value="Out Stock">{{ __('Out Stock') }}</option>
                            </select>
                            <!--end::Select-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-lg-4">
                            <label class="fs-6 form-label fw-bold text-dark">{{ __('Sort by tags') }}</label>
                            <!--begin::Select-->
                            <select class="form-select form-select-solid" data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}"
                                name="tag" id="tag" data-control="select2"
                                data-placeholder="{{ __('Select sort method') }}" data-allow-clear="true">
                                <option value=""></option>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            <!--end::Select-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary w-25">
                            <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-12-26-231111/core/html/src/media/icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-muted svg-icon-2"><svg width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            {{ __('Search...') }}
                        </button>

                    </div>
                </div>
                <!--end::Advance form-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </form>
    <!--end::Form-->

    <!--begin::Tab Content-->
    <!--begin::Row-->

    <div class="row  ">
        <h3 class="text-dark mb-7" style="width:fit-content;">{{ __('Product list') }}</h3>

        <div class="spinner-border d-none" id="loading-alert" role="status">
            <span class="sr-only">{{ __('Loading...') }}</span>
        </div>
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row g-6 g-xl-9 products-container">

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
    <script src="{{ asset('assets/dashboard/js/forms/products/index.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
@endpush
