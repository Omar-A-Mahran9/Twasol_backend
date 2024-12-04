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
            <form id="kt_account_profile_details_form" class="ajax-form" method="POST"
                action="{{ route('dashboard.sliders.update', $slider) }}"
                data-redirection-url="{{ route('dashboard.sliders.index') }}">
                @csrf
                @method('PUT')
                <!--begin::Basic info-->
                <div class="card mb-5 mb-xl-10">

                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_profile_details" aria-expanded="true"
                        aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">{{ __('Edit slider') }}</h3>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Input group-->
                        <div class="fv-row d-flex">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack">
                                <!--begin::Label-->
                                <div class="me-5">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold">{{ __('Visible on the slider') . ' ?' }}</label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Switch-->
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <!-- Hidden input to send '0' if checkbox is disabled -->
                                    <input type="hidden" name="status" value="0">

                                    <!--begin::Input-->
                                    <input class="form-check-input" name="status" type="checkbox" value="1"
                                        id="kt_modal_add_customer_billing"
                                        {{ $slider->status ? 'checked="checked"' : '' }} />
                                    <!--end::Input-->
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <span class="form-check-label fw-semibold text-muted"
                                        for="kt_modal_add_customer_billing">{{ __('Yes') }}</span>
                                    <!--end::Label-->
                                </label>
                                <!--end::Switch-->
                            </div>
                            <!--begin::Wrapper-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->

                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="row mb-10" style="display: flex;justify-content: center;flex-wrap: nowrap;">
                                <!--begin::Col-->
                                <div class="col-md-3 ">
                                    <!--begin::Label-->
                                    <label
                                        class="form-label required fs-6 fw-bold mb-2 d-flex align-items-center">{{ __('BackGround') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline">
                                        <x-dashboard.upload-image-inp name="background" :image="$slider->background"
                                            directory="Sliders" placeholder="default.svg"
                                            type="editable"></x-dashboard.upload-image-inp>
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
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Title in Arabic') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-12 fv-row">
                                            <input type="text" name="title_ar" id="title_ar_inp"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                placeholder="{{ __('Title in Arabic') }}"
                                                value="{{ $slider->title_ar }}" />
                                            <div class="fv-plugins-message-container invalid-feedback" id="title_ar"></div>
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
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Title in English') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-12 fv-row">
                                            <input type="text" name="title_en" id="title_en_inp"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                placeholder="{{ __('Title in English') }}"
                                                value="{{ $slider->title_en }}" />
                                            <div class="fv-plugins-message-container invalid-feedback" id="title_en"></div>
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
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Description in Arabic') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <textarea class="form-control form-control-lg form-control-solid" name="description_ar" id="description_ar_inp"
                                        placeholder="{{ __('Description in Arabic') }}" data-kt-autosize="true">{{ $slider->description_ar }}</textarea>
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
                                        placeholder="{{ __('Description in English') }}" data-kt-autosize="true">{{ $slider->description_en }}</textarea>
                                    <div class="fv-plugins-message-container invalid-feedback" id="description_en"></div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Button name in Arabic') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-12 fv-row">
                                            <input type="text" name="btn_title_ar" id="btn_title_ar_inp"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                placeholder="{{ __('Button name in Arabic') }}"
                                                value="{{ $slider->btn_title_ar }}" />
                                            <div class="fv-plugins-message-container invalid-feedback" id="btn_title_ar">
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
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Button name in English') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-12 fv-row">
                                            <input type="text" name="btn_title_en" id="btn_title_en_inp"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                placeholder="{{ __('Button name in English') }}"
                                                value="{{ $slider->btn_title_en }}" />
                                            <div class="fv-plugins-message-container invalid-feedback" id="btn_title_en">
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
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Button link') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="btn_link" id="btn_link_inp"
                                        class="form-control form-control-lg form-control-solid"
                                        placeholder="{{ __('Button link') }}" value="{{ $slider->btn_link }}" />
                                    <div class="fv-plugins-message-container invalid-feedback" id="btn_link"></div>
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
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Basic info-->
            </form>
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection
@push('scripts')
    {{--  <script>
        var logo = `{{ $slider->full_image_path }}`;
        $(document).ready(function() {
            $('#background_inp').css('background-image', `url('${logo}')`);
        });
    </script>  --}}
@endpush
