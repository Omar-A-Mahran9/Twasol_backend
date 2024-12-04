@extends('vendor-dashboard.partials.master')
@section('breadcrumbs')
    {{ Breadcrumbs::render('vendor-profile') }}
@endsection
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Navbar-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap">
                        <!--begin: Pic-->
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img src="{{ $vendor->logo_path }}" alt="image" />
                                <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $vendor->name }}</a>
                                        <a href="#">
                                            <i class="ki-outline ki-verify fs-1 text-primary"></i>
                                        </a>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                        <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                        <i class="bi bi-telephone-plus fs-4 me-1"></i>{{ $vendor->phone }}</a>
                                        <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                        <i class="bi bi-pin-map fs-4 me-1"></i>{{ $vendor->address }}</a>
                                        <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                        <i class="bi bi-mailbox fs-4 me-1"></i>{{ $vendor->email }}</a>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </div>
                            <!--end::Title-->
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <!--begin::Stats-->
                                    <div class="d-flex flex-wrap">
                                        <!--begin::Stat-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i>
                                                <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $totalOrdersPrice }}" data-kt-countup-prefix="$">0</div>
                                            </div>
                                            <!--end::Number-->
                                            <!--begin::Label-->
                                            <div class="fw-semibold fs-6 text-gray-400">{{ __('Orders earnings') }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->
                                        <!--begin::Stat-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-arrow-down fs-3 text-danger me-2"></i>
                                                <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $vendor->order_items_count }}">0</div>
                                            </div>
                                            <!--end::Number-->
                                            <!--begin::Label-->
                                            <div class="fw-semibold fs-6 text-gray-400">{{ __('Fast orders counter') }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->
                                        <!--begin::Stat-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i>
                                                <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $completedOrdersPercentageRate }}" data-kt-countup-prefix="%">0</div>
                                            </div>
                                            <!--end::Number-->
                                            <!--begin::Label-->
                                            <div class="fw-semibold fs-6 text-gray-400">{{ __('Success orders Rate') }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                </div>
            </div>
            <!--end::Navbar-->
            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">{{ __('Profile Details') }}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form id="kt_account_profile_details_form" class="ajax-form" method="POST" action="{{ route('vendor.update-profile-info') }}">
                        @csrf
                        @method('PUT')
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="row mb-10">
                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <!--begin::Label-->
                                    <label class="form-label required fs-6 fw-bold mb-2 d-flex align-items-center">{{ __('Logo') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline">
                                        <x-dashboard.upload-image-inp  name="logo" :image="null" :directory="null" placeholder="default.svg" type="editable" ></x-dashboard.upload-image-inp>
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Hint-->
                                    <div class="form-text">{{ __('Allowed file types: png, jpg, jpeg.') }}</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <!--begin::Label-->
                                    <label class="form-label required fs-6 fw-bold mb-2 d-flex align-items-center">{{ __('Commercial register') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline">
                                        <x-dashboard.upload-image-inp  name="commercial_register" :image="null" :directory="null" placeholder="default.svg" type="editable" ></x-dashboard.upload-image-inp>
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Hint-->
                                    <div class="form-text">{{ __('Allowed file types: png, jpg, jpeg.') }}</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <!--begin::Label-->
                                    <label class="form-label required fs-6 fw-bold mb-2 d-flex align-items-center">{{ __('Cover') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline">
                                        <x-dashboard.upload-image-inp  name="cover" :image="null" :directory="null" placeholder="default.svg" type="editable" ></x-dashboard.upload-image-inp>
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Hint-->
                                    <div class="form-text">{{ __('Allowed file types: png, jpg, jpeg.') }}</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <!--begin::Label-->
                                    <label class="form-label required fs-6 fw-bold mb-2 d-flex align-items-center">{{ __('Licensure') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline">
                                        <x-dashboard.upload-image-inp  name="licensure" :image="null" :directory="null" placeholder="default.svg" type="editable" ></x-dashboard.upload-image-inp>
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Hint-->
                                    <div class="form-text">{{ __('Allowed file types: png, jpg, jpeg.') }}</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Full Name') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-12 fv-row">
                                            <input type="text" name="name" id="name_inp" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __('Full Name') }}" value="{{ $vendor->name }}" />
                                            <div class="fv-plugins-message-container invalid-feedback" id="name"></div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Address') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="address" id="address_inp" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Address') }}" value="{{ $vendor->address }}" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="address"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                    <span class="required">{{ __('Phone') }}</span>
                                    <span class="ms-1" data-bs-toggle="tooltip" title="Phone number must be active">
                                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                    </span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="tel" name="phone" id="phone_inp" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Phone') }}" value="{{ $vendor->phone }}" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="phone"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Commercial register number') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="commercial_register_number" id="commercial_register_number_inp" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Commercial register number') }}" value="{{ $vendor->commercial_register_number }}" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="commercial_register_number"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('National ID') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="national_id" id="national_id_inp" class="form-control form-control-lg form-control-solid" placeholder="{{ __('National ID') }}" value="{{ $vendor->national_id }}" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="national_id"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __("Description in Arabic") }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <textarea class="form-control form-control-lg form-control-solid" name="description_ar" id="description_ar_inp" placeholder="{{ __('Description in Arabic') }}" data-kt-autosize="true">{{ $vendor->description_ar }}</textarea>
                                    <div class="fv-plugins-message-container invalid-feedback" id="description_ar"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __("Description in English") }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <textarea class="form-control form-control-lg form-control-solid" name="description_en" id="description_en_inp" placeholder="{{ __('Description in English') }}" data-kt-autosize="true">{{ $vendor->description_en }}</textarea>
                                    <div class="fv-plugins-message-container invalid-feedback" id="description_en"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit" style="background-color: #DEB893">{{ __('Save Changes') }}</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic info-->
            <!--begin::Sign-in Method-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_signin_method">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">{{ __('Sign-in Method') }}</h3>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_signin_method" class="collapse show">
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Email Address-->
                        <div class="d-flex flex-wrap align-items-center">
                            <!--begin::Label-->
                            <div id="kt_signin_email">
                                <div class="fs-6 fw-bold mb-1">{{ __('Email Address') }}</div>
                                <div class="fw-semibold text-gray-600">{{ $vendor->email }}</div>
                            </div>
                            <!--end::Label-->
                            <!--begin::Edit-->
                            <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                                <!--begin::Form-->
                                <form id="kt_signin_change_email" class="ajax-form" method="POST" action="{{ route('vendor.update-profile-email') }}" novalidate="novalidate">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-6">
                                        <div class="col-lg-6 mb-4 mb-lg-0">
                                            <div class="fv-row mb-0">
                                                <label for="emailaddress" class="form-label fs-6 fw-bold mb-3">{{ __('Enter New Email Address') }}</label>
                                                <input type="email" name="email" id="email_inp" class="form-control form-control-lg form-control-solid" id="emailaddress" placeholder="{{ __('Enter New Email Address') }}" name="email" value="{{ $vendor->email }}" />
                                                <div class="fv-plugins-message-container invalid-feedback" id="email"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="fv-row mb-0">
                                                <label for="confirmemailpassword" class="form-label fs-6 fw-bold mb-3">{{ __('Confirm Password') }}</label>
                                                <input type="password" name="confirm_email_password" id="confirm_email_password_inp" class="form-control form-control-lg form-control-solid" />
                                                <div class="fv-plugins-message-container invalid-feedback" id="confirm_email_password"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary me-2 px-6" style="background-color: #DEB893">{{ __('Update Email') }}</button>
                                        <button id="kt_signin_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">{{ __('Cancel') }}</button>
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Edit-->
                            <!--begin::Action-->
                            <div id="kt_signin_email_button" class="ms-auto">
                                <button class="btn btn-light btn-active-light-primary">{{ __('Change Email') }}</button>
                            </div>
                            <!--end::Action-->
                        </div>
                        <!--end::Email Address-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-6"></div>
                        <!--end::Separator-->
                        <!--begin::Password-->
                        <div class="d-flex flex-wrap align-items-center mb-10">
                            <!--begin::Label-->
                            <div id="kt_signin_password">
                                <div class="fs-6 fw-bold mb-1">{{ __('Password') }}</div>
                                <div class="fw-semibold text-gray-600">************</div>
                            </div>
                            <!--end::Label-->
                            <!--begin::Edit-->
                            <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                <!--begin::Form-->
                                <form id="kt_signin_change_password" class="ajax-form" method="POST" action="{{ route('vendor.update-profile-password') }}" novalidate="novalidate">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-1">
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="currentpassword" class="form-label fs-6 fw-bold mb-3">{{ __('Current Password') }}</label>
                                                <input type="password" class="form-control form-control-lg form-control-solid" name="current_password" id="current_password_inp" />
                                                <div class="fv-plugins-message-container invalid-feedback" id="current_password"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="newpassword" class="form-label fs-6 fw-bold mb-3">{{ __('New Password') }}</label>
                                                <input type="password" class="form-control form-control-lg form-control-solid" name="password" id="password_inp" />
                                                <div class="fv-plugins-message-container invalid-feedback" id="password"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="confirmpassword" class="form-label fs-6 fw-bold mb-3">{{ __('Confirm New Password') }}</label>
                                                <input type="password" class="form-control form-control-lg form-control-solid" name="password_confirmation" id="password_confirmation_inp" />
                                                <div class="fv-plugins-message-container invalid-feedback" id="password_confirmation"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-text mb-5">{{ __('Password must be at least 12 character and contain symbols') }}</div>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary me-2 px-6" style="background-color: #DEB893">{{ __('Update Password') }}</button>
                                        <button id="kt_password_cancel" type="button" class="btn btn-color-gray-400 btn-active-light-primary px-6">{{ __('Cancel') }}</button>
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Edit-->
                            <!--begin::Action-->
                            <div id="kt_signin_password_button" class="ms-auto">
                                <button class="btn btn-light btn-active-light-primary">{{ __('Reset Password') }}</button>
                            </div>
                            <!--end::Action-->
                        </div>
                        <!--end::Password-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Sign-in Method-->
        </div>
        <!--end::Content container-->
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('assets/vendor-dashboard/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendor-dashboard/js/custom/account/settings/signin-methods.js') }}"></script>
        <script src="{{ asset('assets/vendor-dashboard/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
    <script>
        var logo  = `{{ $vendor->logo_path }}`;
        var cover = `{{ $vendor->cover_path }}`;
        var commercial_register  = `{{ $vendor->commercial_register_image_path }}`;
        var licensure  = `{{ $vendor->licensure_image_path }}`;
        $(document).ready(function () {
            $('#logo_inp').css('background-image', `url('${logo}')`);
            $('#cover_inp').css('background-image', `url('${cover}')`);
            $('#commercial_register_inp').css('background-image', `url('${commercial_register}')`);
            $('#licensure_inp').css('background-image', `url('${licensure}')`);
        });
    </script>
@endpush
