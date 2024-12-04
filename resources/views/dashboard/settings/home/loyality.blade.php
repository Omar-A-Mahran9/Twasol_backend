@extends('dashboard.partials.master')
@section('content')
    @include('dashboard.partials.settings-nav')

    <!--begin::Form-->
    <form class="form d-flex flex-column flex-lg-row ajax-form" action="{{ route('dashboard.settings.home.loyality') }}"
        method="post" data-success-callback="onAjaxSuccess" data-hide-alert="true">
        @csrf
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            @include('dashboard.partials.settings-home-nav')
            <!--begin::Tab content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div class="tab-pane fade show active" id="settings_loyality" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!--begin::Inventory-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ __('loyalty and rewards program') }}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10 row">
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="form-label">{{ __('loyalty and rewards program in arabic') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea name="loyality_ar" id="loyality_ar_inp" data-kt-autosize="true"
                                            placeholder="{{ __('loyalty and rewards program in arabic') }}" class="tox-target">
                                            {{ setting('loyality_ar') }}
                                            </textarea>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="loyality_ar">
                                        </div>
                                        <!--end::Description-->
                                    </div>
                                    <div class="col-lg-6">
                                        <!--begin::Label-->
                                        <label class="form-label">{{ __('loyalty and rewards program in english') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->
                                        <textarea name="loyality_en" id="loyality_en_inp" data-kt-autosize="true"
                                            placeholder="{{ __('loyalty and rewards program in english') }}" class="tox-target">
                                            {{ setting('loyality_en') }}
                                            </textarea>
                                        <!--end::Editor-->
                                        <!--begin::Description-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="loyality_an">
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
            selector: "#loyality_ar_inp",
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
            selector: "#loyality_en_inp",
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
