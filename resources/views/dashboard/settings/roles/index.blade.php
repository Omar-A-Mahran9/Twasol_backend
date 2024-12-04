@extends('dashboard.partials.master')
@push('styles')
    <link href="{{ asset('assets/dashboard/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet"
        type="text/css" />
@endpush
@section('content')
    @include('dashboard.partials.settings-nav')
    <!--begin::Basic info-->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">{{ __('Roles list') }}</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div class="card-body">
            <!-- begin :: Row -->
            <div class="row">
                <!-- begin :: Add Role -->
                <div class="col-md-4 my-10">
                    <!--begin::Card-->
                    <div class="card h-md-100  shadow rounded">
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-center">
                            <!--begin::Button-->
                            <button type="button" class="btn btn-clear d-flex flex-column flex-center p-0"
                                id="add-role-btn" data-bs-toggle="modal" data-bs-target="#kt_modal_add_role">
                                <!--begin::Illustration-->
                                <img src="{{ asset('assets/dashboard/media/illustrations/sketchy-1/17.png') }}"
                                    alt="" class="mw-100 mh-400px">
                                <!--end::Illustration-->
                                <!--begin::Label-->
                                <div class="fw-bolder fs-3 text-gray-600 text-hover-primary">
                                    <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-11-29-094551/core/html/src/media/icons/duotune/general/gen041.svg-->
                                    <span class="svg-icon svg-icon-muted svg-icon-2x"><svg width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10"
                                                fill="currentColor" />
                                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1"
                                                transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    {{ __('Add new role') }}
                                </div>
                                <!--end::Label-->
                            </button>
                            <!--begin::Button-->
                        </div>
                        <!--begin::Card body-->
                    </div>
                    <!--begin::Card-->
                </div>
                <!-- end   :: Add Role -->
                <!-- begin :: Roles -->
                @foreach ($roles as $role)
                    <div class="col-md-4 my-10 ">
                        <!--begin::Card-->
                        <div class="card card-flush h-md-100 shadow rounded">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2> {{ $role->name }}</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-1">
                                <!--begin::Users-->
                                <div class="fw-bolder text-gray-600 mb-5">
                                    {{ $role->admins ? __('Number of employees who have this role :') . ' ' . $role->admins->count() : __('Not associated with any employee') }}
                                </div>
                                <!--end::Users-->
                                <!--begin::Permissions-->
                                <div class="d-flex flex-column text-gray-600">

                                    @foreach ($role->abilities->shuffle()->take(5) as $ability)
                                        <div class="d-flex align-items-center py-2">
                                            <span class="bullet bg-primary me-3"></span>
                                            {{ __($ability->action) . ' ' . __(ucfirst(str_replace('_', ' ', $ability->category))) }}
                                        </div>
                                    @endforeach

                                    @if ($role->abilities->count() - 5 > 0)
                                        <div class="d-flex align-items-center py-2">
                                            <span class="bullet bg-primary me-3"></span>
                                            <em>{{ $role->abilities->count() - 5 . ' ' . __('and more ...') }}</em>
                                        </div>
                                    @endif
                                </div>
                                <!--end::Permissions-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Card footer-->
                            <div class="card-footer text-center flex-wrap pt-0">
                                <a id="view-role" href="{{ route('dashboard.settings.roles.show', $role->id) }}"
                                    class="btn btn-light btn-active-primary my-1 me-2">{{ __('Show role') }}</a>

                                <button type="button" class="btn btn-light btn-active-light-primary my-1 edit-role-btn"
                                    data-role-id="{{ $role->id }}">

                                    <span class="indicator-label">{{ __('Edit role') }}</span>

                                    <!-- begin :: Indicator -->
                                    <span class="indicator-progress">{{ __('Please wait ...') }}
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                    <!-- end   :: Indicator -->

                                </button>

                            </div>
                            <!--end::Card footer-->
                        </div>
                        <!--end::Card-->
                    </div>
                @endforeach
                <!-- end   :: Roles -->
            </div>
            <!-- end   :: Row-->

        </div>
        <!--end::Content-->
    </div>
    <!--end::Basic info-->

    <!-- begin :: Add role modal  -->
    <div class="modal fade" id="kt_modal_add_role" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-750px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">{{ __('Add role') }}</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" onclick="$('#kt_modal_add_role').modal('hide')"
                        data-kt-roles-modal-action="close">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="black"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="black"></rect>
                            </svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-lg-5 my-7">
                    <!--begin::Form-->
                    <form id="role_form_add" data-form-type="add" method="POST"
                        class="form ajax-form fv-plugins-bootstrap5 fv-plugins-framework"
                        action="{{ route('dashboard.settings.roles.store') }}" data-success-callback="onAjaxSuccess">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll"
                            data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                            data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header"
                            data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px"
                            style="max-height: 637px;">

                            <!-- begin :: Row -->
                            <div class="row mb-8">

                                <!-- begin :: Column -->
                                <div class="col-md-6 fv-row">

                                    <label class="fs-5 fw-bold mb-2">{{ __('Name in arabic') }}</label>
                                    <input type="text" class="form-control" name="name_ar" id="name_ar_inp" />
                                    <p class="invalid-feedback" id="name_ar"></p>
                                </div>
                                <!-- end   :: Column -->

                                <!-- begin :: Column -->
                                <div class="col-md-6 fv-row">

                                    <label class="fs-5 fw-bold mb-2">{{ __('Name in english') }}</label>
                                    <input type="text" class="form-control" name="name_en" id="name_en_inp" />
                                    <p class="invalid-feedback" id="name_en"></p>
                                </div>
                                <!-- end   :: Column -->

                            </div>
                            <!-- end   :: Row -->

                            <!--begin::Permissions-->
                            <div class="fv-row">

                                <div class="text-center m-auto" style="width:fit-content">
                                    <p class="bg-danger invalid-feedback text-white rounded p-2" id="abilities"></p>
                                </div>

                                <!--begin::Label-->
                                <label class="fs-5 fw-bolder form-label mb-2">{{ __('Permission validations') }}</label>
                                <!--end::Label-->
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <!--begin::Table body-->
                                        <tbody class="text-gray-600 fw-bold">

                                            <!--begin::Table row-->
                                            <tr>
                                                <td class="text-gray-800">{{ __('Admin permissions') }}
                                                    <i class="fas fa-exclamation-circle ms-1 fs-7"
                                                        data-bs-toggle="tooltip" title=""
                                                        data-bs-original-title="{{ __('Allows full access to the system') }}"
                                                        aria-label="{{ __('Allows full access to the system') }}"></i>
                                                </td>
                                                <td>
                                                    <!--begin::Checkbox-->
                                                    <label class="form-check form-check-custom form-check-solid me-9">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="add-select-all" data-form-type="add">
                                                        <span class="form-check-label"
                                                            for="add-select-all">{{ __('Select all') }}</span>
                                                    </label>
                                                    <!--end::Checkbox-->
                                                </td>
                                            </tr>
                                            <!--end::Table row-->

                                            @foreach ($modules as $module)
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800">
                                                        {{ __(ucfirst(str_replace('_', ' ', $module))) }} </td>
                                                    <!--end::Label-->
                                                    <!--begin::Input group-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            @foreach ($abilities->where('category', $module) as $ability)
                                                                <!--begin::Checkbox-->
                                                                <label
                                                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                                                    <input class="form-check-input add-checkbox"
                                                                        type="checkbox" id="add_{{ $ability->name }}"
                                                                        data-id="{{ $ability->id }}" name="abilities[]">
                                                                    <label class="custom-control-label mx-4"
                                                                        for="add_{{ $ability->name }}">{{ __($ability->action) }}</label>
                                                                </label>
                                                                <!--end::Checkbox-->
                                                            @endforeach
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Input group-->
                                                </tr>
                                            @endforeach

                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Permissions-->
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-4">
                            <button type="submit" class="btn btn-primary" id="submit-btn"
                                data-kt-roles-modal-action="submit">
                                <span class="indicator-label">{{ __('Save') }}</span>
                                <span class="indicator-progress">{{ __('Please wait ...') }}
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!-- end   :: Add role modal -->


    <!-- begin :: Update role modal -->
    <div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-750px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">{{ __('Edit role') }}</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary"
                        onclick="$('#kt_modal_update_role').modal('hide')" data-kt-roles-modal-action="close">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="black"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="black"></rect>
                            </svg>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 my-7">
                    <!--begin::Form-->
                    <form id="role_form_update" data-form-type="update"
                        class="form fv-plugins-bootstrap5 fv-plugins-framework ajax-form" method="POST"
                        data-success-callback="onAjaxSuccess" data-trailing="_edit">
                        @csrf
                        @method('PUT')
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll"
                            data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                            data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header"
                            data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px"
                            style="max-height: 637px;">
                            <!--begin::Input group-->
                            <div class="fv-row mb-10 fv-plugins-icon-container">

                                <!-- begin :: Row -->
                                <div class="row mb-8">

                                    <!-- begin :: Column -->
                                    <div class="col-md-6 fv-row">

                                        <label class="fs-5 fw-bold mb-2">{{ __('Name in arabic') }}</label>
                                        <input type="text" class="form-control" id="name_ar_inp_edit"
                                            name="name_ar" />
                                        <p class="invalid-feedback" id="name_ar_edit"></p>


                                    </div>
                                    <!-- end   :: Column -->

                                    <!-- begin :: Column -->
                                    <div class="col-md-6 fv-row">

                                        <label class="fs-5 fw-bold mb-2">{{ __('Name in english') }}</label>
                                        <input type="text" class="form-control" id="name_en_inp_edit"
                                            name="name_en" />
                                        <p class="invalid-feedback" id="name_en_edit"></p>


                                    </div>
                                    <!-- end   :: Column -->

                                </div>
                                <!-- end   :: Row -->

                                <!--end::Input group-->
                                <!--begin::Permissions-->
                                <div class="fv-row">

                                    <div class="text-center m-auto" style="width:fit-content">
                                        <p class="bg-danger invalid-feedback text-white rounded p-2" id="abilities_edit">
                                        </p>
                                    </div>

                                    <!--begin::Label-->
                                    <label
                                        class="fs-5 fw-bolder form-label mb-2">{{ __('Permission validations') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Table wrapper-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                                            <!--begin::Table body-->
                                            <tbody class="text-gray-600 fw-bold">

                                                <!--begin::Table row-->
                                                <tr>
                                                    <td class="text-gray-800">{{ __('Admin permissions') }}
                                                        <i class="fas fa-exclamation-circle ms-1 fs-7"
                                                            data-bs-toggle="tooltip" title=""
                                                            data-bs-original-title="{{ __('Allows full access to the system') }}"
                                                            aria-label="{{ __('Allows full access to the system') }}"></i>
                                                    </td>
                                                    <td>
                                                        <!--begin::Checkbox-->
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="edit-select-all" data-form-type="update">
                                                            <span class="form-check-label"
                                                                for="edit-select-all">{{ __('Select all') }}</span>
                                                        </label>
                                                        <!--end::Checkbox-->
                                                    </td>
                                                </tr>
                                                <!--end::Table row-->

                                                @foreach ($modules as $module)
                                                    <tr>
                                                        <!--begin::Label-->
                                                        <td class="text-gray-800">
                                                            {{ __(ucfirst(str_replace('_', ' ', $module))) }} </td>
                                                        <!--end::Label-->
                                                        <!--begin::Input group-->
                                                        <td>
                                                            <!--begin::Wrapper-->
                                                            <div class="d-flex">
                                                                @foreach ($abilities->where('category', $module) as $ability)
                                                                    <!--begin::Checkbox-->
                                                                    <label
                                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                                        <input class="form-check-input edit-checkbox"
                                                                            type="checkbox"
                                                                            id="edit_{{ $ability->name }}"
                                                                            data-id="{{ $ability->id }}"
                                                                            name="abilities[]">
                                                                        <label class="custom-control-label mx-4"
                                                                            for="edit_{{ $ability->name }}">{{ __($ability->action) }}</label>
                                                                    </label>
                                                                    <!--end::Checkbox-->
                                                                @endforeach
                                                            </div>
                                                            <!--end::Wrapper-->
                                                        </td>
                                                        <!--end::Input group-->
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table wrapper-->
                                </div>
                                <!--end::Permissions-->
                            </div>
                            <!--end::Scroll-->
                        </div>

                        <!--begin::Actions-->
                        <div class="text-center pt-4 mt-1">
                            <button type="submit" class="btn btn-primary" id="submit-btn"
                                data-kt-roles-modal-action="submit">
                                <span class="indicator-label">{{ __('Save') }}</span>
                                <span class="indicator-progress">{{ __('Please wait ...') }}
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->

                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/dashboard/js/forms/roles/common.js') }}"></script>
    <script>
        $("#add-role-btn").click(function() {
            $('.add-checkbox').prop('checked', false);
            removeValidationMessages();
        });

        window['onAjaxSuccess'] = () => {

            showToast();

            setTimeout(function() {
                window.location.reload();
            }, 1000);
        }
    </script>
@endpush
