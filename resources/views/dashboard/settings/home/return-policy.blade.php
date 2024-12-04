@extends('dashboard.partials.master')
@section('content')
    @include('dashboard.partials.settings-nav')

    <!--begin::Form-->
    <form class="form d-flex flex-column flex-lg-row ajax-form" action="{{ route('dashboard.settings.home.return-policy') }}"
        method="post" data-success-callback="onAjaxSuccess" data-hide-alert="true">
        @csrf
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            @include('dashboard.partials.settings-home-nav')
            <!--begin::Tab content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div class="tab-pane fade show active" id="settings_return_policy" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!--begin::Inventory-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ __('Return Policy') }}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10 row">
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="form-label">{{ __('Return policy in arabic') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea name="return_policy_ar" id="return_policy_ar_inp" data-kt-autosize="true"
                                            placeholder="{{ __('Return policy in arabic') }}" class="tox-target">
                                            {{ setting('return_policy_ar') }}
                                            </textarea>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="return_policy_ar">
                                        </div>
                                        <!--end::Description-->
                                    </div>
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="form-label">{{ __('Return policy in english') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea name="return_policy_en" id="return_policy_en_inp" data-kt-autosize="true"
                                            placeholder="{{ __('Return policy in english') }}" class="tox-target">
                                            {{ setting('return_policy_en') }}
                                            </textarea>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="return_policy_en">
                                        </div>
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
            selector: "#return_policy_ar_inp",
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
            selector: "#return_policy_en_inp",
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
