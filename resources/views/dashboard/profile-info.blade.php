@extends('dashboard.partials.master')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_profile_details" aria-expanded="true"
                    aria-controls="kt_account_profile_details">
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
                    <form id="kt_account_profile_details_form" class="ajax-form" method="POST"
                        action="{{ route('dashboard.update-profile-info') }}">
                        @csrf
                        @method('PUT')
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Name') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-12 fv-row">
                                            <input type="text" name="name" id="name_inp"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                placeholder="{{ __('Name') }}" value="{{ $admin->name }}" />
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
                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                    <span class="required">{{ __('Phone') }}</span>
                                    <span class="ms-1" data-bs-toggle="tooltip" title="Phone number must be active">
                                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                    </span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <div class="input-group input-group-solid mb-5">
                                        <span class="input-group-text">+966</span>
                                        <input type="tel" name="phone" id="phone_inp"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="{{ __('Phone') }}" value="{{ $admin->phone }}" />
                                        <div class="fv-plugins-message-container invalid-feedback" id="phone"></div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit"
                                style="background-color: #DEB893">{{ __('Save Changes') }}</button>
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
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_signin_method">
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
                                <div class="fw-semibold text-gray-600"></div>
                            </div>
                            <!--end::Label-->
                            <!--begin::Edit-->
                            <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                                <!--begin::Form-->
                                <form id="kt_signin_change_email" class="ajax-form" method="POST"
                                    action="{{ route('dashboard.update-profile-email') }}" novalidate="novalidate">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-6">
                                        <div class="col-lg-6 mb-4 mb-lg-0">
                                            <div class="fv-row mb-0">
                                                <label for="emailaddress"
                                                    class="form-label fs-6 fw-bold mb-3">{{ __('Enter New Email Address') }}</label>
                                                <input type="email" name="email" id="email_inp"
                                                    class="form-control form-control-lg form-control-solid"
                                                    id="emailaddress" placeholder="{{ __('Enter New Email Address') }}"
                                                    name="email" value="{{ $admin->email }}" />
                                                <div class="fv-plugins-message-container invalid-feedback" id="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="fv-row mb-0">
                                                <label for="confirmemailpassword"
                                                    class="form-label fs-6 fw-bold mb-3">{{ __('Confirm Password') }}</label>
                                                <input type="password" name="confirm_email_password"
                                                    id="confirm_email_password_inp"
                                                    class="form-control form-control-lg form-control-solid" />
                                                <div class="fv-plugins-message-container invalid-feedback"
                                                    id="confirm_email_password"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary me-2 px-6"
                                            style="background-color: #DEB893">{{ __('Update Email') }}</button>
                                        <button id="kt_signin_cancel" type="button"
                                            class="btn btn-color-gray-400 btn-active-light-primary px-6">{{ __('Cancel') }}</button>
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
                                <form id="kt_signin_change_password" class="ajax-form" method="POST"
                                    action="{{ route('dashboard.update-profile-password') }}" novalidate="novalidate">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-1">
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="currentpassword"
                                                    class="form-label fs-6 fw-bold mb-3">{{ __('Current Password') }}</label>
                                                <input type="password"
                                                    class="form-control form-control-lg form-control-solid"
                                                    name="current_password" id="current_password_inp" />
                                                <div class="fv-plugins-message-container invalid-feedback"
                                                    id="current_password"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="newpassword"
                                                    class="form-label fs-6 fw-bold mb-3">{{ __('New Password') }}</label>
                                                <input type="password"
                                                    class="form-control form-control-lg form-control-solid"
                                                    name="password" id="password_inp" />
                                                <div class="fv-plugins-message-container invalid-feedback" id="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="confirmpassword"
                                                    class="form-label fs-6 fw-bold mb-3">{{ __('Confirm New Password') }}</label>
                                                <input type="password"
                                                    class="form-control form-control-lg form-control-solid"
                                                    name="password_confirmation" id="password_confirmation_inp" />
                                                <div class="fv-plugins-message-container invalid-feedback"
                                                    id="password_confirmation"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-text mb-5">
                                        {{ __('Password must be at least 12 character and contain symbols') }}</div>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-primary me-2 px-6"
                                            style="background-color: #DEB893">{{ __('Update Password') }}</button>
                                        <button id="kt_password_cancel" type="button"
                                            class="btn btn-color-gray-400 btn-active-light-primary px-6">{{ __('Cancel') }}</button>
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
    <script src="{{ asset('assets/dashboard/js/custom/account/settings/signin-methods.js') }}"></script>
@endpush
