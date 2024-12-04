@extends('dashboard.partials.master')
@push('styles')
    <link href="{{ asset('assets/dashboard/css/datatables' . ( isDarkMode() ?  '.dark' : '' ) .'.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/dashboard/plugins/custom/datatables/datatables.bundle' . ( isArabic() ? '.rtl' : '' ) . '.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <!--begin::Basic info-->
    <div class="card mb-5 mb-x-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">{{ __('Offers list') }}</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div class="card-body">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack flex-wrap mb-5">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1 mb-2 mb-md-0">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="{{ __('Search for offers') }}">
                </div>
                <!--end::Search-->
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" id="add_btn" data-bs-toggle="modal" data-bs-target="#crud_modal" data-kt-docs-table-toolbar="base">
                    <!--begin::Add customer-->
                    <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-original-title="Coming Soon" data-kt-initialized="1">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                        <span class="svg-icon svg-icon-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
                        </svg>
                    </span>
                        <!--end::Svg Icon-->{{ __('Add offer') }}</button>
                    <!--end::Add customer-->
                </div>
                <!--end::Toolbar-->
                <!--begin::Group actions-->
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
                    <div class="fw-bold me-5">
                        <span class="me-2" data-kt-docs-table-select="selected_count"></span>{{ __('Selected item') }}</div>
                    <button type="button" class="btn btn-danger" data-kt-docs-table-select="delete_selected">{{ __('delete') }}</button>
                </div>
                <!--end::Group actions-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Datatable-->
            <table id="kt_datatable" class="table align-middle text-center table-row-dashed fs-6 gy-5">
                <thead>
                <tr class=" text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_datatable .form-check-input" value="1"/>
                        </div>
                    </th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Category') }}</th>
                    <th>{{ __('Vendor') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Created at') }}</th>
                    <th class=" min-w-100px">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                </tbody>
            </table>
            <!--end::Datatable-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Basic info-->

    {{-- begin::Add Country Modal --}}
    <form id="crud_form" class="ajax-form" action="{{ route('dashboard.offers.store') }}" method="post" data-success-callback="onAjaxSuccess" data-error-callback="onAjaxError">
        @csrf
        <div class="modal fade" tabindex="-1" id="crud_modal">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="form_title">{{ __('Add new offer') }}</h5>
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <div class="fv-row mb-5 fv-plugins-icon-container">
                            <label for="name_ar_inp" class="form-label required fs-6 fw-bold mb-3">{{ __('Name ar') }}</label>
                            <input type="text" name="name_ar" class="form-control form-control-lg form-control-solid" id="name_ar_inp" placeholder="{{ __('Name ar') }}" >
                            <div class="fv-plugins-message-container invalid-feedback" id="name_ar"></div>
                        </div>
                        <div class="fv-row mb-5 fv-plugins-icon-container">
                            <label for="name_en_inp" class="form-label required fs-6 fw-bold mb-3">{{ __('Name en') }}</label>
                            <input type="text" name="name_en" class="form-control form-control-lg form-control-solid" id="name_en_inp" placeholder="{{ __('Name en') }}" >
                            <div class="fv-plugins-message-container invalid-feedback" id="name_en"></div>
                        </div>
                        <div class="fv-row mb-5 fv-plugins-icon-container">
                            <label for="description_ar_inp" class="form-label required fs-6 fw-bold mb-3">{{ __('Description ar') }}</label>
                            <input type="text" name="description_ar" class="form-control form-control-lg form-control-solid" id="description_ar_inp" placeholder="{{ __('Description ar') }}" >
                            <div class="fv-plugins-message-container invalid-feedback" id="description_ar"></div>
                        </div>
                        <div class="fv-row mb-5 fv-plugins-icon-container">
                            <label for="description_en_inp" class="form-label required fs-6 fw-bold mb-3">{{ __('Description en') }}</label>
                            <input type="text" name="description_en" class="form-control form-control-lg form-control-solid" id="description_en_inp" placeholder="{{ __('Description en') }}" >
                            <div class="fv-plugins-message-container invalid-feedback" id="description_en"></div>
                        </div>
                        <div class="fv-row mb-5 fv-plugins-icon-container">
                            <label for="price_inp" class="form-label required fs-6 fw-bold mb-3">{{ __('Price') }}</label>
                            <input type="number" step="0.1" name="price" class="form-control form-control-lg form-control-solid" id="price_inp" placeholder="{{ __('Price') }}" >
                            <div class="fv-plugins-message-container invalid-feedback" id="price"></div>
                        </div>
                        <div class="fv-row mb-5 fv-plugins-icon-container">
                            <label class="form-label required fs-6 fw-bold mb-3">{{ __("Vendor") }}</label>
                            <select class="form-select form-select" data-control="select2" name="vendor_id" id="vendor_id_inp" data-placeholder="{{ __("Choose the vendor") }}" data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                <option value="" selected ></option>
                                @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->id }}"> {{ $vendor->name }} </option>
                                @endforeach
                            </select>
                            <div class="fv-plugins-message-container invalid-feedback" id="vendor_id"></div>
                        </div>
                        <div class="fv-row mb-5 fv-plugins-icon-container">
                            <label class="form-label required fs-6 fw-bold mb-3">{{ __("Category") }}</label>
                            <select class="form-select form-select" data-control="select2" name="category_id" id="category_id_inp" data-placeholder="{{ __("Choose the category") }}" data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                <option value="" selected ></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                @endforeach
                            </select>
                            <div class="fv-plugins-message-container invalid-feedback" id="category_id"></div>
                        </div>
                        <div class="fv-row mb-5 fv-plugins-icon-container">
                            <label class="form-label required fs-6 fw-bold mb-3">{{ __("Status") }}</label>
                            <select class="form-select form-select" data-control="select2" name="status" id="status_inp" data-placeholder="{{ __("Choose the status") }}" data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                <option value="" selected ></option>
                                <option value="Pending"> {{ __('Pending') }} </option>
                                <option value="Rejected"> {{ __('Rejected') }} </option>
                                <option value="Approved"> {{ __('Approved') }} </option>
                            </select>
                            <div class="fv-plugins-message-container invalid-feedback" id="status"></div>
                        </div>
                        <div class="fv-row mb-5 fv-plugins-icon-container" style="display: none" id="rejection_reason_container">
                            <label for="rejection_reason_inp" class="form-label required fs-6 fw-bold mb-3">{{ __('Rejection reason') }}</label>
                            <input type="text" name="rejection_reason" class="form-control form-control-lg form-control-solid" id="rejection_reason_inp" placeholder="{{ __('Rejection reason') }}" >
                            <div class="fv-plugins-message-container invalid-feedback" id="rejection_reason"></div>
                        </div>
                        <div class="fv-row mb-5 fv-plugins-icon-container">
                            <label for="meta_tag_key_words_inp" class="form-label fs-6 fw-bold mb-3">{{ __('Meta tag key words') }}</label>
                            <input type="text" name="meta_tag_key_words" class="form-control form-control-lg form-control-solid" id="meta_tag_key_words_inp" placeholder="{{ __('Meta tag key words') }}" >
                            <div class="fv-plugins-message-container invalid-feedback" id="meta_tag_key_words"></div>
                        </div>
                        <div class="fv-row mb-5 fv-plugins-icon-container">
                            <label for="meta_tag_key_description_inp" class="form-label fs-6 fw-bold mb-3">{{ __('Meta tag key description') }}</label>
                            <input type="text" name="meta_tag_key_description" class="form-control form-control-lg form-control-solid" id="meta_tag_key_description_inp" placeholder="{{ __('Meta tag key description') }}" >
                            <div class="fv-plugins-message-container invalid-feedback" id="meta_tag_key_description"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">
                                {{ __('Save') }}
                            </span>
                            <span class="indicator-progress">
                                {{ __('Please wait...') }} <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- end::Add Country Modal --}}
    <div class="row attachments">
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/dashboard/js/global/datatable-config.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/datatables/offers.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/global/crud-operations.js') }}"></script>

    <script>
        $(document).ready(function () {
            $("#add_btn").click(function (e) {
                $('#status_inp').on('change', function() {
                    var selectedValue = $(this).val();
                    var rejectionReasonContainer = $('#rejection_reason_container');

                    if (selectedValue === 'Rejected') {
                        // Show the rejection reason input field
                        rejectionReasonContainer.show();
                    } else {
                        // Hide the rejection reason input field
                        rejectionReasonContainer.hide();
                    }
                });

                e.preventDefault();

                $("#form_title").text( __('Add new offer') );
                $("[name='_method']").remove();
                $(`[name='vendor_id']`).val('').attr('selected',true);
                $(`[name='vendor_id']`).trigger('change');
                $(`[name='category_id']`).val('').attr('selected',true);
                $(`[name='category_id']`).trigger('change');
                $(`[name='status']`).val('').attr('selected',true);
                $(`[name='status']`).trigger('change');
                $("#crud_form").trigger('reset');
                $("#crud_form").attr('action', `/dashboard/offers`);
            });


        });
    </script>
@endpush
