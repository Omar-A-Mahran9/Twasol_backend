@extends('dashboard.partials.master')
@section('content')
    @include('dashboard.partials.settings-nav')

    <!--begin::Form-->
    <form class="form d-flex flex-column flex-lg-row ajax-form" action="{{ route('dashboard.settings.home.about-us') }}"
        method="post" data-success-callback="onAjaxSuccess" data-hide-alert="true">
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
                                    <h2>{{ __('About us') }}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10 row">
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="form-label">{{ __('Label in arabic') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <input class="form-control" value="{{ setting('label_ar') }}" name="label_ar"
                                            id="label_ar_inp" placeholder="{{ __('Label in arabic') }}" />
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="label_ar"></div>
                                        <!--end::Description-->
                                    </div>
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="form-label">{{ __('Label in english') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <input class="form-control" value="{{ setting('label_en') }}" name="label_en"
                                            id="label_en_inp" placeholder="{{ __('Label in english') }}" />
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="label_en"></div>
                                        <!--end::Description-->
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10 row">
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="form-label">{{ __('About us in arabic') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea name="about_us_ar" id="about_us_ar_inp" data-kt-autosize="true" placeholder="{{ __('About us in arabic') }}"
                                            class="tox-target">
                                            {{ setting('about_us_ar') }}
                                            </textarea>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="about_us_ar"></div>
                                        <!--end::Description-->
                                    </div>
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="form-label">{{ __('About us in english') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea name="about_us_en" id="about_us_en_inp" data-kt-autosize="true" placeholder="{{ __('About us in english') }}"
                                            class="tox-target">
                                            {{ setting('about_us_en') }}
                                            </textarea>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="about_us_en"></div>
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
                    <span class="indicator-label"> {{ __('Save') }}</span>
                    <span class="indicator-progress"> {{ __('Please wait...') }}
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
    <script src="{{ asset('assets/dashboard/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script>
        window['onAjaxSuccess'] = () => {
            soundStatus = $("[name='sound_status']:checked").val();
            showToast();
        }
    </script>
    <script>
        let language = locale == 'en' ? 'ltr' : 'rtl';
        tinymce.init({
            selector: "#about_us_ar_inp",
            height: "480",
            menubar: false,
            toolbar: ["styleselect",
                "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
                "bullist numlist | outdent indent | ltr rtl | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code"
            ],
            directionality: language, // Set the initial direction to RTL if needed
            plugins: "advlist autolink link image lists charmap print preview code directionality"
        });
        tinymce.init({
            selector: "#about_us_en_inp",
            height: "480",
            menubar: false,
            toolbar: ["styleselect",
                "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
                "bullist numlist | outdent indent | ltr rtl | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code"
            ],
            directionality: language, // Set the initial direction to RTL if needed
            plugins: "advlist autolink link image lists charmap print preview code directionality"
        });
    </script>
@endpush
