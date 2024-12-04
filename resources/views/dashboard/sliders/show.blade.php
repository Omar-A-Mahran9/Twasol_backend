@extends('dashboard.partials.master')
@push('styles')
    <link href="{{ asset('assets/dashboard/css/datatables' . (isDarkMode() ? '.dark' : '') . '.bundle.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('assets/dashboard/plugins/custom/datatables/datatables.bundle' . (isArabic() ? '.rtl' : '') . '.css') }}"
        rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Order details page-->
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <!--begin::Order summary-->
                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                    <!--begin::Vendor Details-->
                    <div class="card card-flush py-4 flex-row-fluid">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ __('Slider Details') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-subtitle fs-2 me-2"></i>{{ __('Title') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <span class="text-gray-600 text-hover-primary">{{ $slider->title }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-subtitle fs-2 me-2"></i>{{ __('Description') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">{{ $slider->description }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-subtitle fs-2 me-2"></i>{{ __('Button name') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">{{ $slider->btn_title }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-fasten fs-2 me-2"></i>{{ __('Button link') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">{{ $slider->btn_link }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Vendor Details-->
                </div>
                <!--end::Order summary-->
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade show active" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                        <!--begin::Orders-->
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                                <!--begin::Payment address-->
                                <div class="card card-flush py-4 flex-row-fluid position-relative">
                                    <!--begin::Background-->
                                    <div
                                        class="position-absolute top-0 end-0 bottom-0 opacity-10 d-flex align-items-center me-5">
                                        <a class="d-block overlay" data-action="preview_commercial_register_image"
                                            href="#">
                                            <div class="symbol symbol-150px symbol-circle mb-7">
                                                <img src="{{ $slider->full_image_path }}" alt="image" />
                                            </div>
                                        </a>
                                    </div>
                                    <!--end::Background-->
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{ __('Slider background') }}</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <br />
                                        <br />
                                        <br />
                                        <br />
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Payment address-->

                            </div>
                        </div>
                        <!--end::Orders-->
                    </div>
                    <!--end::Tab pane-->
                </div>
                <!--end::Tab content-->

            </div>
            <!--end::Order details page-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
    <div class="row attachments">
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/dashboard/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
    <script>
        const previewCommercialRegisterImageButton = $('[data-action="preview_commercial_register_image"]');
        let commercialRegisterImagePath = `{{ $slider->full_image_path }}`;

        $(previewCommercialRegisterImageButton).on('click', function(e) {
            e.preventDefault();

            $(".attachments").html('');

            $(".attachments").append(`
            <!--begin::Overlay-->
            <a class="d-block overlay" data-fslightbox="lightbox-basic" href="${commercialRegisterImagePath}">
                <!--begin::Action-->
                <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                    <i class="bi bi-eye-fill text-white fs-3x"></i>
                </div>
                <!--end::Action-->
            </a>
            <!--end::Overlay-->
        `);

            refreshFsLightbox();

            $("[data-fslightbox='lightbox-basic']:first").trigger('click');
        });

        $(approval).on('click', function(e) {
            e.preventDefault();
            console.log(e)
        });
    </script>
@endpush
