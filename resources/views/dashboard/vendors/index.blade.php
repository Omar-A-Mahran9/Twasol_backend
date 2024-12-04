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
                <h3 class="fw-bold m-0">{{ __('Vendors list') }}</h3>
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
                    <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="{{ __('Search for vendors') }}">
                </div>
                <!--end::Search-->
                <!--begin::Toolbar-->
                <!--begin::Add customer-->
                <a class="d-flex justify-content-end btn btn-primary" href="{{ route('dashboard.vendors.create') }}" data-kt-initialized="1" data-kt-docs-table-toolbar="base">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                    <span class="svg-icon svg-icon-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
                    </svg>
                </span>
                    <!--end::Svg Icon-->{{ __('Add vendor') }}</a>
                <!--end::Add customer-->
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
                    <th>{{ __('Email') }}</th>
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
    <a href="{{ route('dashboard.vendors.create') }}"></a>
    <div class="modal fade" tabindex="-1" id="crud_modal" style="display: none">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="form_title">{{ __('Add new vendor') }}</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="fv-row mb-4 fv-plugins-icon-container">
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <label for="image_inp" class="form-label required fs-6 fw-bold mb-2 d-flex align-items-center">{{ __('Commercial register') }}</label>
                                <div class="card">
                                    <div class="card-body">
                                        <x-dashboard.upload-image-inp  name="commercial_register" :image="null" :directory="null" placeholder="default.svg" type="editable" ></x-dashboard.upload-image-inp>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="image_inp" class="form-label required fs-6 fw-bold mb-2 d-flex align-items-center">{{ __('Licensure') }}</label>
                                <div class="card">
                                    <div class="card-body">
                                        <x-dashboard.upload-image-inp  name="licensure" :image="null" :directory="null" placeholder="default.svg" type="editable" ></x-dashboard.upload-image-inp>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="fv-row mb-2 fv-plugins-icon-container">
                        <label for="name_inp" class="form-label required fs-6 fw-bold mb-3">{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control form-control-lg form-control" id="name_inp" placeholder="{{ __('Vendor name') }}" >
                        <div class="fv-plugins-message-container invalid-feedback" id="name"></div>
                    </div>
                    <div class="fv-row mb-2 fv-plugins-icon-container">
                        <label for="email_inp" class="form-label required fs-6 fw-bold mb-3">{{ __('Email') }}</label>
                        <input type="text" name="email" autocomplete="new-password" class="form-control form-control-lg form-control" id="email_inp" placeholder="{{ __('Vendor email') }}" >
                        <div class="fv-plugins-message-container invalid-feedback" id="email"></div>
                    </div>
                    <div class="fv-row mb-2 fv-plugins-icon-container">
                        <label for="phone_inp" class="form-label required fs-6 fw-bold mb-3">{{ __('Phone') }}</label>
                        <input type="text" name="phone" class="form-control form-control-lg form-control" id="phone_inp" placeholder="0xxxxxxxx" >
                        <div class="fv-plugins-message-container invalid-feedback" id="phone"></div>
                    </div>
                    <div class="fv-row mb-2 fv-plugins-icon-container">
                        <label class="form-label fs-6 fw-bold mb-3">{{ __("Subscription") }}</label>
                        <select class="form-select form-select" data-control="select2" name="subscription_id" id="subscription-sp" data-placeholder="{{ __("Choose the subscription") }}" data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                            @foreach( $subscriptions as $subscription)
                                <option value="{{ $subscription->id }}"> {{ $subscription->price }} </option>
                            @endforeach
                        </select>
                        <div class="fv-plugins-message-container invalid-feedback" id="subscription_id"></div>
                    </div>
                    <div class="fv-row mb-2 fv-plugins-icon-container">
                        <label class="form-label fs-6 fw-bold mb-3">{{ __("Subscription end date") }}</label>
                        <div class="input-group" id="kt_td_picker_basic" data-td-target-input="nearest" data-td-target-toggle="nearest">
                            <input id="kt_td_picker_basic_input" type="text" name="subscription_end_date" id="subscription_end_date_inp" placeholder="{{ __('Pick date & time') }}" class="form-control form-control-lg " data-td-target="#kt_td_picker_basic"/>
                            <span class="input-group-text" data-td-target="#kt_td_picker_basic" data-td-toggle="datetimepicker">
                                <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span class="path2"></span></i>
                            </span>
                        </div>
                        <div class="fv-plugins-message-container invalid-feedback" id="subscription_end_date"></div>
                    </div>
                    <div class="fv-row mb-2 fv-plugins-icon-container">
                        <label for="password_inp" class="form-label fs-6 fw-bold mb-3">{{ __('Password') }}</label>
                        <!--begin::Input wrapper-->
                        <div class="position-relative mb-3" data-kt-password-meter="true">
                            <input class="form-control form-control-lg form-control" type="password" name="password" autocomplete="new-password" id="password_inp" placeholder="{{ __('Password') }}"  />
                            <!--begin::Visibility toggle-->
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                    data-kt-password-meter-control="visibility">
                                <i class="bi bi-eye-slash fs-2"></i>

                                <i class="bi bi-eye fs-2 d-none"></i>
                            </span>
                            <!--end::Visibility toggle-->
                        </div>
                        <!--end::Input wrapper-->
                        <div class="fv-plugins-message-container invalid-feedback" id="password"></div>
                    </div>
                    <div class="fv-row mb-2 fv-plugins-icon-container">
                        <label for="password_confirmation_inp" class="form-label fs-6 fw-bold mb-3">{{ __('Password confirmation') }}</label>
                        <!--begin::Input wrapper-->
                        <div class="position-relative mb-3" data-kt-password-meter="true">
                            <input class="form-control form-control-lg form-control" type="password" name="password_confirmation" autocomplete="off" id="password_confirmation_inp" placeholder="{{ __('Password') }}"  />
                            <!--begin::Visibility toggle-->
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                    data-kt-password-meter-control="visibility">
                                <i class="bi bi-eye-slash fs-2"></i>

                                <i class="bi bi-eye fs-2 d-none"></i>
                            </span>
                            <!--end::Visibility toggle-->
                        </div>
                        <!--end::Input wrapper-->
                        <div class="fv-plugins-message-container invalid-feedback" id="password_confirmation"></div>
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

    {{-- end::Add Country Modal --}}

@endsection
@push('scripts')
    <script src="{{ asset('assets/dashboard/js/global/datatable-config.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/datatables/vendors.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/global/crud-operations.js') }}"></script>

    <script>
        $(document).ready(function () {
            $("#add_btn").click(function (e) {
                new tempusDominus.TempusDominus(document.getElementById("kt_td_picker_basic"), {
                    localization: {
                        format: "yyyy-MM-dd"
                    },
                    display: {
                        viewMode: "calendar",
                        components: {
                            decades: true,
                            year: true,
                            month: true,
                            date: true,
                            hours: false,
                            minutes: false,
                            seconds: false
                        }
                    }
                });
                e.preventDefault();

                $("#form_title").text( __('Add new vendor') );
                $("[name='_method']").remove();
                $(`[name='subscription_id']`).val('').attr('selected',true);
                $(`[name='subscription_id']`).trigger('change');
                $("#crud_form").trigger('reset');
                $("#crud_form").attr('action', `/dashboard/vendors`);
                $("[for*='password']").addClass('required')
                $('.image-input-wrapper').css('background-image', `url('/placeholder_images/default.svg')`);
            });


        });
    </script>
@endpush
