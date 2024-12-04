@extends('dashboard.partials.master')
@push('styles')
    <link href="{{ asset('assets/dashboard/css/datatables' . ( isDarkMode() ?  '.dark' : '' ) .'.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/dashboard/plugins/custom/datatables/datatables.bundle' . ( isArabic() ? '.rtl' : '' ) . '.css')}}" rel="stylesheet" type="text/css" />
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
                    <!--begin::Offer Details-->
                    <div class="card card-flush py-4 flex-row-fluid">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ __('Offer Details') }}</h2>
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
                                                <i class="ki-outline ki-profile-circle fs-2 me-2"></i>{{ __('Offer')}}</div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <!--begin:: Avatar -->
                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                        <div class="symbol-label fs-2 fw-semibold text-success">{{ strtoupper(substr($offer->name,0,2)) }}</div>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Name-->
                                                    <span class="text-gray-600 text-hover-primary">{{ $offer->name }}</span>
                                                    <!--end::Name-->
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-courier fs-2 me-2"></i>{{ __('Vendor')}}</div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <!--begin:: Avatar -->
                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                        <div class="symbol-label fs-2 fw-semibold text-success">{{ strtoupper(substr($offer->vendor->name,0,2)) }}</div>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Name-->
                                                    <span class="text-gray-600 text-hover-primary">{{ $offer->vendor->name }}</span>
                                                    <!--end::Name-->
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-category fs-2 me-2"></i>{{ __('Category')}}</div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <!--begin:: Avatar -->
                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                        <div class="symbol-label fs-2 fw-semibold text-success">{{ strtoupper(substr($offer->category->name,0,2)) }}</div>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Name-->
                                                    <span class="text-gray-600 text-hover-primary">{{ $offer->category->name }}</span>
                                                    <!--end::Name-->
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-data fs-2 me-2"></i>{{ __('Description') }}</div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <span class="text-gray-600 text-hover-primary">{{ $offer->description }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-tag fs-2 me-2"></i>{{ __('Price') }}</div>
                                            </td>
                                            <td class="fw-bold text-end">{{ $offer->price }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-tag fs-2 me-2"></i>{{ __('Status') }}</div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <span class="badge @if($offer->status == 'Pending') badge-light-info @elseif($offer->status == 'Approved') badge-light-success @else badge-light-danger @endif fs-7 m-1">{{ __( '' . $offer->status ) }}</span>
                                            </td>
                                        </tr>
                                        @if($offer->rejection_reason)
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-information-4 fs-2 me-2"></i>{{ __('Rejection Reason') }}</div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $offer->rejection_reason }}</td>
                                            </tr>
                                        @endif
                                        @if($offer->meta_tag_key_words)
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-information-4 fs-2 me-2"></i>{{ __('Meta tag key words') }}</div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $offer->meta_tag_key_words }}</td>
                                            </tr>
                                        @endif
                                        @if($offer->meta_tag_key_description)
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-information-4 fs-2 me-2"></i>{{ __('Meta tag key description') }}</div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $offer->meta_tag_key_description }}</td>
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
            </div>
            <!--end::Order details page-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->

@endsection
@push('scripts')

@endpush
