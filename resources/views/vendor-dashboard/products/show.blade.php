@extends('vendor-dashboard.partials.master')
@push('styles')
    <link href="{{ asset('assets/dashboard/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet"
        type="text/css" />
@endpush
@section('breadcrumbs')
    {{ Breadcrumbs::render('products', __('Product Details') . ' : ' . $product->name) }}
@endsection
@section('content')
    <!--begin::Navbar-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <!--begin: Pic-->
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <div class="symbol symbol-50px">
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <div class="symbol-label fs-2 fw-semibold text-success">{{ $product->name_trimmed }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Pic-->
                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::User-->
                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            <div class="d-flex align-items-center mb-2">
                                <a href="javascript:;"
                                    class="text-gray-900 fs-2 fw-bold me-1 cursor-default disabled">{{ $product->name }}</a>
                                <span
                                    class="badge py-1 {{ $product->status == 'In Stock' ? 'badge-light-success' : 'badge-light-danger' }} fw-bold ms-2 fs-8 py-1 px-3 cursor-default">
                                    {{ __($product->status) }}
                                </span>
                            </div>
                            <!--end::Name-->
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                <a href="#" class="d-flex align-items-center text-gray-400 me-5 mb-2 cursor-default">
                                    <i class="fonticon-bookmark fs-4 me-1"></i>

                                    <!--end::Svg Icon-->{{ __('' . $product->type) }}
                                </a>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                        <!--begin::Actions-->
                        <div class="d-flex my-4">
                            <div class="me-0">
                                <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="fonticon-settings-1 fs-3"></i>
                                </button>
                                <!--begin::Menu 3-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                    data-kt-menu="true">
                                    <!--begin::Heading-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                            {{ __('Actions') }}</div>
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="{{ route('dashboard.products.edit', $product) }}"
                                            class="menu-link flex-stack px-3">{{ __('Edit') }}
                                            <i class="fonticon-content-marketing fs-6"></i></a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu 3-->
                            </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Title-->
                    <!--begin::Stats-->
                    <div class="d-flex flex-wrap flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap">
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <i class="fonticon-cash-payment me-2 text-primary fs-3"></i>
                                        <!--end::Svg Icon-->
                                        <div class="fs-2 fw-bold">{{ $product->created_at->format('Y-m-d') }}</div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-semibold fs-6 text-gray-400">{{ __('Created at') }}</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-12-26-231111/core/html/src/media/icons/duotune/medicine/med001.svg-->

                                        <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                        <svg height="24px" width="24px" version="1.1" id="Layer_1"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            viewBox="0 0 511.882 511.882" xml:space="preserve">
                                            <polygon style="fill:#F6BB42;"
                                                points="350.216,176.572 278.374,158.615 37.038,264.123 0,338.207 125.753,374.324 386.13,258.531
                                        " />
                                            <polygon style="fill:#FFCE54;"
                                                points="350.216,176.572 107.756,284.345 125.753,374.324 386.13,258.531 " />
                                            <polygon style="fill:#E8AA3D;"
                                                points="107.756,284.345 37.038,264.123 0.015,338.207 125.753,374.324 " />
                                            <polygon style="fill:#F6BB42;"
                                                points="475.969,212.682 404.127,194.717 162.791,300.232 125.753,374.324 251.504,410.41
                                        511.882,294.625 " />
                                            <polygon style="fill:#FFCE54;"
                                                points="475.969,212.682 233.508,320.431 251.504,410.41 511.882,294.625 " />
                                            <polygon style="fill:#E8AA3D;"
                                                points="233.508,320.431 162.791,300.232 125.753,374.324 251.504,410.41 " />
                                            <polygon style="fill:#F6BB42;"
                                                points="396.316,119.429 324.488,101.473 103.867,198.435 66.843,272.519 192.596,308.621
                                        432.245,201.379 " />
                                            <polygon style="fill:#FFCE54;"
                                                points="396.316,119.429 174.6,218.641 192.596,308.621 432.245,201.379 " />
                                            <polygon style="fill:#E8AA3D;"
                                                points="174.6,218.641 103.867,198.435 66.843,272.519 192.596,308.621 " />
                                        </svg>
                                        <!--end::Svg Icon-->
                                        <div class="fs-2 fw-bold">{{ $product->caliber }}</div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-semibold fs-5 text-gray-400">{{ __('Caliber') }}</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-arrows-rotate me-2 text-primary fs-3"></i>
                                        <!--end::Svg Icon-->
                                        <div class="fs-2 fw-bold">{{ $product->price_change ? __('Yes') : __('No') }}</div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-semibold fs-6 text-gray-400">{{ __('Automatically update price') }}
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->
        </div>
    </div>
    <!--end::Navbar-->
    <div class="row g-6 g-xl-9 mb-5 mb-xl-10">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card h-100">
                <!--begin::Card head-->
                <div class="card-header card-header-stretch">
                    <!--begin::Title-->
                    <div class="card-title d-flex align-items-center">
                        <h3 class="fw-bold m-0 text-gray-800">{{ __('Product Images') }}</h3>
                    </div>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar m-0">
                        <!--begin::Tab nav-->
                        <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bold" role="tablist">

                            <li class="nav-item" role="presentation">
                                <a id="image-tab" class="nav-link justify-content-center text-active-gray-800 active"
                                    data-bs-toggle="tab" role="tab" href="#image"
                                    aria-selected="true">{{ __('Images') }}</a>
                            </li>

                        </ul>
                        <!--end::Tab nav-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card head-->
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Tab Content-->
                    <div class="tab-content">
                        <!--begin::Tab panel-->
                        <div id="image" class="card-body p-0 tab-pane fade active show" role="tabpanel"
                            aria-labelledby="image">
                            <!--begin::Card body-->
                            <div class="card-body p-9 pt-4">


                                <div class="tns" style="direction: ltr">
                                    <div data-tns="true" data-tns-nav-position="bottom" data-tns-mouse-drag="true"
                                        data-tns-controls="false">
                                        <!--begin::Item-->
                                        @foreach ($product->images as $image)
                                            <a class="d-block overlay" data-fslightbox="lightbox-basic"
                                                href="{{ $image->full_image_path }}" target="_blank">
                                                <!--begin::Image-->
                                                <div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
                                                    <img src="{{ $image->full_image_path }}"
                                                        class="card-rounded shadow mw-25" alt="" />
                                                </div>
                                                <!--end::Image-->

                                                <!--begin::Action-->
                                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                    <i class="bi bi-eye-fill text-white fs-3x"></i>
                                                </div>
                                                <!--end::Action-->
                                            </a>
                                            <!--end::Item-->
                                        @endforeach
                                        ...
                                    </div>
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Tab panel-->
                    </div>
                    <!--end::Tab Content-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card h-100">
                <!--begin::Card head-->
                <div class="card-header card-header-stretch">
                    <!--begin::Title-->
                    <div class="card-title d-flex align-items-center">
                        <h3 class="fw-bold m-0 text-gray-800">{{ __('Product Details') }}</h3>
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Card head-->
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Tab Content-->
                    <div class="tab-content">
                        <!--begin::Tab panel-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-category fs-2 me-2"></i>{{ __('Categories') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    @foreach ($product->categories as $category)
                                                        <!--begin::Name-->
                                                        <span
                                                            class="badge badge-light-info fs-7 m-1">{{ __($category->name) }}</span>
                                                        <!--end::Name-->
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i
                                                        class="ki-outline ki-category fs-2 me-2"></i>{{ __('Subcategories') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    @foreach ($product->subcategories as $subcategory)
                                                        <!--begin::Name-->
                                                        <span
                                                            class="badge badge-light-info fs-7 m-1">{{ __($subcategory->name) }}</span>
                                                        <!--end::Name-->
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                        @if ($product->brand)
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i
                                                            class="ki-outline ki-text-bold fs-2 me-2"></i>{{ __('Brand') }}
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">
                                                    <div class="d-flex align-items-center justify-content-end">
                                                        <!--begin:: Avatar -->
                                                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                            <div class="symbol-label fs-2 fw-semibold text-success">
                                                                {{ strtoupper(substr($product->brand->name, 0, 2)) }}</div>
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Name-->
                                                        <span
                                                            class="text-gray-600 text-hover-primary">{{ $product->brand->name }}</span>
                                                        <!--end::Name-->
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-key fs-2 me-2"></i>{{ __('Tags') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    @foreach ($product->tags as $tag)
                                                        <!--begin::Name-->
                                                        <span
                                                            class="badge badge-light-info fs-7 m-1">{{ __($tag->name) }}</span>
                                                        <!--end::Name-->
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-data fs-2 me-2"></i>{{ __('Description') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <span
                                                    class="text-gray-600 text-hover-primary">{{ $product->description }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i
                                                        class="ki-outline ki-finance-calculator fs-2 me-2"></i>{{ __('Caliber') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <span
                                                    class="text-gray-600 text-hover-primary">{{ $product->caliber . ' ' . __('Carat') }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-flag fs-2 me-2"></i>{{ __('Video link') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">{{ $product->video_link }}</td>
                                        </tr>
                                        @if ($product->maintenance_and_care)
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i
                                                            class="ki-outline ki-discount fs-2 me-2"></i>{{ __('Maintenance and care') }}
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $product->maintenance_and_care }}</td>
                                            </tr>
                                        @endif
                                        @if ($product->packaging)
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i
                                                            class="ki-outline ki-discount fs-2 me-2"></i>{{ __('Packaging') }}
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $product->packaging }}</td>
                                            </tr>
                                        @endif
                                        @if ($product->sustainable_assets)
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i
                                                            class="ki-outline ki-discount fs-2 me-2"></i>{{ __('Sustainable assets') }}
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $product->sustainable_assets }}</td>
                                            </tr>
                                        @endif
                                        @if ($product->main_stone)
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i
                                                            class="ki-outline ki-discount fs-2 me-2"></i>{{ __('Main stone') }}
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $product->main_stone }}</td>
                                            </tr>
                                        @endif
                                        @if ($product->guarantee)
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i
                                                            class="ki-outline ki-discount fs-2 me-2"></i>{{ __('Guarantee') }}
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $product->guarantee }}</td>
                                            </tr>
                                        @endif
                                        @if ($product->color)
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i
                                                            class="ki-outline ki-discount fs-2 me-2"></i>{{ __('Color') }}
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $product->color }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="fw-bold text-end">
                                                <span
                                                    class="badge {{ $product->status == 'In Stock' ? 'badge-light-success' : 'badge-light-danger' }} fs-7 m-1">{{ __('' . $product->status) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-setting-4 fs-2 me-2"></i>{{ __('Type') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <span
                                                    class="badge @if ($product->type == 'New') badge-light-success @else badge-light-danger @endif fs-7 m-1">{{ __('' . $product->type) }}</span>
                                            </td>
                                        </tr>
                                        @if ($product->rejection_reason)
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i
                                                            class="ki-outline ki-information-4 fs-2 me-2"></i>{{ __('Rejection Reason') }}
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $product->rejection_reason }}</td>
                                            </tr>
                                        @endif
                                        @if (count($product->meta_tag_key_words) > 0)
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i
                                                            class="ki-outline ki-information-4 fs-2 me-2"></i>{{ __('Meta tag keywords') }}
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">
                                                    <div class="d-flex align-items-center justify-content-end">
                                                        @foreach ($product->meta_tag_key_words as $metaTagKeyWords)
                                                            <!--begin::Name-->
                                                            <span
                                                                class="badge badge-light-info fs-7 m-1">{{ __($metaTagKeyWords) }}</span>
                                                            <!--end::Name-->
                                                        @endforeach
                                                    </div>

                                            </tr>
                                        @endif
                                        @if ($product->meta_tag_key_description)
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i
                                                            class="ki-outline ki-information-4 fs-2 me-2"></i>{{ __('Meta tag key description') }}
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $product->meta_tag_key_description }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Tab panel-->
                    </div>
                    <!--end::Tab Content-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card h-100">
                <!--begin::Card head-->
                <div class="card-header card-header-stretch">
                    <!--begin::Title-->
                    <div class="card-title d-flex align-items-center">
                        <h3 class="fw-bold m-0 text-gray-800">{{ __('Product Variations') }}</h3>
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Card head-->
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Tab Content-->
                    <div class="tab-content">
                        <!--begin::Tab panel-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px"
                                    id="kt_table_customers_payment">
                                    <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                        <tr class="text-start text-muted text-uppercase gs-0">
                                            <th class="min-w-100px">{{ __('Size') . ' ' . __('( Arabic )') }}</th>
                                            <th>{{ __('weight') }}</th>
                                            <th>{{ __('Price') }}</th>
                                            <th>{{ __('Stock') }}</th>
                                            <th class="min-w-100px">{{ __('Discount Price') }}</th>
                                            <th class="min-w-100px">{{ __('Discount From') }}</th>
                                            <th class="min-w-100px">{{ __('Discount To') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fs-6 fw-semibold text-gray-600">
                                        @forelse ($product->specifications as $specification)
                                            <tr>
                                                <td>{{ $specification->size }}</td>
                                                <td>{{ $specification->weight . ' ' . __('Gram') }}</td>
                                                <td>{{ $specification->price . __(' Ryal Saudi') }}</td>
                                                <td>{{ $specification->stock ?? 'ــ' }}</td>
                                                <td>{{ $specification->discount_price ? $specification->discount_price . __(' Ryal Saudi') : 'ــ' }}
                                                </td>
                                                <td>{{ $specification->discount_from ? $specification->discount_from->format('Y-m-d') : 'ــ' }}
                                                </td>
                                                <td>{{ $specification->discount_to ? $specification->discount_to->format('Y-m-d') : 'ــ' }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="odd">
                                                <td valign="top" colspan="6" style="text-align: center;">
                                                    {{ __('No data available in table') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Tab panel-->
                    </div>
                    <!--end::Tab Content-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var productId = "{{ $product->id }}";
    </script>
    <script src="{{ asset('assets/dashboard/js/global/datatable-config.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/datatables/datatables.bundle.js') }}"></script>
@endpush
