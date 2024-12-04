@extends('dashboard.partials.master')
@section('content')
    @include('dashboard.partials.settings-nav')

    <!--begin::Form-->
    <form  class="form d-flex flex-column flex-lg-row ajax-form" action="{{ route('dashboard.settings.general.terms') }}" method="post" data-success-callback="onAjaxSuccess" data-hide-alert="true">
        @csrf
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            @include('dashboard.partials.main-settings-nav')
            <!--begin::Tab content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div class="tab-pane fade show active" id="settings_terms" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!--begin::Inventory-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ __('الشروط وسياسة الإستخدام') }}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10 row">
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="form-label">{{ __('الشروط والاحكام بالعربية') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea class="form-control" name="terms_ar" id="terms_ar_inp" rows="11" data-kt-autosize="true" placeholder="{{ __('الشروط والاحكام') }}">{{ setting('terms_ar') }}</textarea>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="terms_ar"></div>
                                        <!--end::Description-->
                                    </div>
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="form-label">{{ __('الشروط والاحكام بالإنجليزية') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea class="form-control" name="terms_en" id="terms_en_inp" rows="11" data-kt-autosize="true" placeholder="{{ __('الشروط والاحكام') }}">{{ setting('terms_en') }}</textarea>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="terms_en"></div>
                                        <!--end::Description-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 row">
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="form-label">{{ __('سياسة الخصوصية بالعربي') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea class="form-control" name="privacy_ar" id="privacy_ar_inp" rows="11" data-kt-autosize="true" placeholder="{{ __('سياسة الخصوصية') }}">{{ setting('privacy_ar') }}</textarea>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="privacy_ar"></div>
                                        <!--end::Description-->
                                    </div>
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="form-label">{{ __('سياسة الخصوصية بالإنجليزية') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea class="form-control" name="privacy_en" id="privacy_en_inp" rows="11" data-kt-autosize="true" placeholder="{{ __('سياسة الخصوصية') }}">{{ setting('privacy_en') }}</textarea>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="privacy_en"></div>
                                        <!--end::Description-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::Inventory-->
                    </div>
                </div>
                <!--end::Tab pane-->
            </div>
            <!--end::Tab content-->
            <div class="d-flex justify-content-end">
                <!--begin::Button-->
                <button type="submit" id="submit" class="btn btn-primary">
                    <span class="indicator-label"> {{ __('حفظ البيانات') }}</span>
                    <span class="indicator-progress"> {{ __('يرجى الانتظار...') }}
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <!--end::Button-->
            </div>
        </div>
        <!--end::Main column-->
    </form>
    <!--end::Form-->
@endsection

@push('scripts')
    <script>
        window['onAjaxSuccess'] = () => {
            soundStatus = $("[name='sound_status']:checked").val();
            showToast();
        }
    </script>
@endpush
