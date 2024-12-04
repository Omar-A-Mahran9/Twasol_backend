@extends('dashboard.partials.master')
@section('content')
    @include('dashboard.partials.settings-nav')

    <!--begin::Form-->
    <form  class="form d-flex flex-column flex-lg-row ajax-form" action="{{ route('dashboard.settings.general.prices') }}" method="post" data-success-callback="onAjaxSuccess" data-hide-alert="true">
        @csrf
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            @include('dashboard.partials.main-settings-nav')
            <!--begin::Tab content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div class="tab-pane fade show active" id="settings_prices" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!--begin::Inventory-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ __('اسعار الإشتراكات') }}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10 row">
                                    <div class="col-lg-6">
                                        <h3>{{ __('الإشتراك الشهرى') }}</h3>
                                        <!--begin::Input group-->
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('السعر') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="monthly[price]" value="{{ setting('monthly.price') }}" class="form-control mb-2" id="monthly_price_inp" placeholder="{{ __('السعر') }}" />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="fv-plugins-message-container invalid-feedback" id="monthly_price"></div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('السعر بعد الخصم') }}
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="{{ __('اذا لم يكن هناك خصم اترك الحقل فارغاً') }}"></i></label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="monthly[price_after_discount]" value="{{ setting('monthly.price_after_discount') }}" class="form-control mb-2" id="monthly_price_after_discount_inp" placeholder="{{ __('السعر بعد الخصم') }}" />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="fv-plugins-message-container invalid-feedback" id="monthly_price_after_discount"></div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <div class="col-lg-6">
                                        <h3>{{ __('الإشتراك السنوى') }}</h3>
                                        <!--begin::Input group-->
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('السعر') }}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="yearly[price]" value="{{ setting('yearly.price') }}" class="form-control mb-2" id="yearly_price_inp" placeholder="{{ __('السعر') }}" />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="fv-plugins-message-container invalid-feedback" id="yearly_price"></div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('السعر بعد الخصم') }}
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="{{ __('اذا لم يكن هناك خصم اترك الحقل فارغاً') }}"></i></label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="yearly[price_after_discount]" value="{{ setting('yearly.price_after_discount') }}" class="form-control mb-2" id="yearly_price_after_discount_inp" placeholder="{{ __('السعر بعد الخصم') }}" />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="fv-plugins-message-container invalid-feedback" id="yearly_price_after_discount"></div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
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
        <script src="https://npmcdn.com/flatpickr/dist/l10n/ar.js"></script>
@endpush
