@extends('dashboard.partials.master')

@push('styles')
    <link href="{{ asset('assets/dashboard/css/datatables' . (isDarkMode() ? '.dark' : '') . '.bundle.css') }}"
        rel="stylesheet" type="text/css" />

    ```
    <link
        href="{{ asset('assets/dashboard/plugins/custom/datatables/datatables.bundle' . (isArabic() ? '.rtl' : '') . '.css') }}"
        rel="stylesheet" type="text/css" />
    ```
@endpush

@section('content')
    ```
    <div class="card mb-5 mb-x-10">

        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
            data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">

            <div class="card-title m-0">
                <h3 class="fw-bold m-0">
                    {{ __('Departments list') }}
                </h3>
            </div>

            <div class="d-flex justify-content-center flex-wrap mb-5 mt-5">

                <div class="d-flex justify-content-end w-100" id="add_btn" data-bs-toggle="modal"
                    data-bs-target="#crud_modal" data-kt-docs-table-toolbar="base">

                    <button type="button" class="btn btn-primary w-100">

                        <span class="svg-icon svg-icon-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">

                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                    transform="rotate(-90 11.364 20.364)" fill="currentColor">
                                </rect>

                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                    fill="currentColor">
                                </rect>

                            </svg>
                        </span>

                        {{ __('Add department') }}

                    </button>

                </div>

            </div>

        </div>

        <div class="card-body">

            <div class="d-flex flex-stack flex-wrap mb-5">

                <div class="d-flex align-items-center position-relative my-1 mb-2 mb-md-0">

                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <i class="ki-outline ki-magnifier fs-2"></i>
                    </span>

                    <input type="text" data-kt-docs-table-filter="search"
                        class="form-control form-control-solid w-250px ps-15"
                        placeholder="{{ __('Search for departments') }}">

                </div>

                <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">

                    <div class="fw-bold me-5">

                        <span class="me-2" data-kt-docs-table-select="selected_count">
                        </span>

                        {{ __('Selected item') }}

                    </div>

                    <button type="button" class="btn btn-danger" data-kt-docs-table-select="delete_selected">

                        {{ __('delete') }}

                    </button>

                </div>

            </div>

            <table id="kt_datatable" class="table align-middle text-center table-row-dashed fs-6 gy-5">

                <thead>

                    <tr class="text-gray-400 fw-bold fs-7 text-uppercase gs-0">

                        <th class="w-10px pe-2">

                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">

                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                    data-kt-check-target="#kt_datatable .form-check-input" value="1" />

                            </div>

                        </th>

                        <th>{{ __('Name') }}</th>

                        <th>{{ __('Code') }}</th>

 
                        <th>{{ __('Created at') }}</th>

                        <th class="min-w-100px">
                            {{ __('Actions') }}
                        </th>

                    </tr>

                </thead>

                <tbody class="text-gray-600 fw-semibold">
                </tbody>

            </table>

        </div>

    </div>


    {{-- Add/Edit Department Modal --}}
    <form id="crud_form" class="ajax-form" action="{{ route('dashboard.departments.store') }}" method="post"
        data-success-callback="onAjaxSuccess" data-error-callback="onAjaxError">

        @csrf

        <div class="modal fade" tabindex="-1" id="crud_modal">

            <div class="modal-dialog modal-dialog-scrollable">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title" id="form_title">

                            {{ __('Add new department') }}

                        </h5>

                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">

                            <i class="ki-outline ki-cross fs-1"></i>

                        </div>

                    </div>


                    <div class="modal-body">

                        <div class="fv-row mb-4">

                            <label for="name_inp" class="form-label required fs-6 fw-bold mb-3">

                                {{ __('Name') }}

                            </label>

                            <input type="text" name="name" class="form-control form-control-lg form-control-solid"
                                id="name_inp" placeholder="{{ __('Name') }}">

                            <div class="fv-plugins-message-container invalid-feedback" id="name">
                            </div>

                        </div>


                        <div class="fv-row mb-4">

                            <label for="code_inp" class="form-label required fs-6 fw-bold mb-3">

                                {{ __('Code') }}

                            </label>

                            <input type="text" name="code" class="form-control form-control-lg form-control-solid"
                                id="code_inp" placeholder="{{ __('Code') }}">

                            <div class="fv-plugins-message-container invalid-feedback" id="code">
                            </div>

                        </div>


                        <div class="fv-row mb-4">

                            <label for="description_inp" class="form-label fs-6 fw-bold mb-3">

                                {{ __('Description') }}

                            </label>

                            <textarea name="description" class="form-control form-control-lg form-control-solid" id="description_inp"
                                rows="4" placeholder="{{ __('Description') }}"></textarea>

                            <div class="fv-plugins-message-container invalid-feedback" id="description">
                            </div>

                        </div>

                    </div>


                    <div class="modal-footer">

                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">

                            {{ __('Close') }}

                        </button>

                        <button type="submit" class="btn btn-primary">

                            <span class="indicator-label">
                                {{ __('Save') }}
                            </span>

                            <span class="indicator-progress">

                                {{ __('Please wait....') }}

                                <span class="spinner-border spinner-border-sm align-middle ms-2">
                                </span>

                            </span>

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>
    ```
@endsection

@push('scripts')
    <script src="{{ asset('assets/dashboard/js/global/datatable-config.js') }}"></script>

    <script src="{{ asset('assets/dashboard/js/datatables/datatables.bundle.js') }}"></script>

    <script src="{{ asset('assets/dashboard/js/datatables/departments.js') }}"></script>

    <script src="{{ asset('assets/dashboard/js/global/crud-operations.js') }}"></script>

    <script>
        $(document).ready(function() {

            $("#add_btn").click(function(e) {

                e.preventDefault();

                $("#form_title").text(
                    "{{ __('Add new department') }}"
                );

                $("[name='_method']").remove();

                $("#crud_form").trigger('reset');

                $("#crud_form").attr(
                    'action',
                    `/dashboard/departments`
                );

            });

        });
    </script>
    ```
@endpush
