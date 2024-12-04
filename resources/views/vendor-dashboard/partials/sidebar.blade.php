@push('styles')
<link href="{{ asset('assets/vendor-dashboard/plugins/custom/datatables/datatables.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
<style>
    [id*='_datatable_length'],[id*='_datatable_info']{
        display: none
    }
</style>
@endpush
<!--begin::Sidebar-->
<div id="kt_sidebar" class="sidebar" data-kt-drawer="true" data-kt-drawer-name="sidebar"
    data-kt-drawer-activate="{default: true, xxl: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'300px', 'lg': '400px'}" data-kt-drawer-direction="end"
    data-kt-drawer-toggle="#kt_sidebar_toggler">
    <!--begin::Sidebar Content-->
    <div class="d-flex flex-column sidebar-body px-5 py-10" id="kt_sidebar_body">
        <!--begin::Sidebar Nav-->
        <ul class="sidebar-nav nav nav-tabs mb-10" id="kt_sidebar_tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-kt-countup-tabs="true" href="#kt_sidebar_tab_1">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs038.svg-->
                    <span class="svg-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z" fill="currentColor"/>
                            <rect x="7" y="17" width="6" height="2" rx="1" fill="currentColor"/>
                            <rect x="7" y="12" width="10" height="2" rx="1" fill="currentColor"/>
                            <rect x="7" y="7" width="6" height="2" rx="1" fill="currentColor"/>
                            <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor"/>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-kt-countup-tabs="true" href="#kt_sidebar_tab_2">
                    <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2023-01-30-131017/core/html/src/media/icons/duotune/general/gen063.svg-->
                    <span class="svg-icon ">
                        <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3" d="M21.1721 9.90759L19.6663 8.3801C19.5613 8.27722 19.4783 8.15406 19.4225 8.0181C19.3666 7.88214 19.339 7.73623 19.3413 7.58926V5.4226C19.3399 5.12576 19.2798 4.83214 19.1646 4.55858C19.0494 4.28503 18.8812 4.03693 18.6698 3.82856C18.4584 3.62018 18.2079 3.45562 17.9327 3.34434C17.6576 3.23305 17.3631 3.17724 17.0663 3.1801H14.8996C14.7526 3.18241 14.6067 3.15479 14.4708 3.09892C14.3348 3.04304 14.2116 2.96009 14.1088 2.8551L12.5921 1.3276C12.1696 0.905532 11.5968 0.668457 10.9996 0.668457C10.4024 0.668457 9.82962 0.905532 9.40711 1.3276L7.87961 2.83343C7.77673 2.93842 7.65357 3.02138 7.51761 3.07725C7.38165 3.13312 7.23575 3.16074 7.08877 3.15843H4.92211C4.62528 3.15984 4.33165 3.21989 4.05809 3.33512C3.78454 3.45035 3.53645 3.6185 3.32807 3.82989C3.11969 4.04129 2.95513 4.29178 2.84385 4.56696C2.73257 4.84215 2.67675 5.13661 2.67961 5.43343V7.6001C2.68192 7.74707 2.6543 7.89297 2.59843 8.02893C2.54255 8.16489 2.4596 8.28805 2.35461 8.39093L0.827108 9.90759C0.405044 10.3301 0.167969 10.9029 0.167969 11.5001C0.167969 12.0973 0.405044 12.6701 0.827108 13.0926L2.33294 14.6201C2.43793 14.723 2.52089 14.8461 2.57676 14.9821C2.63263 15.118 2.66025 15.264 2.65794 15.4109V17.5776C2.65935 17.8744 2.7194 18.1681 2.83463 18.4416C2.94986 18.7152 3.11801 18.9633 3.32941 19.1716C3.5408 19.38 3.79129 19.5446 4.06647 19.6559C4.34166 19.7671 4.63612 19.823 4.93294 19.8201H7.09961C7.24658 19.8178 7.39249 19.8454 7.52844 19.9013C7.6644 19.9571 7.78757 20.0401 7.89044 20.1451L9.41794 21.6726C9.84045 22.0947 10.4132 22.3317 11.0104 22.3317C11.6076 22.3317 12.1804 22.0947 12.6029 21.6726L14.1196 20.1668C14.2225 20.0618 14.3456 19.9788 14.4816 19.9229C14.6176 19.8671 14.7635 19.8394 14.9104 19.8418H17.0771C17.6747 19.8418 18.2479 19.6044 18.6705 19.1818C19.093 18.7592 19.3304 18.1861 19.3304 17.5884V15.4218C19.3281 15.2748 19.3557 15.1289 19.4116 14.9929C19.4675 14.857 19.5504 14.7338 19.6554 14.6309L21.1829 13.1034C21.3928 12.8933 21.5591 12.6438 21.6723 12.3691C21.7854 12.0945 21.8431 11.8003 21.8421 11.5033C21.8411 11.2063 21.7814 10.9124 21.6664 10.6385C21.5514 10.3647 21.3834 10.1163 21.1721 9.90759Z" fill="currentColor" fill-opacity="0.8"/>
                            <path d="M7.90276 8.65088H6.81943C6.36471 8.65088 5.99609 9.0195 5.99609 9.47421V15.0317C5.99609 15.4864 6.36471 15.855 6.81943 15.855H7.90276C8.35748 15.855 8.72609 15.4864 8.72609 15.0317V9.47421C8.72609 9.0195 8.35748 8.65088 7.90276 8.65088Z" fill="currentColor" fill-opacity="0.8"/>
                            <path d="M8.69141 10.1459L10.7714 7.00425C10.9133 6.7749 11.1313 6.60279 11.3873 6.51808C11.6433 6.43338 11.921 6.44147 12.1717 6.54096C12.4223 6.64044 12.63 6.82497 12.7582 7.0622C12.8864 7.29942 12.9271 7.57422 12.8731 7.83842L12.6022 9.38759C12.5864 9.47635 12.5902 9.56749 12.6134 9.65462C12.6366 9.74175 12.6785 9.82275 12.7364 9.89193C12.7942 9.96111 12.8665 10.0168 12.9481 10.055C13.0297 10.0933 13.1187 10.1132 13.2089 10.1134H15.3322C15.4753 10.116 15.6159 10.1516 15.7431 10.2174C15.8702 10.2831 15.9805 10.3772 16.0653 10.4925C16.1502 10.6078 16.2074 10.741 16.2324 10.8819C16.2575 11.0229 16.2497 11.1676 16.2097 11.3051L14.8664 15.6926C14.7942 15.9256 14.651 16.1303 14.4567 16.2779C14.2625 16.4256 14.0269 16.5088 13.7831 16.5159H11.1072C10.7461 16.5132 10.3944 16.3997 10.0997 16.1909L8.73474 15.1076L8.69141 10.1459Z" fill="currentColor" fill-opacity="0.8"/>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" data-kt-countup-tabs="true" href="#kt_sidebar_tab_3">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs036.svg-->
                    <span class="svg-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22 12C22 12.2 22 12.5 22 12.7L19.5 10.2L16.9 12.8C16.9 12.5 17 12.3 17 12C17 9.5 15.2 7.50001 12.8 7.10001L10.2 4.5L12.7 2C17.9 2.4 22 6.7 22 12ZM11.2 16.9C8.80001 16.5 7 14.5 7 12C7 11.7 7.00001 11.5 7.10001 11.2L4.5 13.8L2 11.3C2 11.5 2 11.8 2 12C2 17.3 6.09999 21.6 11.3 22L13.8 19.5L11.2 16.9Z"
                                fill="currentColor" />
                            <path opacity="0.3"
                                d="M22 12.7C21.6 17.9 17.3 22 12 22C11.8 22 11.5 22 11.3 22L13.8 19.5L11.2 16.9C11.5 16.9 11.7 17 12 17C14.5 17 16.5 15.2 16.9 12.8L19.5 10.2L22 12.7ZM10.2 4.5L12.7 2C12.5 2 12.2 2 12 2C6.7 2 2.4 6.1 2 11.3L4.5 13.8L7.10001 11.2C7.50001 8.8 9.5 7 12 7C12.3 7 12.5 7.00001 12.8 7.10001L10.2 4.5Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-kt-countup-tabs="true" href="#kt_sidebar_tab_4">
                    <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                    <span class="svg-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3"
                                d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z"
                                fill="currentColor" />
                            <path
                                d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-kt-countup-tabs="true" href="#kt_sidebar_tab_5">
                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs026.svg-->
                    <span class="svg-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3" d="M12.5 22C11.9 22 11.5 21.6 11.5 21V3C11.5 2.4 11.9 2 12.5 2C13.1 2 13.5 2.4 13.5 3V21C13.5 21.6 13.1 22 12.5 22Z" fill="currentColor"/>
                        <path d="M17.8 14.7C17.8 15.5 17.6 16.3 17.2 16.9C16.8 17.6 16.2 18.1 15.3 18.4C14.5 18.8 13.5 19 12.4 19C11.1 19 10 18.7 9.10001 18.2C8.50001 17.8 8.00001 17.4 7.60001 16.7C7.20001 16.1 7 15.5 7 14.9C7 14.6 7.09999 14.3 7.29999 14C7.49999 13.8 7.80001 13.6 8.20001 13.6C8.50001 13.6 8.69999 13.7 8.89999 13.9C9.09999 14.1 9.29999 14.4 9.39999 14.7C9.59999 15.1 9.8 15.5 10 15.8C10.2 16.1 10.5 16.3 10.8 16.5C11.2 16.7 11.6 16.8 12.2 16.8C13 16.8 13.7 16.6 14.2 16.2C14.7 15.8 15 15.3 15 14.8C15 14.4 14.9 14 14.6 13.7C14.3 13.4 14 13.2 13.5 13.1C13.1 13 12.5 12.8 11.8 12.6C10.8 12.4 9.99999 12.1 9.39999 11.8C8.69999 11.5 8.19999 11.1 7.79999 10.6C7.39999 10.1 7.20001 9.39998 7.20001 8.59998C7.20001 7.89998 7.39999 7.19998 7.79999 6.59998C8.19999 5.99998 8.80001 5.60005 9.60001 5.30005C10.4 5.00005 11.3 4.80005 12.3 4.80005C13.1 4.80005 13.8 4.89998 14.5 5.09998C15.1 5.29998 15.6 5.60002 16 5.90002C16.4 6.20002 16.7 6.6 16.9 7C17.1 7.4 17.2 7.69998 17.2 8.09998C17.2 8.39998 17.1 8.7 16.9 9C16.7 9.3 16.4 9.40002 16 9.40002C15.7 9.40002 15.4 9.29995 15.3 9.19995C15.2 9.09995 15 8.80002 14.8 8.40002C14.6 7.90002 14.3 7.49995 13.9 7.19995C13.5 6.89995 13 6.80005 12.2 6.80005C11.5 6.80005 10.9 7.00005 10.5 7.30005C10.1 7.60005 9.79999 8.00002 9.79999 8.40002C9.79999 8.70002 9.9 8.89998 10 9.09998C10.1 9.29998 10.4 9.49998 10.6 9.59998C10.8 9.69998 11.1 9.90002 11.4 9.90002C11.7 10 12.1 10.1 12.7 10.3C13.5 10.5 14.2 10.7 14.8 10.9C15.4 11.1 15.9 11.4 16.4 11.7C16.8 12 17.2 12.4 17.4 12.9C17.6 13.4 17.8 14 17.8 14.7Z" fill="currentColor"/>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </a>
            </li>
        </ul>
        <!--end::Sidebar Nav-->
        <!--begin::Sidebar Content-->
        <div id="kt_sidebar_content">
            <div class="hover-scroll-y" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-offset="0px"
                data-kt-scroll-dependencies="#kt_sidebar_tabs"
                data-kt-scroll-wrappers="#kt_sidebar_content, #kt_sidebar_body">
                <!--begin::Tab content-->
                <div class="tab-content px-5 px-xxl-10">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade" id="kt_sidebar_tab_1" role="tabpanel">
                        <!--begin::Statistics Widget-->
                        <div class="card card-flush card-p-0 shadow-none bg-transparent mb-10">
                            <!--begin::Header-->
                            <div class="card-header align-items-center border-0">
                                <!--begin::Title-->
                                <h3 class="card-title fw-bold text-white fs-3">{{ __('آخر الأخبار') }}</h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-wrap mb-5">
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1 mb-2 mb-md-0">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15 bg-transparent border-transparent" placeholder="{{ __('ابحث عن الأخبار') }}">
                                        <!--begin::Add customer-->
                                        <button type="button" class="btn btn-transparent" id="add_btn" data-bs-toggle="modal" data-bs-target="#crud_modal" data-kt-initialized="1">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                                                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
                                                </svg>
                                            </span><!--end::Svg Icon-->
                                        </button>
                                        <!--end::Add customer-->
                                    </div>
                                    <!--end::Search-->
                                    <!--begin::Toolbar-->
                                    <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">

                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::Group actions-->
                                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
                                        <div class="fw-bold me-5">
                                        <span class="me-2" data-kt-docs-table-select="selected_count"></span>{{ __('عنصر محدد') }}</div>
                                        <button type="button" class="btn btn-danger" data-kt-docs-table-select="delete_selected">{{ __('حذف') }}</button>
                                    </div>
                                    <!--end::Group actions-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Datatable-->
                                <table id="kt_datatable" class="table align-middle text-center table-row-dashed fs-6 gy-5">
                                    <thead>
                                        <tr class=" text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th>{{ __('الوصف') }}</th>
                                            <th class=" min-w-100px">{{ __('الإجراءات') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-semibold">
                                    </tbody>
                                </table>
                                <!--end::Datatable-->
                            </div>
                            <!--end::Card Body-->
                        </div>
                        <!--end::Statistics Widget-->
                    </div>
                    <!--end::Tab pane-->
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade" id="kt_sidebar_tab_2" role="tabpanel">
                        <!--begin::Statistics Widget-->
                        <div class="card card-flush card-p-0 shadow-none bg-transparent mb-10">
                            <!--begin::Header-->
                            <div class="card-header align-items-center border-0">
                                <!--begin::Title-->
                                <h3 class="card-title fw-bold text-white fs-3">{{ __('تجربة المستخدم للتطبيق') }}</h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-wrap mb-5">
                                    <!--begin::Toolbar-->
                                    <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">

                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Datatable-->
                                <table id="doctor_ratings_datatable" class="table align-middle text-center table-row-dashed fs-6 gy-5">
                                    <thead>
                                        <tr class=" text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th>{{ __('الطبيب') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-semibold">
                                    </tbody>
                                </table>
                                <!--end::Datatable-->
                            </div>
                            <!--end::Card Body-->

                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-wrap mb-5">
                                    <!--begin::Toolbar-->
                                    <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">

                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Datatable-->
                                <table id="patients_ratings_datatable" class="table align-middle text-center table-row-dashed fs-6 gy-5">
                                    <thead>
                                        <tr class=" text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th>{{ __('المريض') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-semibold">
                                    </tbody>
                                </table>
                                <!--end::Datatable-->
                            </div>
                            <!--end::Card Body-->
                        </div>
                        <!--end::Statistics Widget-->
                    </div>
                    <!--end::Tab pane-->
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade  fade show active" id="kt_sidebar_tab_3" role="tabpanel">
                        <!--begin::Statistics Widget-->
                        <div class="card card-flush card-p-0 shadow-none bg-transparent mb-10">
                            <!--begin::Header-->
                            <div class="card-header align-items-center border-0">
                                <!--begin::Title-->
                                <h3 class="card-title fw-bold text-white fs-3">{{ __('حجوزات اليوم') }}</h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Row-->
                                <div class="row g-5">
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <!--begin::Item-->
                                        <div
                                            class="sidebar-border-dashed d-flex flex-column justify-content-center rounded p-3 p-xxl-5">
                                            <!--begin::Value-->
                                            <div class="text-white fs-2 fs-xxl-2x fw-bold mb-1" data-kt-countup="true"
                                                data-kt-countup-value="{{ $todayReservations->count() }}" data-kt-countup-prefix="">0</div>
                                            <!--begin::Value-->
                                            <!--begin::Label-->
                                            <div class="sidebar-text-muted fs-6 fw-bold">{{ __('الكل') }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <!--begin::Item-->
                                        <div
                                            class="sidebar-border-dashed d-flex flex-column justify-content-center rounded p-3 p-xxl-5">
                                            <!--begin::Value-->
                                            <div class="text-white fs-2 fs-xxl-2x fw-bold mb-1" data-kt-countup="true"
                                                data-kt-countup-value="{{ $todayReservations->where('status', 'pending')->count() }}" data-kt-countup-prefix="">0</div>
                                            <!--begin::Value-->
                                            <!--begin::Label-->
                                            <div class="sidebar-text-muted fs-6 fw-bold">{{ __('قيد الإنتظار') }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <!--begin::Item-->
                                        <div
                                            class="sidebar-border-dashed d-flex flex-column justify-content-center rounded p-3 p-xxl-5">
                                            <!--begin::Value-->
                                            <div class="text-white fs-2 fs-xxl-2x fw-bold mb-1" data-kt-countup="true"
                                                data-kt-countup-value="{{ $todayReservations->where('status', 'confirmed')->count() }}" data-kt-countup-prefix="">0</div>
                                            <!--begin::Value-->
                                            <!--begin::Label-->
                                            <div class="sidebar-text-muted fs-6 fw-bold">{{ __('منتهية') }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <!--begin::Item-->
                                        <div
                                            class="sidebar-border-dashed d-flex flex-column justify-content-center rounded p-3 p-xxl-5">
                                            <!--begin::Value-->
                                            <div class="text-white fs-2 fs-xxl-2x fw-bold mb-1" data-kt-countup="true"
                                                data-kt-countup-value="{{ $todayReservations->where('status', 'cancelled')->count() }}" data-kt-countup-prefix="">0</div>
                                            <!--begin::Value-->
                                            <!--begin::Label-->
                                            <div class="sidebar-text-muted fs-6 fw-bold">{{ __('مغلق') }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Tasks Widget-->
                                <div class="card card-flush card-p-0 shadow-none bg-transparent mb-5">
                                    <!--begin::Header-->
                                    <div class="card-header align-items-center border-0">
                                        <!--begin::Title-->
                                        <h3 class="card-title fw-bold text-white fs-3">{{ __('الإشعارات الاخيرة') }}</h3>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body py-0">
                                        @forelse ($unreadNotifications as $notification)
                                        <!--begin::Item-->
                                        <div class="d-flex flex-nowrap align-items-center mb-7">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-50px me-5">
                                                <span class="symbol-label sidebar-bg-muted">
                                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                                    <span class="svg-icon svg-icon-2x svg-icon-{{ $notification->data['color'] }}">
                                                            {!! $notification->data['icon'] !!}
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column">
                                                <a href="{{route('dashboard.notifications.mark_as_read', $notification->id)}}" class="text-white text-hover-primary fs-6 fw-bold">{{ $notification->data['title'] }}</a>
                                                <span class="sidebar-text-muted fw-bold">{{ $notification->data['description'] }}</span>
                                                <span class="text-white fw-bold">{{$notification->created_at->diffForHumans()}}</span>
                                            </div>
                                            <!--end::Text-->
                                        </div>
                                        <!--end::Item-->
                                        @empty
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center justify-content-center mb-7">
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column align-items-center">
                                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                                <span class="svg-icon svg-icon-5x svg-icon-light mt-20 mb-5">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="currentColor"/>
                                                        <path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="currentColor"/>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <span class="sidebar-text-muted fw-bold">{{ __('لا يوجد جديد !') }}</span>
                                            </div>
                                            <!--end::Text-->
                                        </div>
                                        <!--end::Item-->
                                        @endforelse
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Tasks Widget-->
                            </div>
                            <!--end::Card Body-->
                        </div>
                        <!--end::Statistics Widget-->
                    </div>
                    <!--end::Tab pane-->
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade" id="kt_sidebar_tab_4" role="tabpanel">
                        <!--begin::Statistics Widget-->
                        <div class="card card-flush card-p-0 shadow-none bg-transparent mb-10">
                            <!--begin::Header-->
                            <div class="card-header align-items-center border-0">
                                <!--begin::Title-->
                                <h2 class="card-title fw-bold text-white fs-2">{{ __('الإعدادات') }}</h2>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Row-->
                                <div class="row g-5">
                                    <!--begin::Col-->
                                    <div class="col-12">
                                        <!--begin::Item-->
                                        <a href="{{ route('dashboard.settings.general.main') }}" class="sidebar-border-dashed d-flex flex-column justify-content-center rounded p-3 p-xxl-5 bg-light bg-opacity-0 bg-hover-opacity-10">
                                            <!--begin::Value-->
                                            <div class="text-white fs-3 fs-xxl-3x fw-bold mb-1">{{ __('الإعدادات العامة') }}</div>
                                            <!--begin::Value-->
                                            <!--begin::Label-->
                                            <div class="sidebar-text-muted fs-6 fw-bold">{{ __('يمكنك من هنا تغير اللوجو وايقونة الموقع وبيانات الموقع الاساسية.') }}</div>
                                            <!--end::Label-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-12">
                                        <!--begin::Item-->
                                        <a href="{{ route('dashboard.settings.countries.index') }}" class="sidebar-border-dashed d-flex flex-column justify-content-center rounded p-3 p-xxl-5 bg-light bg-opacity-0 bg-hover-opacity-10">
                                            <!--begin::Value-->
                                            <div class="text-white fs-3 fs-xxl-3x fw-bold mb-1">{{ __('البلاد') }}</div>
                                            <!--begin::Value-->
                                            <!--begin::Label-->
                                            <div class="sidebar-text-muted fs-6 fw-bold">{{ __('إضافة بلاد جديدة مع إمكانية الحذف المتعدد والتعديل.') }}</div>
                                            <!--end::Label-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-12">
                                        <!--begin::Item-->
                                        <a href="{{ route('dashboard.settings.cities.index') }}" class="sidebar-border-dashed d-flex flex-column justify-content-center rounded p-3 p-xxl-5 bg-light bg-opacity-0 bg-hover-opacity-10">
                                            <!--begin::Value-->
                                            <div class="text-white fs-3 fs-xxl-3x fw-bold mb-1">{{ __('المناطق') }}</div>
                                            <!--begin::Value-->
                                            <!--begin::Label-->
                                            <div class="sidebar-text-muted fs-6 fw-bold">{{ __('تحكم في المناطق المتاحة في النظام من قائمة المناطق.') }}</div>
                                            <!--end::Label-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-12">
                                        <!--begin::Item-->
                                        <a href="{{ route('dashboard.settings.areas.index') }}" class="sidebar-border-dashed d-flex flex-column justify-content-center rounded p-3 p-xxl-5 bg-light bg-opacity-0 bg-hover-opacity-10">
                                            <!--begin::Value-->
                                            <div class="text-white fs-3 fs-xxl-3x fw-bold mb-1">{{ __('المدن') }}</div>
                                            <!--begin::Value-->
                                            <!--begin::Label-->
                                            <div class="sidebar-text-muted fs-6 fw-bold">{{ __('اختر المدن التي ستكون متاحة للعملاء في التطبيق.') }}</div>
                                            <!--end::Label-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-12">
                                        <!--begin::Item-->
                                        <a href="{{ route('dashboard.settings.titles.index') }}" class="sidebar-border-dashed d-flex flex-column justify-content-center rounded p-3 p-xxl-5 bg-light bg-opacity-0 bg-hover-opacity-10">
                                            <!--begin::Value-->
                                            <div class="text-white fs-3 fs-xxl-3x fw-bold mb-1">{{ __('القاب الاطباء') }}</div>
                                            <!--begin::Value-->
                                            <!--begin::Label-->
                                            <div class="sidebar-text-muted fs-6 fw-bold">{{ __('اضف القاب الاطباء مثال (طبيب الامتياز · طبيب مقيم · طبيب أخصائي · أخصائي أول · طبيب إستشاري .. الخ).') }}</div>
                                            <!--end::Label-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-12">
                                        <!--begin::Item-->
                                        <a href="{{ route('dashboard.settings.titles.index') }}" class="sidebar-border-dashed d-flex flex-column justify-content-center rounded p-3 p-xxl-5 bg-light bg-opacity-0 bg-hover-opacity-10">
                                            <!--begin::Value-->
                                            <div class="text-white fs-3 fs-xxl-3x fw-bold mb-1">{{ __('تخصصات الاطباء') }}</div>
                                            <!--begin::Value-->
                                            <!--begin::Label-->
                                            <div class="sidebar-text-muted fs-6 fw-bold">{{ __('اضف عدد لا نهائي من التخصصات الرئيسية والفرعية.') }}</div>
                                            <!--end::Label-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-12">
                                        <!--begin::Item-->
                                        <a href="{{ route('dashboard.settings.ads.index') }}" class="sidebar-border-dashed d-flex flex-column justify-content-center rounded p-3 p-xxl-5 bg-light bg-opacity-0 bg-hover-opacity-10">
                                            <!--begin::Value-->
                                            <div class="text-white fs-3 fs-xxl-3x fw-bold mb-1">{{ __('الاعلانات') }}</div>
                                            <!--begin::Value-->
                                            <!--begin::Label-->
                                            <div class="sidebar-text-muted fs-6 fw-bold">{{ __('اعلانات للاطباء لتحسين ظهورهم في محركات البحث .') }}</div>
                                            <!--end::Label-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-12">
                                        <!--begin::Item-->
                                        <a href="{{ route('dashboard.settings.roles.index') }}" class="sidebar-border-dashed d-flex flex-column justify-content-center rounded p-3 p-xxl-5 bg-light bg-opacity-0 bg-hover-opacity-10">
                                            <!--begin::Value-->
                                            <div class="text-white fs-3 fs-xxl-3x fw-bold mb-1">{{ __('الصلاحيات') }}</div>
                                            <!--begin::Value-->
                                            <!--begin::Label-->
                                            <div class="sidebar-text-muted fs-6 fw-bold">{{ __('اضافة صلاحية الموظفين في النظام وتحديد الاذونات الخاصة بكل صلاحية.') }}</div>
                                            <!--end::Label-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-12">
                                        <!--begin::Item-->
                                        <a href="{{ route('dashboard.settings.roles.index') }}" class="sidebar-border-dashed d-flex flex-column justify-content-center rounded p-3 p-xxl-5 bg-light bg-opacity-0 bg-hover-opacity-10">
                                            <!--begin::Value-->
                                            <div class="text-white fs-3 fs-xxl-3x fw-bold mb-1">{{ __('وسائل الدفع') }}</div>
                                            <!--begin::Value-->
                                            <!--begin::Label-->
                                            <div class="sidebar-text-muted fs-6 fw-bold">{{ __('إيفاف وتعديل وسائل الدفع المتاحة في التطبيق.') }}</div>
                                            <!--end::Label-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-12">
                                        <!--begin::Item-->
                                        <a href="{{ route('dashboard.settings.trash') }}" class="sidebar-border-dashed d-flex flex-column justify-content-center rounded p-3 p-xxl-5 bg-light bg-opacity-0 bg-hover-opacity-10">
                                            <!--begin::Value-->
                                            <div class="text-white fs-3 fs-xxl-3x fw-bold mb-1">{{ __('سلة المهملات') }}</div>
                                            <!--begin::Value-->
                                            <!--begin::Label-->
                                            <div class="sidebar-text-muted fs-6 fw-bold">{{ __('عرض قائمة المحذوفين من الموظفين والاطباء الخ... وامكانية استعادتهام مرة اخرى في النظام.') }}</div>
                                            <!--end::Label-->
                                        </a>
                                        <!--end::Item-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Card Body-->
                        </div>
                        <!--end::Statistics Widget-->
                    </div>
                    <!--end::Tab pane-->
                    <!--begin::Tab pane-->
                    <div class="tab-pane" id="kt_sidebar_tab_5" role="tabpanel">
                        <!--begin::Statistics Widget-->
                        <div class="card card-flush card-p-0 shadow-none bg-transparent mb-10">
                            <!--begin::Header-->
                            <div class="card-header align-items-center border-0">
                                <!--begin::Title-->
                                <h3 class="card-title fw-bold text-white fs-3">{{ __('الإشتراكات المعلقة') }}</h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-wrap mb-5">

                                    <!--begin::Toolbar-->
                                    <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">

                                    </div>
                                    <!--end::Toolbar-->
                                    <!--begin::Group actions-->
                                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
                                        <div class="fw-bold me-5">
                                        <span class="me-2" data-kt-docs-table-select="selected_count"></span>{{ __('عنصر محدد') }}</div>
                                        <button type="button" class="btn btn-danger" data-kt-docs-table-select="delete_selected">{{ __('حذف') }}</button>
                                    </div>
                                    <!--end::Group actions-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Datatable-->
                                <table id="kt_subscriptions_datatable" class="table align-middle text-center table-row-dashed fs-6 gy-5">
                                    <thead>
                                        <tr class=" text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th>{{ __('الطبيب') }}</th>
                                            <th>{{ __('نوع الاشتراك') }}</th>
                                            <th class=" min-w-100px">{{ __('الإجراءات') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-600 fw-semibold">
                                    </tbody>
                                </table>
                                <!--end::Datatable-->
                            </div>
                            <!--end::Card Body-->
                        </div>
                        <!--end::Statistics Widget-->
                    </div>
                    <!--end::Tab pane-->

                </div>
                <!--end::Tab content-->
            </div>
        </div>
        <!--end::Sidebar Content-->
    </div>
    <!--end::Sidebar Content-->
</div>
<!--end::Sidebar-->

{{-- begin::Add Country Modal --}}
<form id="crud_form" class="ajax-form" action="{{ route('dashboard.settings.countries.store') }}" method="post" data-success-callback="onAjaxSuccess">
    @csrf
    <div class="modal fade" tabindex="-1" id="crud_modal">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form_title">{{ __('إضافة خبر جديدة') }}</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
            </div>

                <div class="modal-body">
                    <div class="fv-row mb-0 fv-plugins-icon-container">
                        <label for="description_ar_inp" class="form-label required fs-6 fw-bold mb-3">{{ __('الوصف بالعربى') }}</label>
                        <input type="text" name="description_ar" class="form-control form-control-lg form-control-solid" id="description_ar_inp" placeholder="{{ __('الوصف بالعربى') }}" >
                        <div class="fv-plugins-message-container invalid-feedback" id="description_ar"></div>
                    </div>
                    <div class="fv-row mb-0 fv-plugins-icon-container">
                        <label for="description_en_inp" class="form-label required fs-6 fw-bold mb-3">{{ __('الوصف بالانجليزى') }}</label>
                        <input type="text" name="description_en" class="form-control form-control-lg form-control-solid" id="description_en_inp" placeholder="{{ __('الوصف بالانجليزى') }}" >
                        <div class="fv-plugins-message-container invalid-feedback" id="description_en"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('اغلاق') }}</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">
                            {{ __('حفظ البيانات') }}
                        </span>
                        <span class="indicator-progress">
                            {{ __('يرجى الانتظار...') }} <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
{{-- end::Add Country Modal --}}

{{-- begin::Crud Modal --}}
<form id="crud_form2" class="ajax-form" action="" method="post" data-success-callback="onAjaxSuccess2">
    @csrf
    <div class="modal fade" tabindex="-1" id="crud_modal2">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="form_title">{{ __('') }}</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <div class="modal-body">
                    <div class="fv-row mb-0 fv-plugins-icon-container">
                        <label for="is_paid_inp" class="form-label required fs-6 fw-bold mb-3 d-block">{{ __('حالة الاشتراك') }}</label>
                        <select class="form-select form-select-solid" name="is_paid" data-dir="rtl" data-control="select2" id="is_paid_inp" data-placeholder="اختر" data-hide-search="true">
                            <option></option>
                            <option value="1">{{ __('تم الدفع') }}</option>
                            <option value="0">{{ __('الغاء الاشتراك') }}</option>
                        </select>
                        <div class="fv-plugins-message-container invalid-feedback" id="is_paid"></div>
                    </div>
                    <div class="fv-row mb-0 fv-plugins-icon-container">
                        <label for="start_date_inp" class="form-label required fs-6 fw-bold mb-3 d-block">{{ __('تاريخ بداية الإشتراك') }}</label>
                        <input class="form-control form-control-solid datepicker" name="start_date" id="start_date_inp" placeholder="{{ __('اختر تاريخ بداية الإشتراك') }}"/>
                        <div class="fv-plugins-message-container invalid-feedback" id="start_date"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('اغلاق') }}</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">
                            {{ __('حفظ البيانات') }}
                        </span>
                        <span class="indicator-progress">
                            {{ __('يرجى الانتظار...') }} <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
{{-- end::Crud Modal --}}

@push('scripts')
    <script src="{{ asset('assets/vendor-dashboard/js/global/datatable-config.js') }}"></script>
    <script src="{{ asset('assets/vendor-dashboard/js/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendor-dashboard/js/datatables/newsletters.js') }}"></script>
    <script src="{{ asset('assets/vendor-dashboard/js/datatables/doctors_ratings.js') }}"></script>
    <script src="{{ asset('assets/vendor-dashboard/js/datatables/pending_subscriptions.js') }}"></script>
    <script src="{{ asset('assets/vendor-dashboard/js/datatables/patients_ratings.js') }}"></script>

        <script>
        $(document).ready(function () {
            $("#add_btn").click(function (e) {
                e.preventDefault();

                $("#form_title").text(__('إضافة خبر جديدة'));
                $("[name='_method']").remove();
                $("#crud_form").trigger('reset');
                $("#crud_form").attr('action', `/dashboard/newsletters`);
            });
        });

        window['onAjaxSuccess'] = () => {
            $("#crud_modal").modal('hide')
            datatable.draw();
        }

        window['onAjaxSuccess2'] = () => {
            $("#crud_modal2").modal('hide');
            subscriptionsDatatable.draw();
        }
    </script>
@endpush
