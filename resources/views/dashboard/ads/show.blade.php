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
                    <!--begin::Ad Details-->
                    <div class="card card-flush py-4 flex-row-fluid">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ __('Ad Details') }}</h2>
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
                                                    <i
                                                        class="ki-outline ki-profile-circle fs-2 me-2"></i>{{ __('Image') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <a class="d-block overlay" data-action="preview_full_image_path"
                                                        href="#">
                                                        <div class="symbol symbol-150px symbol-circle mb-7">
                                                            <img src="{{ $ad->full_image_path }}" alt="image" />
                                                        </div>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-courier fs-2 me-2"></i>{{ __('Vendor') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <!--begin:: Avatar -->
                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                        <div class="symbol-label fs-2 fw-semibold text-success">
                                                            {{ strtoupper(substr($ad->vendor->name, 0, 2)) }}</div>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Name-->
                                                    <span
                                                        class="text-gray-600 text-hover-primary">{{ $ad->vendor->name }}</span>
                                                    <!--end::Name-->
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-data fs-2 me-2"></i>{{ __('Title') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <span class="text-gray-600 text-hover-primary">{{ $ad->title }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-data fs-2 me-2"></i>{{ __('Description') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <span
                                                    class="text-gray-600 text-hover-primary">{{ $ad->description }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-fasten fs-2 me-2"></i>{{ __('Link') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <span class="text-gray-600 text-hover-primary">{{ $ad->link }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-setting-4 fs-2 me-2"></i>{{ __('Status') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <span
                                                    class="badge @if ($ad->status == 'Active') badge-light-success @else badge-light-danger @endif fs-7 m-1">{{ __('' . $ad->status) }}</span>
                                            </td>
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
        const previewFullImagePath = $('[data-action="preview_full_image_path"]');
        let fullImagePath = `{{ $ad->full_image_path }}`;

        $(previewFullImagePath).on('click', function(e) {
            e.preventDefault();

            $(".attachments").html('');

            $(".attachments").append(`
            <!--begin::Overlay-->
            <a class="d-block overlay" data-fslightbox="lightbox-basic" href="${fullImagePath}">
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
    </script>
@endpush
