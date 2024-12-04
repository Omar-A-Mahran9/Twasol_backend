@extends('dashboard.partials.master')
@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Careers - Apply-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>{{ __('Vendor Shipping Details') }}</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Body-->
                <div class="card-body p-lg-17">
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row mb-17">
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid me-0 me-lg-20">
                            <!--begin::Form-->
                            <form id="kt_careers_form" method="POST"
                                action="{{ route('dashboard.vendor.store.shipping-details', $vendor) }}"
                                data-redirection-url="{{ route('dashboard.vendors.index') }}" class="form mb-15 ajax-form">
                                <!--begin::Input group-->
                                <div class="row mb-10">
                                    <!--begin::Col-->
                                    <div class="col-md-3 fv-row">
                                        <!--begin::Label-->
                                        <label
                                            class="required fs-5 fw-semibold mb-2">{{ __('Name of pickup location') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="fform-control form-control-lg form-control"
                                            placeholder="{{ __('Enter name') }}" name="name" id="name_inp" />
                                        <!--end::Input-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="name"></div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    {{--  <div class="col-md-3 fv-row">
                                        <!--end::Label-->
                                        <label
                                            class="required fs-5 fw-semibold mb-2">{{ __('Code of pickup location') }}</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" class="fform-control form-control-lg form-control"
                                            placeholder="{{ __('This code is used when creating an order') }}"
                                            name="code" id="code_inp" />
                                        <!--end::Input-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="code"></div>
                                    </div>  --}}
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-3 fv-row">
                                        <!--end::Label-->
                                        <label
                                            class="required fs-5 fw-semibold mb-2">{{ __('Phone of pickup location') }}</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" name="phone"
                                            class="form-control form-control-lg form-control" id="phone_inp"
                                            placeholder="0xxxxxxxx">
                                        <!--end::Input-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="phone"></div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-3 fv-row">
                                        <!--end::Label-->
                                        <label
                                            class="required fs-5 fw-semibold mb-2">{{ __('City name of pickup location') }}</label>
                                        <!--end::Label-->

                                        <select class="form-select " data-control="select2" id="city_id_inp"
                                            data-placeholder="{{ __('Choose the city') }}" name="city_id"
                                            data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                            <option value="" selected></option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"> {{ $city->name }} </option>
                                            @endforeach
                                        </select>
                                        <div class="fv-plugins-message-container invalid-feedback" id="city_id"></div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-3 fv-row">
                                        <!--begin::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">{{ __('Country code') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="fform-control form-control-lg form-control"
                                            placeholder="{{ __('Ex: SA, AE etc.') }}" name="country_code"
                                            id="country_code_inp" />
                                        <!--end::Input-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="country_code"></div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-10">
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <!--end::Label-->
                                        <label
                                            class="required fs-5 fw-semibold mb-2">{{ __('Street address of pickup location') }}</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" class="fform-control form-control-lg form-control"
                                            placeholder="{{ __('Enter the address') }}" name="street_address"
                                            id="street_address_inp" />
                                        <!--end::Input-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="street_address">
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <!--end::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">{{ __('Contact name') }}</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" class="fform-control form-control-lg form-control"
                                            placeholder="{{ __('Enter name') }}" name="contact_name"
                                            id="contact_name_inp" />
                                        <!--end::Input-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="contact_name"></div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <!--end::Label-->
                                        <label class="required fs-5 fw-semibold mb-2">{{ __('Contact email') }}</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" class="fform-control form-control-lg form-control"
                                            placeholder="{{ __('Enter email') }}" name="contact_email"
                                            id="contact_email_inp" />
                                        <!--end::Input-->
                                        <div class="fv-plugins-message-container invalid-feedback" id="contact_email"></div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-5">
                                    <!-- begin :: Column -->
                                    <div class="col-md-12 fv-row">
                                        <label
                                            class="required fs-5 fw-semibold mb-2">{{ __('Pickup your location') }}</label>

                                        <div class="text-center">
                                            <div class="my-3" id="googleMap"
                                                style="width: 100%;min-height:300px;border:1px solid #009EF7; border-radius: 10px;">
                                                <!--Google map will be embedded here-->
                                            </div>
                                            <input type="hidden" id="lat_inp" name="lat">
                                            <input type="hidden" id="lng_inp" name="lng">
                                            <p class="invalid-feedback" id="lat"></p>
                                        </div>
                                    </div>
                                    <!-- end   :: Column -->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Separator-->
                                <div class="separator mb-8"></div>
                                <!--end::Separator-->
                                <!--begin::Submit-->
                                <button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">{{ __('Save') }}</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">{{ __('Please wait...') }}
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                                <!--end::Submit-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Layout-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Careers - Apply-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection
@push('scripts')
    <script>
        let lat = 24.7136;
        let lng = 46.6753;
        const isEditPage = false;
        const isShowPage = false;
    </script>
    <script src="{{ asset('assets/dashboard/js/map_create.js') }}"></script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDu4T0sSqqn87uvqXHcUbbWpxt4NVyBW6w&loading=async&libraries=drawing&callback=myMap&&language=ar&region=SA">
    </script>
@endpush
