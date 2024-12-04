@extends('dashboard.partials.master')
@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">

            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-3 mb-5 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <div class="card h-lg-40">
                        <!--begin::Body-->
                        <div
                            class="card-body d-flex justify-content-start  gap-5 align-items-start align-items-center flex-row ">
                            <!--begin::Icon-->
                            <div class="m-0">
                                <i class="ki-outline ki-book fs-2hx text-gray-600"></i>
                            </div>
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div class="d-flex flex-column justify-content-start align-items-start">
                                <!--begin::Number-->
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">+{{ $orderPlaced }}</span>
                                <!--end::Number-->
                                <!--begin::Follower-->
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-500">{{ __('Booking number') }}</span>
                                </div>
                                <!--end::Follower-->
                            </div>
                            <!--end::Section-->

                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-3 mb-5 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <div class="card h-lg-40">
                        <!--begin::Body-->
                        <div
                            class="card-body d-flex justify-content-start  gap-5 align-items-start align-items-center flex-row ">
                            <!--begin::Icon-->
                            <div class="m-0">
                                <i class="ki-outline ki-dollar fs-2hx text-gray-600"></i>
                            </div>
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div class="d-flex flex-column justify-content-start align-items-start">
                                <!--begin::Number-->
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">+{{ $orderPlaced }}</span>
                                <!--end::Number-->
                                <!--begin::Follower-->
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-500">{{ __('earnings') }}</span>
                                </div>
                                <!--end::Follower-->
                            </div>
                            <!--end::Section-->

                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-sm-6 col-xl-3 mb-5 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <div class="card h-lg-40">
                        <!--begin::Body-->
                        <div
                            class="card-body d-flex justify-content-start  gap-5 align-items-start align-items-center flex-row ">
                            <!--begin::Icon-->
                            <div class="m-0">
                                <i class="ki-outline ki-car-3 fs-2hx text-gray-600"></i>
                            </div>
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div class="d-flex flex-column justify-content-start align-items-start">
                                <!--begin::Number-->
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">+{{ $orderPlaced }}</span>
                                <!--end::Number-->
                                <!--begin::Follower-->
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-500">{{ __('Drivers count') }}</span>
                                </div>
                                <!--end::Follower-->
                            </div>
                            <!--end::Section-->

                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-sm-6 col-xl-3 mb-5 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <div class="card h-lg-40">
                        <!--begin::Body-->
                        <div
                            class="card-body d-flex justify-content-start  gap-5 align-items-start align-items-center flex-row ">
                            <!--begin::Icon-->
                            <div class="m-0">
                                <i class="ki-outline ki-people fs-2hx text-gray-600"></i>
                            </div>
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div class="d-flex flex-column justify-content-start align-items-start">
                                <!--begin::Number-->
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">+{{ $orderPlaced }}</span>
                                <!--end::Number-->
                                <!--begin::Follower-->
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-500">{{ __('support passengers count') }}</span>
                                </div>
                                <!--end::Follower-->
                            </div>
                            <!--end::Section-->

                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->



            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection
