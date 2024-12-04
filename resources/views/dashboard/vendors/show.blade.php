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
                                <h2>{{ __('Vendor Details') }}</h2>
                            </div>
                            <div class="d-flex flex-xl-row gap-10 align-items-center">
                                @if ($vendor->approved === App\Enums\VendorStatusEnum::Pending->value)
                                    <form class="vendor-status-form" data-vendor-id="{{ $vendor->id }}"
                                        data-status="{{ App\Enums\VendorStatusEnum::Approved->value }}">
                                        @csrf
                                        <button type="button" class="btn btn-success btn-sm me-lg-n7 approve-btn"
                                            style="background-color: #DEB893">
                                            {{ __('Approved') }}
                                        </button>
                                    </form>

                                    <form class="vendor-status-form" data-vendor-id="{{ $vendor->id }}"
                                        data-status="{{ App\Enums\VendorStatusEnum::Rejected->value }}">
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm me-lg-n7 reject-btn">
                                            {{ __('Rejected') }}
                                        </button>
                                    </form>
                                @endif
                                @if ($vendor->approved === App\Enums\VendorStatusEnum::Approved->value)
                                    <form class="vendor-status-form" data-vendor-id="{{ $vendor->id }}"
                                        data-status="{{ App\Enums\VendorStatusEnum::Blocking->value }}">
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm me-lg-n7 reject-btn">
                                            {{ __('Blocking') }}
                                        </button>
                                    </form>
                                @endif
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
                                                        class="ki-outline ki-profile-circle fs-2 me-2"></i>{{ __('Vendor') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <!--begin:: Avatar -->
                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                        <div class="symbol-label fs-2 fw-semibold text-success">
                                                            {{ strtoupper(substr($vendor->name, 0, 2)) }}</div>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Name-->
                                                    <span
                                                        class="text-gray-600 text-hover-primary">{{ $vendor->name }}</span>
                                                    <!--end::Name-->
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-text-bold fs-2 me-2"></i>{{ __('Brand Name') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <span class="text-gray-600 text-hover-primary">{{ $vendor->brand }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-sms fs-2 me-2"></i>{{ __('Email') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <span class="text-gray-600 text-hover-primary">{{ $vendor->email }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-phone fs-2 me-2"></i>{{ __('Phone') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">{{ $vendor->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-faceid fs-2 me-2"></i>{{ __('National ID') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">{{ $vendor->national_id }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i
                                                        class="ki-outline ki-fingerprint-scanning fs-2 me-2"></i>{{ __('Commercial register number') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">{{ $vendor->commercial_register_number }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-address-book fs-2 me-2"></i>{{ __('Address') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">{{ $vendor->address }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-bank fs-2 me-2"></i>{{ __('Bank IBAN') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">{{ $vendor->iban_number }}</td>
                                        </tr>
                                        @forelse ($vendor->categories as $category)
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i
                                                            class="ki-outline ki-category fs-2 me-2"></i>{{ ((($category->id == 1 ? $category->name : $category->id == 2) ? $category->name : $category->id == 3) ? $category->name : $category->id == 4) ? $category->name : __('Alloys') }}
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $category->pivot->ratio . ' %' }}</td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        @if ($vendor->subscription_end_date)
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i
                                                            class="ki-outline ki-calendar fs-2 me-2"></i>{{ __('Subscription End Date') }}
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $vendor->subscription_end_date }}</td>
                                            </tr>
                                        @endif
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
                                                <img src="{{ $vendor->commercial_register_image_path }}" alt="image" />
                                            </div>
                                        </a>
                                    </div>
                                    <!--end::Background-->
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{ __('Commercial Register') }}</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::Payment address-->
                                <!--begin::Shipping address-->
                                <div class="card card-flush py-4 flex-row-fluid position-relative flipped">
                                    <!--begin::Background-->
                                    <div
                                        class="position-absolute top-0 end-0 bottom-0 opacity-10 d-flex align-items-center me-5">
                                        <a class="d-block overlay" data-action="preview_licensure_image" href="#">
                                            <div class="symbol symbol-150px symbol-circle mb-7">
                                                <img src="{{ $vendor->licensure_image_path }}" alt="image" />
                                            </div>
                                        </a>
                                    </div>
                                    <!--end::Background-->
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{ __('License') }}</h2>
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
                                <!--end::Shipping address-->
                            </div>
                        </div>
                        <!--end::Orders-->
                    </div>
                    <!--end::Tab pane-->
                </div>
                <!--end::Tab content-->

                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade show active" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                        <!--begin::Orders-->
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                                <!--begin::Shipping address-->
                                <div class="card card-flush py-4 flex-row-fluid position-relative flipped">
                                    <!--begin::Background-->
                                    <div
                                        class="position-absolute top-0 end-0 bottom-0 opacity-10 d-flex align-items-center me-5">
                                        <a class="d-block overlay" data-action="preview_logo" href="#">
                                            <div class="symbol symbol-150px symbol-circle mb-7">
                                                <img src="{{ $vendor->logo_path }}" alt="image" />
                                            </div>
                                        </a>
                                    </div>
                                    <!--end::Background-->
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{ __('Logo') }}</h2>
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
                                <!--begin::Shipping address-->
                                <div class="card card-flush py-4 flex-row-fluid position-relative flipped">
                                    <!--begin::Background-->
                                    <div
                                        class="position-absolute top-0 end-0 bottom-0 opacity-10 d-flex align-items-center me-5">
                                        <a class="d-block overlay" data-action="preview_cover" href="#">
                                            <div class="symbol symbol-150px symbol-circle mb-7">
                                                <img src="{{ $vendor->cover_path }}" alt="image" />
                                            </div>
                                        </a>
                                    </div>
                                    <!--end::Background-->
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{ __('Cover') }}</h2>
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
                                <!--end::Shipping address-->
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
        const previewLicensureImagePathButton = $('[data-action="preview_licensure_image"]');
        const previewLogoPathButton = $('[data-action="preview_logo"]');
        const previewCoverPathButton = $('[data-action="preview_cover"]');
        let approval = $('[data-action="status-approval"]');
        let vendor = @json($vendor);
        let commercialRegisterImagePath = `{{ $vendor->commercial_register_image_path }}`;
        let licensureImagePath = `{{ $vendor->licensure_image_path }}`;
        let logoPath = `{{ $vendor->logo_path }}`;
        let coverPath = `{{ $vendor->cover_path }}`;

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

        $(previewLicensureImagePathButton).on('click', function(e) {
            e.preventDefault();

            $(".attachments").html('');

            $(".attachments").append(`
            <!--begin::Overlay-->
            <a class="d-block overlay" data-fslightbox="lightbox-basic" href="${licensureImagePath}">
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

        $(previewCoverPathButton).on('click', function(e) {
            e.preventDefault();

            $(".attachments").html('');

            $(".attachments").append(`
            <!--begin::Overlay-->
            <a class="d-block overlay" data-fslightbox="lightbox-basic" href="${coverPath}">
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

        $(previewLogoPathButton).on('click', function(e) {
            e.preventDefault();

            $(".attachments").html('');

            $(".attachments").append(`
            <!--begin::Overlay-->
            <a class="d-block overlay" data-fslightbox="lightbox-basic" href="${logoPath}">
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
    <script>
        $(document).ready(function() {
            $('.vendor-status-form button').on('click', function() {
                const form = $(this).closest('form');
                const vendorId = form.data('vendor-id');
                const status = form.data('status');
                const token = form.find('input[name="_token"]').val();

                $.ajax({
                    url: "{{ route('dashboard.vendor.change.status', ':vendor_id') }}".replace(
                        ':vendor_id', vendorId),
                    method: 'POST',
                    data: {
                        _token: token,
                        status: status
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr) {
                        errorAlert(__('You must add shipping details first'))
                    }
                });
            });
        });
    </script>
@endpush
