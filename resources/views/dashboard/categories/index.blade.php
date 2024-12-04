@extends('dashboard.partials.master')
@push('styles')
    <link href="{{ asset('assets/dashboard/css/datatables' . (isDarkMode() ? '.dark' : '') . '.bundle.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('assets/dashboard/plugins/custom/datatables/datatables.bundle' . (isArabic() ? '.rtl' : '') . '.css') }}"
        rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <!--begin::Basic info-->
    <div class="card mb-5 mb-x-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">
                    {{ request()->query('type') == 'parent' ? __('Main categories list') : __('Subcategoreis list') }}</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div class="card-body">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack flex-wrap mb-5">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1 mb-2 mb-md-0">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="currentColor"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" data-kt-docs-table-filter="search"
                        class="form-control form-control-solid w-250px ps-15"
                        placeholder="{{ __('Search for categories') }}">
                </div>
                <!--end::Search-->
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end gap-1" data-kt-docs-table-toolbar="base">
                    <!--begin::Add customer-->
                    <a
                        href="{{ request()->query('type') == 'parent' ? route('dashboard.categories.index', ['type' => 'sub']) : route('dashboard.categories.index', ['type' => 'parent']) }}">
                        <button type="button" class="btn btn-primary">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z"
                                        fill="currentColor" />
                                    <path opacity="0.3"
                                        d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            {{ request()->query('type') == 'parent' ? __('Subcategories') : __('Main categories') }}
                        </button>
                    </a>
                    <!--end::Add customer-->
                    @if (request()->query('type') == 'sub')
                        <div id="add_btn" data-bs-toggle="modal" data-bs-target="#crud_modal">
                            <!--begin::Add customer-->
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                                data-bs-original-title="Coming Soon" data-kt-initialized="1">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                            rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                            fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                {{ __('Add subcategory') }}
                            </button>
                            <!--end::Add customer-->
                        </div>
                    @endif
                    <!--end::Add customer-->
                    @if (request()->query('type') == 'parent')
                        <div id="add_btn" data-bs-toggle="modal" data-bs-target="#crud_modal">
                            <!--begin::Add customer-->
                            <button type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                                data-bs-original-title="Coming Soon" data-kt-initialized="1">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                            rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                            fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                {{ __('Add category') }}
                            </button>
                            <!--end::Add customer-->
                        </div>
                    @endif
                </div>
                <!--end::Toolbar-->
                <!--begin::Group actions-->
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
                    <div class="fw-bold me-5">
                        <span class="me-2" data-kt-docs-table-select="selected_count"></span>{{ __('Selected item') }}
                    </div>
                    <button type="button" class="btn btn-danger"
                        data-kt-docs-table-select="delete_selected">{{ __('delete') }}</button>
                </div>
                <!--end::Group actions-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Datatable-->
            <table id="kt_datatable" class="table align-middle text-center table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class=" text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            @if (request('type') == 'sub')
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                        data-kt-check-target="#kt_datatable .form-check-input" value="1" />
                                </div>
                            @else
                                #
                            @endif
                        </th>
                        <th style="text-align: center; width: 415.25px;">{{ __('Name') }}</th>
                        <th style="text-align: center; width: 415.25px;">{{ __('Image') }}</th>
                        <th style="text-align: center; width: 415.25px;">{{ __('Description') }}</th>
                        @if (request('type') == 'sub')
                            <th style="text-align: center; width: 415.25px;">{{ __('Main category') }}</th>
                        @endif
                        <th style="text-align: center; width: 415.25px;">{{ __('Meta tag keywords') }}</th>
                        <th style="text-align: center; width: 415.25px;">{{ __('Meta tag key description') }}</th>
                        <th style="text-align: center; width: 415.25px;">{{ __('Created at') }}</th>
                        <th style="text-align: center; width: 415.25px;" class=" min-w-100px">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                </tbody>
            </table>
            <!--end::Datatable-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Basic info-->

    {{-- begin::Add Category Modal --}}
    <form id="crud_form" class="ajax-form" action="{{ route('dashboard.categories.store') }}" method="post"
        data-success-callback="onAjaxSuccess" data-error-callback="onAjaxError">
        @csrf
        <input type="hidden" value="{{ request('type') }}" name="category_type">
        <div class="modal fade" tabindex="-1" id="crud_modal">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="form_title">
                            @if (request('type') == 'parent')
                                {{ __('Add category') }}
                            @else
                                {{ __('Add new subcategory') }}
                            @endif

                        </h5>
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <div class="d-flex flex-column justify-content-center">
                            <label for="image_inp"
                                class="form-label required text-center fs-6 fw-bold mb-3">{{ __('Image') }}</label>
                            <x-dashboard.upload-image-inp name="image" :image="null" :directory="null"
                                placeholder="default.svg" type="editable"></x-dashboard.upload-image-inp>
                        </div>
                        <div class="fv-row mb-0 fv-plugins-icon-container">
                            <label for="name_ar_inp"
                                class="form-label required fs-6 fw-bold mb-3">{{ __('Name ar') }}</label>
                            <input type="text" name="name_ar" class="form-control form-control-lg form-control-solid"
                                id="name_ar_inp" placeholder="{{ __('Name ar') }}">
                            <div class="fv-plugins-message-container invalid-feedback" id="name_ar"></div>
                        </div>
                        <div class="fv-row mb-0 fv-plugins-icon-container">
                            <label for="name_en_inp"
                                class="form-label required fs-6 fw-bold mb-3">{{ __('Name en') }}</label>
                            <input type="text" name="name_en" class="form-control form-control-lg form-control-solid"
                                id="name_en_inp" placeholder="{{ __('Name en') }}">
                            <div class="fv-plugins-message-container invalid-feedback" id="name_en"></div>
                        </div>
                        @if (request('type') === 'sub')
                            <div class="fv-row mb-0 fv-plugins-icon-container">
                                <label class="form-label required fs-6 fw-bold mb-3">{{ __('Main category') }}</label>
                                <select class="form-select form-select-solid" data-control="select2" multiple
                                    name="parent_id[]" id="parent-category-sp"
                                    data-placeholder="{{ __('Choose the main category') }}"
                                    data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}">
                                </select>
                                <div class="fv-plugins-message-container invalid-feedback" id="parent_id"></div>
                            </div>
                        @endif
                        <div class="fv-row mb-0 fv-plugins-icon-container">
                            <label for="description_ar_inp"
                                class="form-label required fs-6 fw-bold mb-3">{{ __('Description ar') }}</label>
                            <input type="text" name="description_ar"
                                class="form-control form-control-lg form-control-solid" id="description_ar_inp"
                                placeholder="{{ __('Description ar') }}">
                            <div class="fv-plugins-message-container invalid-feedback" id="description_ar"></div>
                        </div>
                        <div class="fv-row mb-0 fv-plugins-icon-container">
                            <label for="description_en_inp"
                                class="form-label required fs-6 fw-bold mb-3">{{ __('Description en') }}</label>
                            <input type="text" name="description_en"
                                class="form-control form-control-lg form-control-solid" id="description_en_inp"
                                placeholder="{{ __('Description en') }}">
                            <div class="fv-plugins-message-container invalid-feedback" id="description_en"></div>
                        </div>
                        <div class="fv-row mb-0 fv-plugins-icon-container">
                            <label for="meta_tag_key_words_inp"
                                class="form-label fs-6 fw-bold mb-3">{{ __('Meta tag keywords') }}</label>
                            <input name="meta_tag_key_words" class="form-control form-control-lg form-control-solid"
                                id="meta_tag_key_words_inp" placeholder="{{ __('Meta tag keywords') }}">
                            <div class="fv-plugins-message-container invalid-feedback" id="meta_tag_key_words"></div>
                        </div>
                        <div class="fv-row mb-0 fv-plugins-icon-container">
                            <label for="meta_tag_key_description_inp"
                                class="form-label fs-6 fw-bold mb-3">{{ __('Meta tag key description') }}</label>
                            <input type="text" name="meta_tag_key_description"
                                class="form-control form-control-lg form-control-solid" id="meta_tag_key_description_inp"
                                placeholder="{{ __('Meta tag key description') }}">
                            <div class="fv-plugins-message-container invalid-feedback" id="meta_tag_key_description">
                            </div>
                        </div>
                        @if (request('type') === 'parent')
                            <div class="fv-row mb-0 fv-plugins-icon-container">
                                <div class="d-flex flex-stack">
                                    <!--begin::Label-->
                                    <div class="me-5">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold">{{ __('show in home') }}</label>
                                        <!--end::Label-->

                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Switch-->
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input" name="show_in_home" type="checkbox"
                                            value="1" id="kt_modal_update_address_billing">
                                        <!--end::Input-->
                                    </label>
                                    <!--end::Switch-->
                                </div>
                                <div class="fv-plugins-message-container invalid-feedback" id="show_in_home">
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">
                                {{ __('Save') }}
                            </span>
                            <span class="indicator-progress">
                                {{ __('Please wait....') }} <span
                                    class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- end::Add Country Modal --}}
    <div class="row attachments">
    </div>
@endsection
@push('scripts')
    <script>
        let categoryType = "{{ request('type') }}"
    </script>
    <script src="{{ asset('assets/dashboard/js/global/datatable-config.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/datatables/categories.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/global/crud-operations.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/forms/categories/common.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
    <script>
        $(document).ready(() => {

            new Tagify(document.getElementById('meta_tag_key_words_inp'), {
                originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
            });
        });
        $(document).ready(function() {
            $("#add_btn").click(function(e) {
                e.preventDefault();

                $("#form_title").text(__('Add new subcategory'));
                $("[name='_method']").remove();
                $(`[name='parent_id[]']`).val('').attr('selected', true);
                $(`[name='parent_id[]']`).trigger('change');
                $("#crud_form").trigger('reset');
                $("#crud_form").attr('action', `/dashboard/categories?type=${categoryType}`);
                $('.image-input-wrapper').css('background-image', `url('/placeholder_images/default.svg')`);
            });
        });
    </script>
@endpush
