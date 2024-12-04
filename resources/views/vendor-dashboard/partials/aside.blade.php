<!--begin::Aside-->
<div id="kt_aside" class="aside py-9" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto px-9 mb-9" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="{{ route('vendor.home') }}">
            @if (isArabic())
                <!-- Show for light mode only -->
                <img alt="Logo" src="{{ asset('placeholder_images/platin-logo.svg') }}"
                    class="theme-light-show h-50px logo" />

                <!-- Show for dark mode light-->
                <img alt="Logo" src="{{ asset('placeholder_images/platin-logo-white.svg') }}"
                    class="theme-dark-show h-50px logo" />
            @else
                <!-- Show for light mode only -->
                <img alt="Logo" src="{{ asset('placeholder_images/platin-logo.svg') }}"
                    class="theme-light-show h-50px logo" />

                <!-- Show for dark mode light-->
                <img alt="Logo" src="{{ asset('placeholder_images/platin-logo-white.svg') }}"
                    class="theme-dark-show h-50px logo" />
            @endif
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid ps-5 pe-10 mb-9" id="kt_aside_menu">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
            data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu, #kt_aside_menu_wrapper" data-kt-scroll-offset="100">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention menu-active-bg fw-semibold my-auto"
                id="#kt_aside_menu" data-kt-menu="true">
                <!--begin:Menu item-->
                <a href="{{ route('vendor.home') }}"
                    class="menu-item menu-accordion {{ getClassIfUrlContains('show', 'home') }}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/keenthemes/metronic/docs/core/html/src/media/icons/duotune/layouts/lay002.svg-->
                            <span class="svg-icon svg-icon-muted svg-icon-2hx">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.24 2H5.34C3.15 2 2 3.15 2 5.33V7.23C2 9.41 3.15 10.56 5.33 10.56H7.23C9.41 10.56 10.56 9.41 10.56 7.23V5.33C10.57 3.15 9.42 2 7.24 2Z"
                                        fill="#919EAB" />
                                    <path
                                        d="M18.6714 2H16.7714C14.5914 2 13.4414 3.15 13.4414 5.33V7.23C13.4414 9.41 14.5914 10.56 16.7714 10.56H18.6714C20.8514 10.56 22.0014 9.41 22.0014 7.23V5.33C22.0014 3.15 20.8514 2 18.6714 2Z"
                                        fill="#919EAB" />
                                    <path
                                        d="M18.6714 13.4302H16.7714C14.5914 13.4302 13.4414 14.5802 13.4414 16.7602V18.6602C13.4414 20.8402 14.5914 21.9902 16.7714 21.9902H18.6714C20.8514 21.9902 22.0014 20.8402 22.0014 18.6602V16.7602C22.0014 14.5802 20.8514 13.4302 18.6714 13.4302Z"
                                        fill="#919EAB" />
                                    <path
                                        d="M7.24 13.4302H5.34C3.15 13.4302 2 14.5802 2 16.7602V18.6602C2 20.8502 3.15 22.0002 5.33 22.0002H7.23C9.41 22.0002 10.56 20.8502 10.56 18.6702V16.7702C10.57 14.5802 9.42 13.4302 7.24 13.4302Z"
                                        fill="#919EAB" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{ __('Dashboard') }}</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <a href="{{ route('vendor.branches.index') }}"
                    class="menu-item menu-accordion {{ getClassIfUrlContains('show', 'branches') }}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/keenthemes/metronic/docs/core/html/src/media/icons/duotune/maps/map002.svg-->
                            <span class="svg-icon svg-icon-muted svg-icon-2hx">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.62906 3.57018C7.80845 3.47233 7.99906 3.62286 7.99906 3.82719V17.383C7.99906 17.6063 7.84665 17.795 7.64926 17.8993C7.64249 17.9029 7.63576 17.9065 7.62906 17.9102L5.27906 19.2502C3.63906 20.1902 2.28906 19.4102 2.28906 17.5102V7.78018C2.28906 7.15018 2.73906 6.37018 3.29906 6.05018L7.62906 3.57018V3.57018Z"
                                        fill="#919EAB" />
                                    <path
                                        d="M14.7219 6.10241C14.8922 6.18676 15 6.3604 15 6.55047V19.7036C15 20.0721 14.615 20.314 14.283 20.1541L10.033 18.1065C9.85998 18.0231 9.75 17.8481 9.75 17.656V4.44571C9.75 4.07486 10.1396 3.83306 10.4719 3.99765L14.7219 6.10241Z"
                                        fill="#919EAB" />
                                    <path
                                        d="M22 6.49006V16.2201C22 16.8501 21.55 17.6301 20.99 17.9501L17.4986 19.951C17.1653 20.1421 16.75 19.9014 16.75 19.5172V6.33038C16.75 6.15087 16.8462 5.98513 17.0021 5.89615L19.01 4.75006C20.65 3.81006 22 4.59006 22 6.49006Z"
                                        fill="#919EAB" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{ __('Branches') }}</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <a href="{{ route('vendor.products.index') }}"
                    class="menu-item menu-accordion {{ getClassIfUrlContains('show', 'products') }}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/keenthemes/metronic/docs/core/html/src/media/icons/duotune/ecommerce/ecm001.svg-->
                            <span class="svg-icon svg-icon-muted svg-icon-2hx">
                                <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3.82541 6.08621L3.643 4.57464C3.5773 3.93384 3.0364 3.44656 2.39089 3.44656H1.71649C1.29919 3.44656 0.960937 3.10905 0.960938 2.69276C0.960938 2.27647 1.29919 1.93896 1.71649 1.93896H2.39089C3.81144 1.93896 5.00168 3.01125 5.14626 4.42121L5.28392 5.76368H20.6172C20.9342 5.76368 21.1724 6.05242 21.1114 6.36279L19.7718 13.1788C19.4475 14.8288 17.998 16.019 16.3128 16.019H8.2843C8.51585 17.0385 9.42891 17.7774 10.494 17.7774H16.8175C16.8547 17.7774 16.8917 17.7801 16.8731 17.7834C16.9285 17.7794 16.9842 17.7774 17.0401 17.7774C18.2917 17.7774 19.3063 18.7897 19.3063 20.0385C19.3063 21.2872 18.2917 22.2996 17.0401 22.2996C15.7885 22.2996 14.7739 21.2872 14.7739 20.0385C14.7739 19.7783 14.8181 19.5242 14.9028 19.285H12.1277C12.2124 19.5242 12.2566 19.7783 12.2566 20.0385C12.2566 21.2872 11.242 22.2996 9.99041 22.2996C8.73881 22.2996 7.72421 21.2872 7.72421 20.0385C7.72421 19.4878 7.92289 18.9688 8.27201 18.5642C7.41318 17.9402 6.84663 16.9776 6.73678 15.9033L6.72518 15.7899C5.49555 15.3228 4.58805 14.1874 4.46716 12.8085L4.16266 9.33484C4.15752 9.31336 4.15375 9.29129 4.15143 9.26872L3.82541 6.08621ZM9.99041 21.0433C10.5466 21.0433 10.9975 20.5934 10.9975 20.0385C10.9975 19.4835 10.5466 19.0336 9.99041 19.0336C9.43421 19.0336 8.98331 19.4835 8.98331 20.0385C8.98331 20.5934 9.43421 21.0433 9.99041 21.0433ZM17.0401 21.0433C17.5963 21.0433 18.0472 20.5934 18.0472 20.0385C18.0472 19.4835 17.5963 19.0336 17.0401 19.0336C16.4839 19.0336 16.033 19.4835 16.033 20.0385C16.033 20.5934 16.4839 21.0433 17.0401 21.0433Z"
                                        fill="#919EAB" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{ __('Products') }}</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <a href="{{ route('vendor.orders.index') }}"
                    class="menu-item menu-accordion {{ getClassIfUrlContains('show', 'orders') }}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/keenthemes/metronic/docs/core/html/src/media/icons/duotune/ecommerce/ecm006.svg-->
                            <span class="svg-icon svg-icon-muted svg-icon-2hx">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.0984 6.94C20.0984 7.48 19.8084 7.97 19.3484 8.22L17.6084 9.16L16.1284 9.95L13.0584 11.61C12.7284 11.79 12.3684 11.88 11.9984 11.88C11.6284 11.88 11.2684 11.79 10.9384 11.61L4.64844 8.22C4.18844 7.97 3.89844 7.48 3.89844 6.94C3.89844 6.4 4.18844 5.91 4.64844 5.66L6.61844 4.6L8.18844 3.75L10.9384 2.27C11.5984 1.91 12.3984 1.91 13.0584 2.27L19.3484 5.66C19.8084 5.91 20.0984 6.4 20.0984 6.94Z"
                                        fill="#919EAB" />
                                    <path
                                        d="M9.89875 12.7901L4.04875 9.87014C3.59875 9.64014 3.07875 9.67014 2.64875 9.93014C2.21875 10.1901 1.96875 10.6501 1.96875 11.1501V16.6801C1.96875 17.6401 2.49875 18.5001 3.35875 18.9301L9.20875 21.8501C9.40875 21.9501 9.62875 22.0001 9.84875 22.0001C10.1088 22.0001 10.3688 21.9301 10.5988 21.7801C11.0288 21.5201 11.2787 21.0601 11.2787 20.5601V15.0301C11.2887 14.0801 10.7587 13.2201 9.89875 12.7901Z"
                                        fill="#919EAB" />
                                    <path
                                        d="M22.0309 11.1501V16.6801C22.0309 17.6301 21.5009 18.4901 20.6409 18.9201L14.7909 21.8501C14.5909 21.9501 14.3709 22.0001 14.1509 22.0001C13.8909 22.0001 13.6309 21.9301 13.3909 21.7801C12.9709 21.5201 12.7109 21.0601 12.7109 20.5601V15.0401C12.7109 14.0801 13.2409 13.2201 14.1009 12.7901L16.2509 11.7201L17.7509 10.9701L19.9509 9.87013C20.4009 9.64013 20.9209 9.66013 21.3509 9.93013C21.7709 10.1901 22.0309 10.6501 22.0309 11.1501Z"
                                        fill="#919EAB" />
                                    <path
                                        d="M17.6111 9.16L16.1311 9.95L6.62109 4.6L8.19109 3.75L17.3711 8.93C17.4711 8.99 17.5511 9.07 17.6111 9.16Z"
                                        fill="#919EAB" />
                                    <path
                                        d="M17.75 10.9702V13.2402C17.75 13.6502 17.41 13.9902 17 13.9902C16.59 13.9902 16.25 13.6502 16.25 13.2402V11.7202L17.75 10.9702Z"
                                        fill="#919EAB" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{ __('Orders') }}</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--end:Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
    <!--begin::Footer-->
    <div class="aside-footer flex-column-auto px-9" id="kt_aside_footer">
        <!--begin::User panel-->
        <div class="d-flex flex-stack">
            <!--begin::Wrapper-->
            <div class="d-flex align-items-center">
                <!--begin::Avatar-->
                <div class="symbol symbol-circle symbol-40px">
                    <img src="{{ auth()->user()->logo_path }}" alt="photo" />
                </div>
                <!--end::Avatar-->
                <!--begin::User info-->
                <div class="ms-2">
                    <!--begin::Name-->
                    <a href="{{ route('vendor.profile-info') }}"
                        class="text-gray-800 text-hover-primary fs-6 fw-bold lh-1">{{ auth()->user()->brand ?? auth()->user()->name }}</a>
                    <!--end::Name-->
                </div>
                <!--end::User info-->
            </div>
            <!--end::Wrapper-->
            <!--begin::User menu-->
            <div class="ms-1">
                <div class="btn btn-sm btn-icon btn-active-color-primary position-relative me-n2"
                    data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-overflow="true"
                    data-kt-menu-placement="top-end">
                    <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                    <span class="svg-icon svg-icon-1" style="color: #DEB893">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3"
                                d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z"
                                fill="currentColor" />
                            <path
                                d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--begin::User account menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                    data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-50px me-5">
                                <img alt="Logo" src="{{ auth()->user()->logo_path }}" />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Username-->
                            <div class="d-flex flex-column">
                                <div class="fw-bolder d-flex align-items-center fs-5">
                                    {{ auth()->user()->brand ?? auth()->user()->name }}
                                </div>
                                <a href="#" class="fw-bold text-muted text-hover-primary fs-7">
                                    {{ auth()->user()->email }}</a>
                            </div>
                            <!--end::Username-->
                        </div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    {{--  <div class="separator my-2"></div>  --}}
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    {{--  <div class="menu-item px-5">
                        <div class="menu-content px-5">
                            <label class="form-check form-switch form-check-custom form-check-solid" for="toggle-theme-mode">
                                <input class="form-check-input w-30px h-20px" type="checkbox" {{ setting('theme_mode') == 'dark' ? 'checked' : 'false' }} name="mode" id="toggle-theme-mode"  />
                                <span class="form-check-label text-gray-600 fs-7">{{__("Night mode")}}</span>
                            </label>
                        </div>
                    </div>  --}}
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    {{--  <div class="menu-item px-5">
                        <div class="menu-content px-5">
                            <label class="form-check form-switch form-check-custom form-check-solid" for="toggle-notifications">
                                <input class="form-check-input w-30px h-20px" type="checkbox" {{ setting('notification_status') ? 'checked' : ''}} name="mode" id="toggle-notifications"  />
                                <span class="form-check-label text-gray-600 fs-7">{{__("Notification sound")}}</span>
                            </label>
                        </div>
                    </div>  --}}
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5 my-1">
                        <a href="{{ route('vendor.profile-info') }}" class="menu-link px-5">{{ __('Profile') }}</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                        data-kt-menu-placement="right-start" data-kt-menu-offset="-15px, 0">
                        <a href="{{ route('vendor.change-language', 'en') }}" class="menu-link px-5">
                            <span class="menu-title position-relative">
                                {{ __('Language') }}
                                @if (isArabic())
                                    <span
                                        class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                                        {{ __('Arabic') }}
                                        <img class="w-15px h-15px rounded-1 ms-2"
                                            src="{{ asset('assets/dashboard/media/flags/saudi-arabia.svg') }}"
                                            alt="" />
                                    </span>
                                @else
                                    <span
                                        class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                                        {{ __('English') }}
                                        <img class="w-15px h-15px rounded-1 ms-2"
                                            src="{{ asset('assets/dashboard/media/flags/united-states.svg') }}"
                                            alt="" />
                                    </span>
                                @endif
                            </span>
                        </a>
                        <!--begin::Menu sub-->
                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="{{ route('vendor.change-language', 'en') }}"
                                    class="menu-link d-flex px-5 @if (!isArabic()) active @endif">
                                    <span class="symbol symbol-20px me-4">
                                        <img class="rounded-1"
                                            src="{{ asset('assets/dashboard/media/flags/united-states.svg') }}"
                                            alt="" />
                                    </span>{{ __('English') }}
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="{{ route('vendor.change-language', 'ar') }}"
                                    class="menu-link d-flex px-5 @if (isArabic()) active @endif">
                                    <span class="symbol symbol-20px me-4">
                                        <img class="rounded-1"
                                            src="{{ asset('assets/dashboard/media/flags/saudi-arabia.svg') }}"
                                            alt="" />
                                    </span>{{ __('Arabic') }}
                                </a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu sub-->
                    </div>
                    <form class="logout-form" method="post" action="{{ route('vendor.logout') }}">
                        @csrf
                    </form>
                    <!--end:Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <a href="javascript:" onclick="$('.logout-form').submit()"
                            class="menu-link px-5">{{ __('Logout') }}</a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::User account menu-->
            </div>
            <!--end::User menu-->
        </div>
        <!--end::User panel-->
    </div>
    <!--end::Footer-->
</div>
<!--end::Aside-->

@push('scripts')
    <script>
        $("#logout-btn").click(function(e) {
            e.preventDefault();
            $("#logout-form").submit();
        });
        $("#toggle-notifications").change(function() {

            let notificationSoundStatus = $(this).is(":checked");

            $.ajax({
                type: "post",
                url: "/dashboard/notifications/change-status-sound",
                data: {
                    status: notificationSoundStatus
                },
                success: function(response) {
                    showToast(response);
                    notificationSoundOn = notificationSoundStatus;
                }
            });
        });
        $("#toggle-theme-mode").change(function() {
            let themeMode = $(this).is(":checked");

            if (themeMode)
                mode = 'dark';
            else
                mode = 'light';

            KTThemeMode.setMode(mode);

            $.ajax({
                type: "GET",
                url: `/dashboard/change-theme-mode/${mode}`,
                success: function(response) {
                    $("#logo").attr('src', `/assets/dashboard/media/logos/logo-${mode}.png`)
                    showToast();
                }
            });

        });
    </script>
@endpush
