@extends('dashboard.partials.master')
@push('styles')
    <link href="{{ asset('assets/dashboard/css/datatables' . (isDarkMode() ? '.dark' : '') . '.bundle.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('assets/dashboard/plugins/custom/datatables/datatables.bundle' . (isArabic() ? '.rtl' : '') . '.css') }}"
        rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Order details page-->
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <div class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
                    <!--begin:::Tabs-->
                    <ul
                        class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-lg-n2 me-auto">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primar pb-4 active" data-bs-toggle="tab"
                                href="#kt_ecommerce_sales_order_summary">{{ __('Order Summary') }}</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                href="#kt_ecommerce_sales_order_history">{{ __('Order History') }}</a>
                        </li>
                        <!--end:::Tab item-->
                    </ul>
                    <!--end:::Tabs-->
                    <!--begin::Button-->
                    <a href="{{ route('dashboard.orders.index') }}"
                        class="btn btn-icon btn-light btn-active-secondary btn-sm ms-auto me-lg-n7">
                        <i class="fa-solid {{ isArabic() ? 'fa-arrow-right' : 'fa-arrow-left' }} fs-2"></i>
                    </a>
                    <!--end::Button-->
                    <!--begin::Button-->
                    @if ($order->paying_off == 1)
                        {{--  @dd($order->status)  --}}
                        @if (App\Enums\OrderStatus::Shipped->name == $order->status)
                            <form action="{{ route('dashboard.change-order-status', $order->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status"
                                    value="{{ App\Enums\OrderStatus::PaymentConfirmed->value }}">
                                <button type="submit" class="btn btn-success btn-sm me-lg-n7"
                                    style="background-color: #DEB893">{{ __('Confirm Payment') }}</button>
                            </form>
                        @elseif(App\Enums\OrderStatus::PaymentConfirmed->name == $order->status)
                            <form action="{{ route('dashboard.change-order-status', $order->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="{{ App\Enums\OrderStatus::Delivered->value }}">
                                <button type="submit" class="btn btn-success btn-sm me-lg-n7"
                                    style="background-color: #DEB893">{{ __('Deliver Products') }}</button>
                            </form>
                        @endif
                        <!--end::Button-->
                    @else
                        @if (App\Enums\OrderStatus::Shipped->name == $order->status)
                            <form action="{{ route('dashboard.change-order-status', $order->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="{{ App\Enums\OrderStatus::Delivered->value }}">
                                <button type="submit" class="btn btn-success btn-sm me-lg-n7"
                                    style="background-color: #DEB893">{{ __('Deliver Products') }}</button>
                            </form>
                        @endif
                        <!--end::Button-->
                    @endif
                </div>
                <!--begin::Order summary-->
                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-2">
                    <!--begin::Order details-->
                    <div class="card card-flush py-4 flex-row-fluid">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ __('Order Details') }} ({{ $order->id }})</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-6 min-w-300px">
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-regular fa-calendar fs-4 me-2"></i>{{ __('Created at') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">{{ $order->created_at->format('d-m-Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-solid fa-wallet fs-4 me-2"></i>{{ __('Status') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end"><span
                                                    class="badge badge-primary">{{ __('' . $order->status) }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i
                                                        class="{{ $order->paying_off == '1' ? 'fa-solid fa-money-bill' : 'fa-solid fa-credit-card' }} fs-4 me-2"></i>{{ __('Payment method') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                {{ $order->paying_off == '1' ? __('Cash on delivery') : __('Prepaid Cards') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i
                                                        class="{{ $order->type == 'Personal' ? 'fa-solid fa-person-walking-luggage' : 'fa-solid fa-gift' }} fs-4 me-2"></i>{{ __('Type') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">{{ __('' . $order->type) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i
                                                        class="fa-solid fa-truck-fast fs-4 me-2"></i>{{ __('Fast shipping available') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end"><span
                                                    class="badge {{ $order->has_fast_shipping ? 'badge-success' : 'badge-danger' }}">{{ $order->has_fast_shipping ? __('Yes') : __('No') }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Order details-->
                    <!--begin::Customer details-->
                    <div class="card card-flush py-4 flex-row-fluid">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ __('Customer Details') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-regular fa-user fs-4 me-2"></i>{{ __('Customer') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <!--begin:: Avatar -->
                                                    <div class="symbol symbol-circle symbol-40px overflow-hidden me-3">
                                                        <div class="symbol-label fs-2 fw-semibold text-success">
                                                            {{ strtoupper(substr($order->customer->name, 0, 2)) }}</div>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <!--begin::Name-->
                                                    <a
                                                        class="text-gray-600 text-hover-primary">{{ $order->customer->name }}</a>
                                                    <!--end::Name-->
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-regular fa-envelope fs-5 me-2"></i>{{ __('Email') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                <a
                                                    class="text-gray-600 text-hover-primary">{{ $order->customer->email }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-solid fa-phone fs-4 me-2"></i>{{ __('Phone') }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">{{ $order->customer->phone }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Customer details-->
                    <!--begin::Documents-->
                    @if ($order->type == 'Gift')
                        <div class="card card-flush py-4 flex-row-fluid">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{ __('Gift Details') }}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                        <tbody class="fw-semibold text-gray-600">
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i
                                                            class="ki-outline ki-devices fs-2 me-2"></i>{{ __('Gift owner name') }}
                                                        <span class="ms-1" data-bs-toggle="tooltip"
                                                            title="View the invoice generated by this order.">
                                                            <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">
                                                    <a href="../../demo55/dist/apps/invoices/view/invoice-3.html"
                                                        class="text-gray-600 text-hover-primary">{{ $order->gift_owner_name }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i
                                                            class="ki-outline ki-truck fs-2 me-2"></i>{{ __('Gift owner phone') }}
                                                        <span class="ms-1" data-bs-toggle="tooltip"
                                                            title="View the shipping manifest generated by this order.">
                                                            <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">
                                                    <a href="#"
                                                        class="text-gray-600 text-hover-primary">{{ $order->gift_owner_phone }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                        <i
                                                            class="ki-outline ki-discount fs-2 me-2"></i>{{ __('Gift text') }}
                                                        <span class="ms-1" data-bs-toggle="tooltip"
                                                            title="Reward value earned by customer when purchasing this order">
                                                            <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $order->gift_text }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                    @endif
                    <!--end::Documents-->
                </div>
                <!--end::Order summary-->
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade show active" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                        <!--begin::Orders-->
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                                <!--begin::Shipping address-->
                                <div class="card card-flush py-4 flex-row-fluid position-relative">
                                    <!--begin::Background-->
                                    <div
                                        class="position-absolute top-0 end-0 bottom-0 opacity-10 d-flex align-items-center me-5">

                                        <i class="fa-solid fa-truck-fast" style="font-size: 13em"></i>
                                    </div>
                                    <!--end::Background-->
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{ __('Shipping Address') }}</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        {{ __('Building number') . ': ' . $order->address->building_number }},
                                        <br />{{ __('Street name') . ': ' . $order->address->street_name }},
                                        <br />{{ __('District') . ': ' . $order->address->district }},
                                        <br />{{ __('City') . ': ' . $order->address->city->name }}
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Shipping address-->
                            </div>
                            @if (App\Enums\OrderStatus::Canceled->name == $order->status || App\Enums\OrderStatus::Refund->name == $order->status)
                                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                                    <!--begin::Reason status-->
                                    <div class="card card-flush py-4 flex-row-fluid position-relative">
                                        <!--begin::Background-->
                                        <div
                                            class="position-absolute top-0 end-0 bottom-0 opacity-10 d-flex align-items-center me-5">
                                            @if (App\Enums\OrderStatus::Canceled->name == $order->status)
                                                <i class="fa-solid fa-xmark" style="font-size: 13em"></i>
                                            @else
                                                <i class="fa-solid fa-rotate" style="font-size: 13em"></i>
                                            @endif
                                        </div>
                                        <!--end::Background-->
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                @if (App\Enums\OrderStatus::Canceled->name == $order->status)
                                                    <h2>{{ __('Reasons for ' . 'cancellation') }}</h2>
                                                @else
                                                    <h2>{{ __('Reasons for ' . 'refund') }}</h2>
                                                @endif

                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                <thead>
                                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="min-w-100px">{{ __('Reason') }}</th>
                                                        <th class="min-w-175px">{{ __('Comment') }}</th>
                                                        <th class="min-w-70px">{{ __('Date') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fw-semibold text-gray-600">
                                                    @forelse($order->reasons as $reason)
                                                        <tr>
                                                            <td>{{ $reason->reason }}</td>
                                                            <td>{{ $reason->pivot->comment }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($reason->pivot->created_at)->format('Y-m-d') }}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td valign="top" colspan="4"
                                                                style="text-align: center;">
                                                                {{ __('No data available in table') }}</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Shipping address-->
                                </div>
                            @endif
                            <!--begin::Product List-->
                            <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ __('Order items') }}</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                            <thead>
                                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="min-w-175px">{{ __('Product') }}</th>
                                                    <th class="min-w-70px text-end">{{ __('Quantity') }}</th>
                                                    <th class="min-w-100px text-end">{{ __('Unit Price') }}</th>
                                                    <th class="min-w-100px text-end">{{ __('Total') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                {{--  <div style="display: none">  --}}
                                                @php
                                                    $subTotal = 0;
                                                    $vat = 0;
                                                @endphp
                                                {{--  </div>  --}}
                                                @foreach ($order->orderItems as $orderItem)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <!--begin::Thumbnail-->
                                                                <div
                                                                    class="symbol symbol-circle symbol-40px overflow-hidden me-3">
                                                                    <div
                                                                        class="symbol-label fs-2 fw-semibold text-success">
                                                                        {{ strtoupper(substr(optional($orderItem->product)->name ?? '', 0, 2)) }}
                                                                    </div>
                                                                </div>
                                                                <!--end::Thumbnail-->
                                                                <!--begin::Title-->
                                                                <div class="ms-5">
                                                                    @if ($orderItem->product)
                                                                        <a href="{{ route('dashboard.products.show', $orderItem->product->id) }}"
                                                                            class="fw-bold text-gray-600 text-hover-primary">{{ $orderItem->product->name }}</a>
                                                                    @else
                                                                        <span class="fw-bold text-gray-600"></span>
                                                                    @endif
                                                                </div>
                                                                <!--end::Title-->
                                                            </div>
                                                        </td>
                                                        <td class="text-end">{{ $orderItem->quantity }}</td>
                                                        <td class="text-end">{{ $orderItem->price }}</td>
                                                        <td class="text-end">
                                                            {{ $orderItem->quantity * $orderItem->price }}</td>
                                                        <div style="display: none">
                                                            {{ $subTotal += $orderItem->quantity * $orderItem->price }}
                                                        </div>
                                                    </tr>
                                                @endforeach
                                                @php
                                                    $vat = $subTotal * (15 / 100);
                                                @endphp
                                                <tr>
                                                    <td colspan="3" class="text-end">
                                                        {{ __('Subtotal') }}</td>
                                                    <td class="text-end">{{ $subTotal }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-end">{{ __('VAT') }} (15%)</td>
                                                    <td class="text-end">
                                                        {{ $subTotal * (15 / 100) . __(' Ryal Saudi') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-end">{{ __('Shipping price') }}</td>
                                                    <td class="text-end">
                                                        {{ $order->shipping_price ?? 0 . __(' Ryal Saudi') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="fs-3 text-dark text-end">
                                                        {{ __('Grand Total') }}</td>
                                                    <td class="text-dark fs-3 fw-bolder text-end">
                                                        {{ $subTotal + $vat + $order->shipping_price . __(' Ryal Saudi') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Product List-->
                        </div>
                        <!--end::Orders-->
                    </div>
                    <!--end::Tab pane-->
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade" id="kt_ecommerce_sales_order_history" role="tab-panel">
                        <!--begin::Orders-->
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <!--begin::Order history-->
                            <div class="card card-flush py-4 flex-row-fluid">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ __('Order History') }}</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                            <thead>
                                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="min-w-100px">{{ __('Order Status') }}</th>
                                                    <th class="min-w-175px">{{ __('Actioned by') }}</th>
                                                    <th class="min-w-70px">{{ __('Date') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                @forelse($order->historyOrder as $item)
                                                    <tr>
                                                        <td>{{ __($item->status) }}</td>
                                                        <td>{{ $item->vendor->name ?? $item->admin->name }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td valign="top" colspan="4" style="text-align: center;">
                                                            {{ __('No data available in table') }}</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Order history-->
                        </div>
                        <!--end::Orders-->
                    </div>
                    <!--end::Tab pane-->
                </div>
                <!--end::Tab content-->
            </div>
            <!--end::Order details page-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection
