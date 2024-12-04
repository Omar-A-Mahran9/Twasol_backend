@extends('vendor-dashboard.partials.master')
@push('styles')
    <link href="{{ asset('assets/vendor-dashboard/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet"
        type="text/css" />
@endpush
@section('breadcrumbs')
    {{ Breadcrumbs::render('home') }}
@endsection
@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-12">
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-3 mb-5 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <div class="card h-lg-100">
                        <!--begin::Body-->
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <!--begin::Icon-->
                            <div class="m-0">
                                <i class="ki-outline ki-parcel fs-2hx text-gray-600"></i>
                            </div>
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div class="d-flex flex-column my-7">
                                <!--begin::Number-->
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $orderPlaced }}</span>
                                <!--end::Number-->
                                <!--begin::Follower-->
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-500">{{ __('Orders placed') }}</span>
                                </div>
                                <!--end::Follower-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Badge-->
                            <span class="badge badge-light-primary fs-base">
                                <i
                                    class="ki-outline ki-arrow-up  fs-5 text-primary ms-n1"></i>{{ $orderPlacedPrice . ' ' . __('SAR') }}</span>
                            <!--end::Badge-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-3 mb-5 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <div class="card h-lg-100">
                        <!--begin::Body-->
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <!--begin::Icon-->
                            <div class="m-0">
                                <i class="ki-outline ki-parcel fs-2hx text-gray-600"></i>
                            </div>
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div class="d-flex flex-column my-7">
                                <!--begin::Number-->
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $orderProcessing }}</span>
                                <!--end::Number-->
                                <!--begin::Follower-->
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-500">{{ __('Orders processing') }}</span>
                                </div>
                                <!--end::Follower-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Badge-->
                            <span class="badge badge-light-primary fs-base">
                                <i
                                    class="ki-outline ki-arrow-up fs-5 text-primary ms-n1"></i>{{ $orderProcessingPrice . ' ' . __('SAR') }}</span>
                            <!--end::Badge-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-3 mb-5 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <div class="card h-lg-100">
                        <!--begin::Body-->
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <!--begin::Icon-->
                            <div class="m-0">
                                <i class="ki-outline ki-parcel fs-2hx text-gray-600"></i>
                            </div>
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div class="d-flex flex-column my-7">
                                <!--begin::Number-->
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $orderDelivered }}</span>
                                <!--end::Number-->
                                <!--begin::Follower-->
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-500">{{ __('Orders delivered') }}</span>
                                </div>
                                <!--end::Follower-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Badge-->
                            <span class="badge badge-light-success fs-base">
                                <i class="fa-solid fa-arrow-up fs-5 text-success  ms-n1" style="padding-right: 3px;"></i>
                                {{ $orderDeliveredPrice . ' ' . __('SAR') }}</span>
                            <!--end::Badge-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-sm-6 col-xl-3 mb-5 mb-xl-10">
                    <!--begin::Card widget 2-->
                    <div class="card h-lg-100">
                        <!--begin::Body-->
                        <div class="card-body d-flex justify-content-between align-items-start flex-column">
                            <!--begin::Icon-->
                            <div class="m-0">
                                <i class="ki-outline ki-parcel fs-2hx text-gray-600"></i>
                            </div>
                            <!--end::Icon-->
                            <!--begin::Section-->
                            <div class="d-flex flex-column my-7">
                                <!--begin::Number-->
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{ $orderRejected }}</span>
                                <!--end::Number-->
                                <!--begin::Follower-->
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-500">{{ __('Orders rejected') }}</span>
                                </div>
                                <!--end::Follower-->
                            </div>
                            <!--end::Section-->
                            <!--begin::Badge-->
                            <span class="badge badge-light-danger fs-base">
                                <i class="fa-solid fa-arrow-down fs-5 text-danger  ms-n1" style="padding-right: 3px;"></i>
                                {{ $orderRejectedPrice . ' ' . __('SAR') }}</span>
                            <!--end::Badge-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card widget 2-->
                </div>
                <!--end::Col-->

            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::Chart widget 19-->
                    <div class="card card-flush h-100 mb-5 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">{{ __('Shipping') }}</span>
                                {{--  <span class="text-gray-400 pt-2 fw-semibold fs-6">Performance & achievements</span>  --}}
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body">

                            <!--begin::Chart container-->
                            {{--  <div class="m-0" >  --}}
                            @if ($ordersFastShipping == 0 && $ordersNormalShipping == 0)
                                <div style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                    <span>{{ __('No data available') }}</span>
                                </div>
                            @else
                                <div id="container" dir="{{ isArabic() ? 'rtl' : 'ltr' }}"
                                    style="width: 500px; height: 300px;"></div>
                            @endif
                            {{--  </div>  --}}
                            {{--  <div id="shipping_chart" class="w-100 h-350px"></div>  --}}
                            <!--end::Chart container-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 19-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-8">
                    <!--begin::Chart widget 38-->
                    <div class="card card-flush overflow-hidden h-md-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span
                                    class="card-label fw-bold text-gray-800">{{ __('Orders transactions report') }}</span>
                                {{--  <span class="text-gray-500 mt-1 fw-semibold fs-6">Counted in Millions</span>  --}}
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                                <div data-order-daterangepicker="true" data-order-daterangepicker-opens="left"
                                    class="btn btn-sm btn-light d-flex align-items-center px-4">
                                    <!--begin::Display range-->
                                    <div class="text-gray-600 fw-bold">{{ __('Loading date range...') }}</div>
                                    <!--end::Display range-->
                                    <i class="ki-outline ki-calendar-8 fs-1 ms-2 me-0"></i>
                                </div>
                                <!--end::Daterangepicker-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex align-items-end px-0 pt-3 pb-5">
                            <!--begin::Chart-->
                            <div id="orders_chart" class="h-325px w-100 min-h-auto ps-4 pe-6"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::Chart widget 38-->

                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-4">
                    <!--begin::Container-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7 mb-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">{{ __('Product by Categories') }}</span>
                                {{--  <span class="text-gray-400 mt-1 fw-semibold fs-6">20 countries share 97% visits</span>  --}}
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-0">
                            <!--begin::Items-->
                            <div class="m-0">
                                @if ($categoryCount->isEmpty())
                                    <div style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                        <span>{{ __('No data available') }}</span>
                                    </div>
                                @else
                                    <div id="product_category_chart" class="mx-auto mb-4"></div>
                                    <!--end::Item-->
                                    <div class="mx-auto">
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Bullet-->
                                            <div class="bullet bullet-dot w-8px h-7px bg-success me-2"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="fs-8 fw-semibold text-muted">{{ __('Gold') }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Bullet-->
                                            <div class="bullet bullet-dot w-8px h-7px bg-primary me-2"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="fs-8 fw-semibold text-muted">{{ __('Silver') }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Bullet-->
                                            <div class="bullet bullet-dot w-8px h-7px bg-info me-2"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="fs-8 fw-semibold text-muted">{{ __('Diamond') }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Bullet-->
                                            <div class="bullet bullet-dot w-8px h-7px bg-danger me-2"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="fs-8 fw-semibold text-muted">{{ __('Watches') }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Bullet-->
                                            <div class="bullet bullet-dot w-8px h-7px bg-warning me-2"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="fs-8 fw-semibold text-muted">{{ __('Alloys') }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Label-->
                                    </div>
                                @endif
                            </div>
                            <!--end::Items-->
                        </div>
                        <!--end::Body-->
                    </div>

                    <!--end::Container-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-8">
                    <!--begin::Chart widget 23-->
                    <div class="card card-flush overflow-hidden h-md-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">{{ __('Top Selling Products') }}</span>
                                {{--  <span class="text-gray-400 mt-1 fw-semibold fs-6">Total 424,567 deliveries</span>  --}}
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Nav-->
                            <ul class="nav nav-pills nav-pills-custom mb-3">
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2 active"
                                        data-bs-toggle="pill" href="#kt_stats_widget_6_tab_1">
                                        <!--begin::Icon-->
                                        <div class="nav-icon mb-3">
                                            <img alt=""
                                                src="{{ asset('assets/dashboard/media/svg/products-categories/platin.svg') }}"
                                                class="" />
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">{{ __('All') }}</span>
                                        <!--end::Title-->
                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2"
                                        data-bs-toggle="pill" href="#kt_stats_widget_6_tab_2">
                                        <!--begin::Icon-->
                                        <div class="nav-icon mb-3">
                                            <img alt=""
                                                src="{{ asset('assets/dashboard/media/svg/products-categories/gold.svg') }}"
                                                class="" />
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">{{ __('Gold') }}</span>
                                        <!--end::Title-->
                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2"
                                        data-bs-toggle="pill" href="#kt_stats_widget_6_tab_3">
                                        <!--begin::Icon-->
                                        <div class="nav-icon mb-3">
                                            <img alt=""
                                                src="{{ asset('assets/dashboard/media/svg/products-categories/silver.svg') }}"
                                                class="" />
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">{{ __('Silver') }}</span>
                                        <!--end::Title-->
                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2"
                                        data-bs-toggle="pill" href="#kt_stats_widget_6_tab_4">
                                        <!--begin::Icon-->
                                        <div class="nav-icon mb-3">
                                            <img alt=""
                                                src="{{ asset('assets/dashboard/media/svg/products-categories/diamond.svg') }}"
                                                class="" />
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">{{ __('Diamond') }}</span>
                                        <!--end::Title-->
                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2"
                                        data-bs-toggle="pill" href="#kt_stats_widget_6_tab_5">
                                        <!--begin::Icon-->
                                        <div class="nav-icon mb-3">
                                            <img alt=""
                                                src="{{ asset('assets/dashboard/media/svg/products-categories/watch.svg') }}"
                                                class="" />
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">{{ __('Watches') }}</span>
                                        <!--end::Title-->
                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2"
                                        data-bs-toggle="pill" href="#kt_stats_widget_6_tab_6">
                                        <!--begin::Icon-->
                                        <div class="nav-icon mb-3">
                                            <img alt=""
                                                src="{{ asset('assets/dashboard/media/svg/products-categories/alloys.svg') }}"
                                                class="" />
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">{{ __('Alloys') }}</span>
                                        <!--end::Title-->
                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Nav-->
                            <!--begin::Tab Content-->
                            <div class="tab-content">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade active show" id="kt_stats_widget_6_tab_1">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                    <th class="p-0 w-200px w-xxl-450px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-190px"></th>
                                                    <th class="p-0 w-50px"></th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody>
                                                @forelse ($topSellingAllProducts as $product)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="symbol symbol-40px me-3">
                                                                    <img src="{{ $product->images[0]->full_image_path }}"
                                                                        class="" alt="" />
                                                                </div>
                                                                <div class="d-flex justify-content-start flex-column">
                                                                    <a href="{{ route('vendor.products.show', $product->id) }}"
                                                                        class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $product->name }}</a>

                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <a href="#"
                                                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ formatNumber($product->orders_count) }}</a>
                                                            <span
                                                                class="text-muted fw-semibold d-block fs-7">{{ __('Orders') }}</span>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" style="text-align: center;">
                                                            {{ __('No data available in table') }}</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_stats_widget_6_tab_2">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                    <th class="p-0 w-200px w-xxl-450px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-190px"></th>
                                                    <th class="p-0 w-50px"></th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody>
                                                @forelse ($topSellingGoldProducts as $product)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="symbol symbol-40px me-3">
                                                                    <img src="{{ $product->images[0]->full_image_path }}"
                                                                        class="" alt="" />
                                                                </div>
                                                                <div class="d-flex justify-content-start flex-column">
                                                                    <a href="{{ route('vendor.products.show', $product->id) }}"
                                                                        class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $product->name }}</a>

                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <a href="#"
                                                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ formatNumber($product->orders_count) }}</a>
                                                            <span
                                                                class="text-muted fw-semibold d-block fs-7">{{ __('Orders') }}</span>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" style="text-align: center;">
                                                            {{ __('No data available in table') }}</td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_stats_widget_6_tab_3">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                    <th class="p-0 w-200px w-xxl-450px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-190px"></th>
                                                    <th class="p-0 w-50px"></th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody>
                                                @forelse ($topSellingSilverProducts as $product)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="symbol symbol-40px me-3">
                                                                    <img src="{{ $product->images[0]->full_image_path }}"
                                                                        class="" alt="" />
                                                                </div>
                                                                <div class="d-flex justify-content-start flex-column">
                                                                    <a href="{{ route('vendor.products.show', $product->id) }}"
                                                                        class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $product->name }}</a>

                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <a href="#"
                                                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ formatNumber($product->orders_count) }}</a>
                                                            <span
                                                                class="text-muted fw-semibold d-block fs-7">{{ __('Orders') }}</span>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" style="text-align: center;">
                                                            {{ __('No data available in table') }}</td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_stats_widget_6_tab_4">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                    <th class="p-0 w-200px w-xxl-450px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-190px"></th>
                                                    <th class="p-0 w-50px"></th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody>
                                                @forelse ($topSellingDiamondProducts as $product)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="symbol symbol-40px me-3">
                                                                    <img src="{{ $product->images[0]->full_image_path }}"
                                                                        class="" alt="" />
                                                                </div>
                                                                <div class="d-flex justify-content-start flex-column">
                                                                    <a href="{{ route('vendor.products.show', $product->id) }}"
                                                                        class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $product->name }}</a>

                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <a href="#"
                                                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ formatNumber($product->orders_count) }}</a>
                                                            <span
                                                                class="text-muted fw-semibold d-block fs-7">{{ __('Orders') }}</span>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" style="text-align: center;">
                                                            {{ __('No data available in table') }}</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_stats_widget_6_tab_5">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                    <th class="p-0 w-200px w-xxl-450px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-190px"></th>
                                                    <th class="p-0 w-50px"></th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody>
                                                @forelse ($topSellingWatchesProducts as $product)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="symbol symbol-40px me-3">
                                                                    <img src="{{ $product->images[0]->full_image_path }}"
                                                                        class="" alt="" />
                                                                </div>
                                                                <div class="d-flex justify-content-start flex-column">
                                                                    <a href="{{ route('vendor.products.show', $product->id) }}"
                                                                        class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $product->name }}</a>

                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <a href="#"
                                                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ formatNumber($product->orders_count) }}</a>
                                                            <span
                                                                class="text-muted fw-semibold d-block fs-7">{{ __('Orders') }}</span>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" style="text-align: center;">
                                                            {{ __('No data available in table') }}</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_stats_widget_6_tab_6">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                    <th class="p-0 w-200px w-xxl-450px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-190px"></th>
                                                    <th class="p-0 w-50px"></th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody>
                                                @forelse ($topSellingAlloysProducts as $product)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="symbol symbol-40px me-3">
                                                                    <img src="{{ $product->images[0]->full_image_path }}"
                                                                        class="" alt="" />
                                                                </div>
                                                                <div class="d-flex justify-content-start flex-column">
                                                                    <a href="{{ route('vendor.products.show', $product->id) }}"
                                                                        class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $product->name }}</a>

                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <a href="#"
                                                                class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{ formatNumber($product->orders_count) }}</a>
                                                            <span
                                                                class="text-muted fw-semibold d-block fs-7">{{ __('Orders') }}</span>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" style="text-align: center;">
                                                            {{ __('No data available in table') }}</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::Chart widget 23-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-8">
                    <!--begin::Chart widget 25-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Header-->
                        <div class="card-header flex-nowrap pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">{{ __('Top Branches') }}</span>
                                {{--  <span class="text-gray-400 pt-2 fw-semibold fs-6">8k social visitors</span>  --}}
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-5 ps-6">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                            <th class="p-0 w-50px pb-1">{{ __('Branch') }}</th>
                                            <th class="text-center min-w-140px p-0 pb-1">{{ __('Products') }}</th>
                                            <th class="text-center min-w-140px p-0 pb-1">{{ __('Orders delivered') }}</th>
                                            <th class="text-center min-w-140px p-0 pb-1">{{ __('Orders rejected') }}</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        @forelse ($topBranches as $branch)
                                            <tr>
                                                <td class="me-5">
                                                    <a href="#"
                                                        class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">{{ $branch->city->name }}</a>

                                                </td>
                                                <td style="text-align: center">
                                                    <span
                                                        class="text-gray-800 fw-bold d-block fs-6 ps-0">{{ formatNumber($branch->product_count) }}</span>
                                                </td>
                                                <td style="text-align: center">
                                                    <span class="badge badge-light-success fs-base"> <i
                                                            class="fa-solid fa-arrow-up fs-5 text-success ms-n1"
                                                            style="padding-right: 3px;"></i>{{ formatNumber($branch->order_count_rejected) }}</span>
                                                </td>
                                                <td style="text-align: center">
                                                    <span class="badge badge-light-danger fs-base"><i
                                                            class="fa-solid fa-arrow-down fs-5 text-danger ms-n1"
                                                            style="padding-right: 3px;"></i>{{ formatNumber($branch->order_count_delivered) }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" style="text-align: center;">
                                                    {{ __('No data available in table') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Chart widget 25-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-4">
                    <!--begin::Container-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7 mb-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">{{ __('Order by Categories') }}</span>
                                {{--  <span class="text-gray-400 mt-1 fw-semibold fs-6">20 countries share 97% visits</span>  --}}
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-0">
                            <!--begin::Items-->
                            <div class="m-0">
                                @if ($categoryCountOrders->isEmpty())
                                    <div
                                        style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                        <span>{{ __('No data available') }}</span>
                                    </div>
                                @else
                                    <div id="order_category_chart" class="mx-auto mb-4"></div>
                                    <!--end::Item-->
                                    <div class="mx-auto">
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Bullet-->
                                            <div class="bullet bullet-dot w-8px h-7px bg-success me-2"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="fs-8 fw-semibold text-muted">{{ __('Gold') }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Bullet-->
                                            <div class="bullet bullet-dot w-8px h-7px bg-primary me-2"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="fs-8 fw-semibold text-muted">{{ __('Silver') }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Bullet-->
                                            <div class="bullet bullet-dot w-8px h-7px bg-info me-2"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="fs-8 fw-semibold text-muted">{{ __('Diamond') }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Bullet-->
                                            <div class="bullet bullet-dot w-8px h-7px bg-danger me-2"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="fs-8 fw-semibold text-muted">{{ __('Watches') }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex align-items-center mb-2">
                                            <!--begin::Bullet-->
                                            <div class="bullet bullet-dot w-8px h-7px bg-warning me-2"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="fs-8 fw-semibold text-muted">{{ __('Alloys') }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Label-->
                                    </div>
                                @endif
                            </div>
                            <!--end::Items-->
                        </div>
                        <!--end::Body-->
                    </div>

                    <!--end::Container-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->

                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection
@push('scripts')
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        window.isArabic = '{{ isArabic() }}';
    </script>
    <script>
        {{--  -----------------  --}}
        let lang = '{{ isArabic() }}';

        let productCategory = @json($categoryCount);
        var productBasedOnCategories = function() {
            // Private methods
            var initChart = function(tabSelector, chartSelector, data, initByDefault) {
                var element = document.querySelector(chartSelector);

                if (!element) {
                    return;
                }

                var height = parseInt(KTUtil.css(element, 'height'));

                var options = {
                    series: data,
                    chart: {
                        fontFamily: 'inherit',
                        type: 'donut',
                        width: 250,
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '50%',
                                labels: {
                                    value: {
                                        fontSize: '10px'
                                    }
                                }
                            }
                        }
                    },
                    colors: [
                        KTUtil.getCssVariableValue('--bs-success'),
                        KTUtil.getCssVariableValue('--bs-primary'),
                        KTUtil.getCssVariableValue('--bs-info'),
                        KTUtil.getCssVariableValue('--bs-danger'),
                        KTUtil.getCssVariableValue('--bs-warning')
                    ],
                    stroke: {
                        width: 0
                    },
                    labels: [__("Gold"), __("Silver"), __("Diamond"), __("Watches"), __("Alloys")],
                    legend: {
                        show: false,
                    },
                    fill: {
                        type: 'false',
                    }
                };

                var chart = new ApexCharts(element, options);

                var init = false;

                if (initByDefault === true) {
                    chart.render();
                    init = true;
                }

            }

            // Public methods
            return {
                init: function() {
                    initChart('#kt_chart_widgets_22_tab_1', '#product_category_chart', productCategory, true);
                }
            }
        }();
        productBasedOnCategories.init();

        {{--  ------------  --}}
        let orderCategory = @json($categoryCountOrders);
        var OrderBasedOnCategories = function() {
            // Private methods
            var initChart = function(tabSelector, chartSelector, data, initByDefault) {
                var element = document.querySelector(chartSelector);

                if (!element) {
                    return;
                }

                var height = parseInt(KTUtil.css(element, 'height'));

                var options = {
                    series: data,
                    chart: {
                        fontFamily: 'inherit',
                        type: 'donut',
                        width: 250,
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '50%',
                                labels: {
                                    value: {
                                        fontSize: '10px'
                                    }
                                }
                            }
                        }
                    },
                    colors: [
                        KTUtil.getCssVariableValue('--bs-success'),
                        KTUtil.getCssVariableValue('--bs-primary'),
                        KTUtil.getCssVariableValue('--bs-info'),
                        KTUtil.getCssVariableValue('--bs-danger'),
                        KTUtil.getCssVariableValue('--bs-warning')
                    ],
                    stroke: {
                        width: 0
                    },
                    labels: [__("Gold"), __("Silver"), __("Diamond"), __("Watches"), __("Alloys")],
                    legend: {
                        show: false,
                    },
                    fill: {
                        type: 'false',
                    }
                };

                var chart = new ApexCharts(element, options);

                var init = false;

                if (initByDefault === true) {
                    chart.render();
                    init = true;
                }

            }

            // Public methods
            return {
                init: function() {
                    initChart('#kt_chart_widgets_22_tab_1', '#order_category_chart', orderCategory, true);
                }
            }
        }();
        OrderBasedOnCategories.init();
    </script>

    <script>
        var arabic = lang == 1 ? {
            left: 250
        } : {
            right: 200
        };
        google.load('visualization', '1', {
            packages: ['corechart', 'bar', 'line']
        });

        google.setOnLoadCallback(function() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                [__("Fast Shipping"), {{ $ordersFastShipping }}],
                [__("Normal Shipping"), {{ $ordersNormalShipping }}],

            ]);

            var options = {
                {{--  title: 'My Daily Activities',  --}}
                colors: ['#fe3995', '#f6aa33', '#6e4ff5', '#2abe81', '#c7d2e7', '#593ae1'],
                backgroundColor: 'transparent', // Set background to transparent
                chartArea: {
                    {{--  left: lang === 1 ? 0 : 10, // Hide left padding if lang == 1, otherwise set to 10
                    right: lang === 1 ? 10 : 0, // If lang == 1, right is set to 10  --}}
                    top: 50,
                    ...arabic
                },
            };
            var chart = new google.visualization.PieChart(document.getElementById('container'));
            chart.draw(data, options);
        });
    </script>
    <script>
        {{--  var debounceTimer;  --}}

        var debouncedAjaxRequest = function(start, end) {
            {{--  clearTimeout(debounceTimer);  --}}
            {{--  debounceTimer = setTimeout(function() {  --}}
            $.ajax({
                url: '/vendor/fetch-data', // Replace with your Laravel route
                method: 'POST',
                data: {
                    start_date: start.format('YYYY-MM-DD'),
                    end_date: end.format('YYYY-MM-DD'),
                    _token: $('meta[name="csrf-token"]').attr(
                        'content') // Include the CSRF token for Laravel
                },
                cache: false,
                success: function(response) {
                    var values = Object.values(response);
                    var orderCounts = values.map(item => item
                        .order_count); // Extract order_count
                    var orderSums = values.map(item => item.order_sum); // Extract order_sum

                    var orderChart = function() {
                        var chart = {
                            self: null,
                            rendered: false
                        };

                        // Private methods
                        var initChart = function() {
                            var element = document.getElementById("orders_chart");

                            if (!element) {
                                return;
                            }
                            var startDate = start.format('YYYY-MM-DD');
                            var endDate = end.format('YYYY-MM-DD');

                            // Get today's date in 'YYYY-MM-DD' format
                            var today = moment().format('YYYY-MM-DD');

                            // Check if today is between the start and end dates (inclusive)
                            var isToday = today == startDate && today == endDate;
                            var rotation = (lang == 1 && isToday) ? -30 :
                                -30; // If both conditions are met, rotate; otherwise, no rotation
                            var offsetX = (lang == 1 && isToday) ? -15 : 0;
                            var offsetY = (lang == 1 && isToday) ? 10 : 0;
                            var height = parseInt(KTUtil.css(element, 'height'));
                            var labelColor = KTUtil.getCssVariableValue(
                                '--kt-gray-900');
                            var borderColor = KTUtil.getCssVariableValue(
                                '--kt-border-dashed-color');

                            var options = {
                                series: [{
                                    name: __('Order Count'),
                                    data: orderCounts // Using the order_count data here
                                }],
                                chart: {
                                    fontFamily: 'inherit',
                                    type: 'bar',
                                    height: height,
                                    toolbar: {
                                        show: false
                                    }
                                },
                                plotOptions: {
                                    bar: {
                                        horizontal: false,
                                        columnWidth: ['28%'],
                                        borderRadius: 5,
                                        dataLabels: {
                                            position: "top" // top, center, bottom
                                        },
                                        startingShape: 'flat'
                                    },
                                },
                                legend: {
                                    show: false
                                },
                                dataLabels: {
                                    enabled: true,
                                    offsetY: -28,
                                    style: {
                                        fontSize: '13px',
                                        colors: [labelColor]
                                    },
                                    formatter: function(val) {
                                        return val; // + "H";
                                    }
                                },
                                stroke: {
                                    show: true,
                                    width: 2,
                                    colors: ['transparent']
                                },
                                xaxis: {
                                    categories: Object.keys(response),
                                    axisBorder: {
                                        show: false,
                                    },
                                    axisTicks: {
                                        show: false
                                    },
                                    labels: {
                                        style: {
                                            colors: KTUtil.getCssVariableValue(
                                                '--kt-gray-500'),
                                            fontSize: '13px'
                                        },
                                        rotate: rotation,
                                        offsetX: offsetX,
                                        offsetY: offsetY,
                                    },
                                    crosshairs: {
                                        fill: {
                                            gradient: {
                                                opacityFrom: 0,
                                                opacityTo: 0
                                            }
                                        }
                                    }
                                },
                                yaxis: {
                                    labels: {
                                        style: {
                                            colors: KTUtil.getCssVariableValue(
                                                '--kt-gray-500'),
                                            fontSize: '13px'
                                        },
                                        formatter: function(val) {
                                            return val;
                                        }
                                    }
                                },
                                fill: {
                                    opacity: 1
                                },
                                states: {
                                    normal: {
                                        filter: {
                                            type: 'none',
                                            value: 0
                                        }
                                    },
                                    hover: {
                                        filter: {
                                            type: 'none',
                                            value: 0
                                        }
                                    },
                                    active: {
                                        allowMultipleDataPointsSelection: false,
                                        filter: {
                                            type: 'none',
                                            value: 0
                                        }
                                    }
                                },
                                tooltip: {
                                    style: {
                                        fontSize: '12px'
                                    },
                                    y: {
                                        formatter: function(val, {
                                            dataPointIndex
                                        }) {
                                            // Custom tooltip to display order count and sum
                                            var orderCount = orderCounts[
                                                dataPointIndex];
                                            var orderSum = orderSums[
                                                dataPointIndex];
                                            return `${orderCount} , ${__('Total') }: ${orderSum} ${ __('SAR')}`;
                                        }
                                        {{--  formatter: function(val) {
                                                return +val
                                            }  --}}
                                    }
                                },
                                colors: [KTUtil.getCssVariableValue('--kt-primary'),
                                    KTUtil.getCssVariableValue(
                                        '--kt-primary-light')
                                ],
                                grid: {
                                    borderColor: borderColor,
                                    strokeDashArray: 4,
                                    yaxis: {
                                        lines: {
                                            show: true
                                        }
                                    }
                                }
                            };

                            chart.self = new ApexCharts(element, options);

                            // Set timeout to properly get the parent elements width
                            {{--  setTimeout(function() {  --}}
                            chart.self.render();
                            chart.rendered = true;
                            {{--  }, 200);  --}}
                        }

                        // Public methods
                        return {
                            init: function() {
                                initChart(chart);

                                // Update chart on theme mode change
                                {{--  KTThemeMode.on("kt.thememode.change", function() {  --}}
                                if (chart.rendered) {
                                    chart.self.destroy();
                                }

                                initChart(chart);
                                {{--  });  --}}
                            }
                        }
                    }();
                    orderChart.init();
                    {{--  console.log('Data fetched successfully:', response);  --}}
                    // Process the response here (e.g., update your UI)
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
            {{--  }, 300); // 300 ms debounce delay  --}}
        };

        var createDateRangePickers = function() {
            // Check if jQuery included
            if (typeof jQuery == 'undefined') {
                return;
            }

            // Check if daterangepicker included
            if (typeof $.fn.daterangepicker === 'undefined') {
                return;
            }

            var elements = [].slice.call(document.querySelectorAll('[data-order-daterangepicker="true"]'));
            var start = moment().startOf('month');
            var end = moment().endOf('month');

            elements.map(function(element) {
                if (element.getAttribute("data-order-initialized") === "1") {
                    return;
                }

                var display = element.querySelector('div');
                var attrOpens = element.hasAttribute('data-order-daterangepicker-opens') ? element.getAttribute(
                    'data-order-daterangepicker-opens') : 'left';
                var range = element.getAttribute('data-order-daterangepicker-range');

                var cb = function(start, end) {
                    var current = moment();
                    debouncedAjaxRequest(start, end);
                    if (display) {
                        if (current.isSame(start, "day") && current.isSame(end, "day")) {
                            display.innerHTML = start.format('D/M/YYYY');
                        } else {
                            display.innerHTML = start.format('D/M/YYYY') + ' - ' + end.format(
                                'D/M/YYYY');
                        }
                    }
                }


                if (range === "today") {
                    start = moment();
                    end = moment();
                }

                $(element).daterangepicker({
                    startDate: start,
                    endDate: end,
                    opens: attrOpens,
                    showCustomRangeLabel: false,
                    ranges: {
                        [__('Today')]: [moment(), moment()],
                        [__('Last 7 Days')]: [moment().subtract(6, 'days'), moment()],
                        {{--  [__('Last 30 Days')]: [moment().subtract(29, 'days'), moment()],  --}}[__('This Month')]: [moment().startOf('month'), moment()
                            .endOf('month')
                        ],
                        [__('Last Month')]: [moment().subtract(1, 'month').startOf('month'), moment()
                            .subtract(1, 'month').endOf('month')
                        ],
                        [__('This Year')]: [moment().startOf('year'), moment().endOf(
                            'year')], // Add This Year
                        [__('Last Year')]: [moment().subtract(1, 'year').startOf('year'), moment()
                            .subtract(1, 'year').endOf('year')
                        ] // Add Last Year
                    }
                }, cb);
                cb(start, end);
                element.setAttribute("data-kt-initialized", "1");
            });

            return {
                init: function() {
                    createDateRangePickers();
                    initialized = true;
                },

                initTinySlider: function(el) {
                    initTinySlider(el);
                },

                showPageLoading: function() {
                    showPageLoading();
                },

                hidePageLoading: function() {
                    hidePageLoading();
                },

                createBootstrapPopover: function(el, options) {
                    return createBootstrapPopover(el, options);
                },

                createBootstrapTooltip: function(el, options) {
                    return createBootstrapTooltip(el, options);
                }
            };
        }();
    </script>
@endpush
