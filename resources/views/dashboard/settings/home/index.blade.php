@extends('dashboard.partials.master')
@section('content')
    @include('dashboard.partials.settings-nav')

    <!--begin::Form-->
    <form  class="form d-flex flex-column flex-lg-row ajax-form" action="{{ route('dashboard.settings.home-content') }}" method="post" data-success-callback="onAjaxSuccess" data-hide-alert="true">
        @csrf
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            @include('dashboard.partials.settings-home-nav')
            <!--begin::Tab content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div class="tab-pane fade show active" id="settings_about_us" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!--begin::Inventory-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ __('لماذا تختارنا') }}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10 row">
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ __('الوصف الرئيسي عربي') }}</label>
                                        <button type="button" class="btn " data-bs-toggle="tooltip" data-bs-html="true" data-bs-title='<img width=300 src="{{asset('/assets/dashboard/home-page-sections/why_choose_us_main_description_ar.jpeg') }}" alt="" srcset="">'>
                                            <i class="ki-outline ki-question-2 fs-2 text-primary"></i>
                                        </button>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea class="form-control" name="home_page[why_choose_us_main_description_ar]" id="home_page_why_choose_us_main_description_ar_inp" rows="11" data-kt-autosize="true" placeholder="{{ __('أدخل الوصف الرئيسي عربي') }}">
                                            {{ setting('home_page.why_choose_us_main_description_ar') }}
                                        </textarea>
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="home_page_why_choose_us_main_description_ar"></div>
                                        <!--end::Description-->
                                    </div>
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ __('الوصف الرئيسي انجليزي') }}</label>
                                        <button type="button" class="btn " data-bs-toggle="tooltip" data-bs-html="true" data-bs-title='<img width=300 src="{{asset('/assets/dashboard/home-page-sections/why_choose_us_main_description_en.jpeg') }}" alt="" srcset="">'>
                                            <i class="ki-outline ki-question-2 fs-2 text-primary"></i>
                                        </button>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea class="form-control" name="home_page[why_choose_us_main_description_en]" id="home_page_why_choose_us_main_description_en_inp" rows="11" data-kt-autosize="true" placeholder="{{ __('أدخل الوصف الرئيسي انجليزي') }}">
                                            {{ setting('home_page.why_choose_us_main_description_en') }}
                                        </textarea>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="home_page_why_choose_us_main_description_en"></div>
                                        <!--end::Description-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 row">
                                    <div class="col-6">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ __('العنوان عربي') }} 1</label>
                                        <button type="button" class="btn " data-bs-toggle="tooltip" data-bs-html="true" data-bs-title='<img width=300 src="{{asset('/assets/dashboard/home-page-sections/why_choose_us_title_1_ar.jpeg') }}" alt="" srcset="">'>
                                            <i class="ki-outline ki-question-2 fs-2 text-primary"></i>
                                        </button>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="home_page[why_choose_us_title_1_ar]" value="{{ setting('home_page.why_choose_us_title_1_ar') }}" class="form-control mb-2" id="home_page_why_choose_us_title_1_ar_inp" placeholder="{{ __('إدخل العنوان عربي') }}" />
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="home_page_why_choose_us_title_1_ar"></div>
                                        <!--end::Description-->
                                    </div>
                                    <div class="col-6">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ __('العنوان انجليزي') }} 1</label>
                                        <button type="button" class="btn " data-bs-toggle="tooltip" data-bs-html="true" data-bs-title='<img width=300 src="{{asset('/assets/dashboard/home-page-sections/why_choose_us_title_1_en.jpeg') }}" alt="" srcset="">'>
                                            <i class="ki-outline ki-question-2 fs-2 text-primary"></i>
                                        </button>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="home_page[why_choose_us_title_1_en]" value="{{ setting('home_page.why_choose_us_title_1_en') }}" class="form-control mb-2" id="home_page_why_choose_us_title_1_en_inp" placeholder="{{ __('إدخل العنوان انجليزي') }}" />
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="home_page_why_choose_us_title_1_en"></div>
                                        <!--end::Description-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 row">
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ __('الوصف عربي') }} 1</label>
                                        <button type="button" class="btn " data-bs-toggle="tooltip" data-bs-html="true" data-bs-title='<img width=300 src="{{asset('/assets/dashboard/home-page-sections/why_choose_us_description_1_ar.jpeg') }}" alt="" srcset="">'>
                                            <i class="ki-outline ki-question-2 fs-2 text-primary"></i>
                                        </button>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea class="form-control" name="home_page[why_choose_us_description_1_ar]" id="home_page_why_choose_us_description_1_ar_inp" rows="11" data-kt-autosize="true" placeholder="{{ __('أدخل الوصف عربي') }}">
                                            {{ setting('home_page.why_choose_us_description_1_ar') }}
                                        </textarea>
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="home_page_why_choose_us_description_1_ar"></div>
                                        <!--end::Description-->
                                    </div>
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ __('الوصف انجليزي') }} 1</label>
                                        <button type="button" class="btn " data-bs-toggle="tooltip" data-bs-html="true" data-bs-title='<img width=300 src="{{asset('/assets/dashboard/home-page-sections/why_choose_us_description_1_en.jpeg') }}" alt="" srcset="">'>
                                            <i class="ki-outline ki-question-2 fs-2 text-primary"></i>
                                        </button>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea class="form-control" name="home_page[why_choose_us_description_1_en]" id="home_page_why_choose_us_description_1_en_inp" rows="11" data-kt-autosize="true" placeholder="{{ __('أدخل الوصف عربي') }}">
                                            {{ setting('home_page.why_choose_us_description_1_en') }}
                                        </textarea>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="home_page_why_choose_us_description_1_en"></div>
                                        <!--end::Description-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 row">
                                    <div class="col-6">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ __('العنوان عربي') }} 2</label>
                                        <button type="button" class="btn " data-bs-toggle="tooltip" data-bs-html="true" data-bs-title='<img width=300 src="{{asset('/assets/dashboard/home-page-sections/why_choose_us_title_2_ar.jpeg') }}" alt="" srcset="">'>
                                            <i class="ki-outline ki-question-2 fs-2 text-primary"></i>
                                        </button>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="home_page[why_choose_us_title_2_ar]" value="{{ setting('home_page.why_choose_us_title_2_ar') }}" class="form-control mb-2" id="home_page_why_choose_us_title_2_ar_inp" placeholder="{{ __('إدخل العنوان عربي') }}" />
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="home_page_why_choose_us_title_2_ar"></div>
                                        <!--end::Description-->
                                    </div>
                                    <div class="col-6">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ __('العنوان انجليزي') }} 2</label>
                                        <button type="button" class="btn " data-bs-toggle="tooltip" data-bs-html="true" data-bs-title='<img width=300 src="{{asset('/assets/dashboard/home-page-sections/why_choose_us_title_2_en.jpeg') }}" alt="" srcset="">'>
                                            <i class="ki-outline ki-question-2 fs-2 text-primary"></i>
                                        </button>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="home_page[why_choose_us_title_2_en]" value="{{ setting('home_page.why_choose_us_title_2_en') }}" class="form-control mb-2" id="home_page_why_choose_us_title_2_en_inp" placeholder="{{ __('إدخل العنوان انجليزي') }}" />
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="home_page_why_choose_us_title_2_en"></div>
                                        <!--end::Description-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 row">
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ __('الوصف عربي') }} 2</label>
                                        <button type="button" class="btn " data-bs-toggle="tooltip" data-bs-html="true" data-bs-title='<img width=300 src="{{asset('/assets/dashboard/home-page-sections/why_choose_us_description_2_ar.jpeg') }}" alt="" srcset="">'>
                                            <i class="ki-outline ki-question-2 fs-2 text-primary"></i>
                                        </button>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea class="form-control" name="home_page[why_choose_us_description_2_ar]" id="home_page_why_choose_us_description_2_ar_inp" rows="11" data-kt-autosize="true" placeholder="{{ __('أدخل الوصف عربي') }}">
                                            {{ setting('home_page.why_choose_us_description_2_ar') }}
                                        </textarea>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="home_page_why_choose_us_description_2_ar"></div>
                                        <!--end::Description-->
                                    </div>
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ __('الوصف انجليزي') }} 2</label>
                                        <button type="button" class="btn " data-bs-toggle="tooltip" data-bs-html="true" data-bs-title='<img width=300 src="{{asset('/assets/dashboard/home-page-sections/why_choose_us_description_2_en.jpeg') }}" alt="" srcset="">'>
                                            <i class="ki-outline ki-question-2 fs-2 text-primary"></i>
                                        </button>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea class="form-control" name="home_page[why_choose_us_description_2_en]" id="home_page_why_choose_us_description_2_en_inp" rows="11" data-kt-autosize="true" placeholder="{{ __('أدخل الوصف عربي') }}">
                                            {{ setting('home_page.why_choose_us_description_2_en') }}
                                        </textarea>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="home_page_why_choose_us_description_2_en"></div>
                                        <!--end::Description-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 row">
                                    <div class="col-6">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ __('العنوان عربي') }} 3</label>
                                        <button type="button" class="btn " data-bs-toggle="tooltip" data-bs-html="true" data-bs-title='<img width=300 src="{{asset('/assets/dashboard/home-page-sections/why_choose_us_title_3_ar.jpeg') }}" alt="" srcset="">'>
                                            <i class="ki-outline ki-question-2 fs-2 text-primary"></i>
                                        </button>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="home_page[why_choose_us_title_3_ar]" value="{{ setting('home_page.why_choose_us_title_3_ar') }}" class="form-control mb-2" id="home_page_why_choose_us_title_3_ar_inp" placeholder="{{ __('إدخل العنوان عربي') }}" />
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="home_page_why_choose_us_title_3_ar"></div>
                                        <!--end::Description-->
                                    </div>
                                    <div class="col-6">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ __('العنوان انجليزي') }} 3</label>
                                        <button type="button" class="btn " data-bs-toggle="tooltip" data-bs-html="true" data-bs-title='<img width=300 src="{{asset('/assets/dashboard/home-page-sections/why_choose_us_title_3_en.jpeg') }}" alt="" srcset="">'>
                                            <i class="ki-outline ki-question-2 fs-2 text-primary"></i>
                                        </button>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="home_page[why_choose_us_title_3_en]" value="{{ setting('home_page.why_choose_us_title_3_en') }}" class="form-control mb-2" id="home_page_why_choose_us_title_3_en_inp" placeholder="{{ __('إدخل العنوان انجليزي') }}" />
                                        <!--end::Input-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="home_page_why_choose_us_title_3_en"></div>
                                        <!--end::Description-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 row">
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ __('الوصف عربي') }} 3</label>
                                        <button type="button" class="btn " data-bs-toggle="tooltip" data-bs-html="true" data-bs-title='<img width=300 src="{{asset('/assets/dashboard/home-page-sections/why_choose_us_description_3_ar.jpeg') }}" alt="" srcset="">'>
                                            <i class="ki-outline ki-question-2 fs-2 text-primary"></i>
                                        </button>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea class="form-control" name="home_page[why_choose_us_description_3_ar]" id="home_page_why_choose_us_description_3_ar_inp" rows="11" data-kt-autosize="true" placeholder="{{ __('أدخل الوصف عربي') }}">
                                            {{ setting('home_page.why_choose_us_description_3_ar') }}
                                        </textarea>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="home_page_why_choose_us_description_3_ar"></div>
                                        <!--end::Description-->
                                    </div>
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="required form-label">{{ __('الوصف انجليزي') }} 3</label>
                                        <button type="button" class="btn " data-bs-toggle="tooltip" data-bs-html="true" data-bs-title='<img width=300 src="{{asset('/assets/dashboard/home-page-sections/why_choose_us_description_3_en.jpeg') }}" alt="" srcset="">'>
                                            <i class="ki-outline ki-question-2 fs-2 text-primary"></i>
                                        </button>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea class="form-control" name="home_page[why_choose_us_description_3_en]" id="home_page_why_choose_us_description_3_en_inp" rows="11" data-kt-autosize="true" placeholder="{{ __('أدخل الوصف عربي') }}">
                                            {{ setting('home_page.why_choose_us_description_3_en') }}
                                        </textarea>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="home_page_why_choose_us_description_3_en"></div>
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
    <script src="{{ asset('assets/dashboard/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
    <script>
        window['onAjaxSuccess'] = () => {
            soundStatus = $("[name='sound_status']:checked").val();
            showToast();
        }
    </script>
@endpush
