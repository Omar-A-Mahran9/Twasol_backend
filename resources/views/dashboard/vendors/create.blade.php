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
            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_profile_details" aria-expanded="true"
                    aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">{{ __('Create vendor') }}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form id="kt_account_profile_details_form" class="ajax-form" method="POST"
                        action="{{ route('dashboard.vendors.store') }}"
                        data-redirection-url="{{ route('dashboard.vendors.index') }}">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="row mb-10">
                                <!--begin::Col-->
                                <div class="col-md-3">
                                    <!--begin::Label-->
                                    <label
                                        class="form-label required fs-6 fw-bold mb-2 d-flex align-items-center">{{ __('Logo') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline">
                                        <x-dashboard.upload-image-inp name="logo" :image="null" :directory="null"
                                            placeholder="default.svg" type="editable"></x-dashboard.upload-image-inp>
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
                                    <label
                                        class="form-label required fs-6 fw-bold mb-2 d-flex align-items-center">{{ __('Commercial register') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline">
                                        <x-dashboard.upload-image-inp name="commercial_register" :image="null"
                                            :directory="null" placeholder="default.svg"
                                            type="editable"></x-dashboard.upload-image-inp>
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
                                    <label
                                        class="form-label required fs-6 fw-bold mb-2 d-flex align-items-center">{{ __('Cover') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline">
                                        <x-dashboard.upload-image-inp name="cover" :image="null" :directory="null"
                                            placeholder="default.svg" type="editable"></x-dashboard.upload-image-inp>
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
                                    <label
                                        class="form-label required fs-6 fw-bold mb-2 d-flex align-items-center">{{ __('Licensure') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline">
                                        <x-dashboard.upload-image-inp name="licensure" :image="null" :directory="null"
                                            placeholder="default.svg" type="editable"></x-dashboard.upload-image-inp>
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
                                <label
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Brand Name In Arabic') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-12 fv-row">
                                            <input type="text" name="brand_name_ar" id="brand_name_ar_inp"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                placeholder="{{ __('Brand Name In Arabic') }}" value="" />
                                            <div class="fv-plugins-message-container invalid-feedback" id="brand_name_ar">
                                            </div>
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
                                <label
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Brand Name In English') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-12 fv-row">
                                            <input type="text" name="brand_name_en" id="brand_name_en_inp"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                placeholder="{{ __('Brand Name In English') }}" value="" />
                                            <div class="fv-plugins-message-container invalid-feedback" id="brand_name_en">
                                            </div>
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
                                <label
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Full Name') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-12 fv-row">
                                            <input type="text" name="name" id="name_inp"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                placeholder="{{ __('Full Name') }}" value="" />
                                            <div class="fv-plugins-message-container invalid-feedback" id="name"></div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Description in Arabic') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <textarea class="form-control form-control-lg form-control-solid" name="description_ar" id="description_ar_inp"
                                        placeholder="{{ __('Description in Arabic') }}" data-kt-autosize="true"></textarea>
                                    <div class="fv-plugins-message-container invalid-feedback" id="description_ar"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Description in English') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <textarea class="form-control form-control-lg form-control-solid" name="description_en" id="description_en_inp"
                                        placeholder="{{ __('Description in English') }}" data-kt-autosize="true"></textarea>
                                    <div class="fv-plugins-message-container invalid-feedback" id="description_en"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Email') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-12 fv-row">
                                            <input type="text" name="email" id="email_inp"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                placeholder="{{ __('email@example.com') }}" value="" />
                                            <div class="fv-plugins-message-container invalid-feedback" id="email">
                                            </div>
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
                                <label
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Address') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="address" id="address_inp"
                                        class="form-control form-control-lg form-control-solid"
                                        placeholder="{{ __('Address') }}" value="" />
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
                                    <input type="tel" name="phone" id="phone_inp"
                                        class="form-control form-control-lg form-control-solid no-arrow"
                                        placeholder="{{ __('Phone') }}" value="" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="phone"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Commercial register number') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="commercial_register_number"
                                        id="commercial_register_number_inp"
                                        class="form-control form-control-lg form-control-solid no-arrow"
                                        placeholder="{{ __('Commercial register number') }}" value="" />
                                    <div class="fv-plugins-message-container invalid-feedback"
                                        id="commercial_register_number"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('National ID') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="national_id" id="national_id_inp"
                                        class="form-control form-control-lg form-control-solid no-arrow"
                                        placeholder="{{ __('National ID') }}" value="" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="national_id"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Bank IBAN') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="iban_number" id="iban_number_inp"
                                        class="form-control form-control-lg form-control-solid"
                                        placeholder="{{ __('Bank IBAN') }}" value="" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="iban_number"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <div class="separator separator-content border-dark my-10"><span
                                    class="w-250px fw-bold">{{ __('Categories Percentages') }}</span></div>
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Gold') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="ratio[]" id="ratio_0_inp"
                                        class="form-control form-control-lg form-control-solid no-arrow"
                                        placeholder="{{ __('Gold') }}" value="" step="0.01" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="ratio_0"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Silver') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="ratio[]" id="ratio_1_inp"
                                        class="form-control form-control-lg form-control-solid no-arrow"
                                        placeholder="{{ __('Silver') }}" value="" step="0.01" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="ratio_1"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Diamond') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="ratio[]" id="ratio_2_inp"
                                        class="form-control form-control-lg form-control-solid no-arrow"
                                        placeholder="{{ __('Diamond') }}" value="" step="0.01" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="ratio_2"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Watches') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="ratio[]" id="ratio_3_inp"
                                        class="form-control form-control-lg form-control-solid no-arrow"
                                        placeholder="{{ __('Watches') }}" value="" step="0.01" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="ratio_3"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Alloys') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="ratio[]" id="ratio_4_inp"
                                        class="form-control form-control-lg form-control-solid no-arrow"
                                        placeholder="{{ __('Alloys') }}" value="" step="0.01" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="ratio_4"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <!--begin::Button-->
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">
                                    {{ __('Save Changes') }}
                                </span>
                                <span class="indicator-progress">
                                    {{ __('Please wait...') }} <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            <!--end::Button-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic info-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection
@push('scripts')
@endpush
