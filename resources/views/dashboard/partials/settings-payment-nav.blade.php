<!--begin:::Tabs-->
<ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2 w-auto">
    <!--begin:::Tab item-->
    <li class="nav-item">
        <a class="nav-link text-active-primary pb-4 {{ getClassIfUrlContains('active', 'payment-way') }}"
            href="{{ route('dashboard.settings.home.payment-way.get') }}">{{ __('Payment ways') }}</a>
    </li>
    <!--end:::Tab item-->
    <!--begin:::Tab item-->
    <li class="nav-item">
        <a class="nav-link text-active-primary pb-4 {{ getClassIfUrlContains('active', 'payment-partener') }}"
            href="{{ route('dashboard.settings.home.payment-partener.get') }}">{{ __('Payment parteners') }}</a>
    </li>
    <!--end:::Tab item-->

</ul>
<!--end:::Tabs-->
