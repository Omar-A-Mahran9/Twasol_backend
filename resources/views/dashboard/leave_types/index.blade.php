@extends('dashboard.partials.master')

@push('styles')
    <link href="{{ asset('assets/dashboard/css/datatables' . (isDarkMode() ? '.dark' : '') . '.bundle.css') }}"
        rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="card mb-5 mb-x-10">

        <div class="card-header border-0 cursor-pointer">

            <div class="card-title m-0">
                <h3 class="fw-bold m-0">
                    {{ __('Leave types list') }}
                </h3>
            </div>

            <div class="d-flex justify-content-center flex-wrap mb-5 mt-5">

                <div class="d-flex justify-content-end w-100" id="add_btn" data-bs-toggle="modal"
                    data-bs-target="#crud_modal">

                    <button type="button" class="btn btn-primary w-100">

                        <i class="ki-outline ki-plus fs-2"></i>

                        {{ __('Add leave type') }}

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
                        placeholder="{{ __('Search for leave types') }}">

                </div>

                <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">

                    <div class="fw-bold me-5">

                        <span class="me-2" data-kt-docs-table-select="selected_count"></span>

                        {{ __('Selected item') }}

                    </div>

                    <button type="button" class="btn btn-danger" data-kt-docs-table-select="delete_selected">

                        {{ __('Delete') }}

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

                        <th>{{ __('Paid') }}</th>

                        <th>{{ __('Requires approval') }}</th>

                        <th>{{ __('Status') }}</th>

                        <th>{{ __('Created at') }}</th>

                        <th>{{ __('Actions') }}</th>

                    </tr>

                </thead>

                <tbody class="text-gray-600 fw-semibold"></tbody>

            </table>

        </div>

    </div>


    {{-- Add/Edit Leave Type Modal --}}

    <form id="crud_form" class="ajax-form" action="{{ route('dashboard.leave-types.store') }}" method="post"
        data-success-callback="onAjaxSuccess" data-error-callback="onAjaxError">

        @csrf

        <div class="modal fade" tabindex="-1" id="crud_modal">

            <div class="modal-dialog modal-dialog-centered modal-lg">

                <div class="modal-content">

                    {{-- Modal Header --}}

                    <div class="modal-header">

                        <div class="d-flex align-items-center">

                            <div class="symbol symbol-45px me-4">

                                <div class="symbol-label bg-light-primary">

                                    <i class="ki-outline ki-calendar-8 fs-2x text-primary"></i>

                                </div>

                            </div>

                            <div>

                                <h5 class="modal-title fw-bold" id="form_title">

                                    {{ __('Add new leave type') }}

                                </h5>

                                <span class="text-muted fs-7">

                                    {{ __('Define the leave type and its annual settings') }}

                                </span>

                            </div>

                        </div>

                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal">

                            <i class="ki-outline ki-cross fs-1"></i>

                        </div>

                    </div>


                    {{-- Modal Body --}}

                    <div class="modal-body py-8 px-lg-10">


                        {{-- Basic Information --}}

                        <div class="mb-8">

                            <div class="d-flex align-items-center mb-5">

                                <i class="ki-outline ki-information-5 fs-2 text-primary me-2"></i>

                                <h4 class="fw-bold text-gray-800 mb-0">

                                    {{ __('Basic information') }}

                                </h4>

                            </div>

                            <div class="separator separator-dashed mb-6"></div>


                            <div class="row g-5">


                                {{-- Name --}}

                                <div class="col-md-6">

                                    <div class="fv-row">

                                        <label for="name_inp" class="form-label required fw-bold">

                                            {{ __('Name') }}

                                        </label>

                                        <input type="text" name="name" id="name_inp"
                                            class="form-control form-control-solid"
                                            placeholder="{{ __('Leave type name') }}">

                                        <div id="name" class="invalid-feedback">

                                        </div>

                                    </div>

                                </div>


                                {{-- Code --}}

                                <div class="col-md-6">

                                    <div class="fv-row">

                                        <label for="code_inp" class="form-label required fw-bold">

                                            {{ __('Code') }}

                                        </label>

                                        <input type="text" name="code" id="code_inp"
                                            class="form-control form-control-solid text-uppercase"
                                            placeholder="{{ __('Leave type code') }}">

                                        <div id="code" class="invalid-feedback">

                                        </div>

                                    </div>

                                </div>


                                {{-- Description --}}

                                <div class="col-12">

                                    <div class="fv-row">

                                        <label for="description_inp" class="form-label fw-bold">

                                            {{ __('Description') }}

                                        </label>

                                        <textarea name="description" id="description_inp" rows="3" class="form-control form-control-solid"
                                            placeholder="{{ __('Leave type description') }}"></textarea>

                                        <div id="description" class="invalid-feedback">

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- Leave Settings --}}

                        <div class="mb-8">

                            <div class="d-flex align-items-center mb-5">

                                <i class="ki-outline ki-setting-2 fs-2 text-primary me-2"></i>

                                <h4 class="fw-bold text-gray-800 mb-0">

                                    {{ __('Leave settings') }}

                                </h4>

                            </div>

                            <div class="separator separator-dashed mb-6"></div>


                            <div class="row g-5">


                                {{-- Annual Days --}}

                                <div class="col-md-6">

                                    <div class="fv-row">

                                        <label for="annual_days_inp" class="form-label fw-bold">

                                            {{ __('Annual days') }}

                                        </label>

                                        <div class="input-group">

                                            <input type="number" name="annual_days" id="annual_days_inp" min="0"
                                                step="0.5" class="form-control form-control-solid"
                                                placeholder="{{ __('Enter annual days') }}">

                                            <span class="input-group-text">

                                                {{ __('Days') }}

                                            </span>

                                        </div>

                                        <div id="annual_days" class="invalid-feedback">

                                        </div>

                                        <div class="form-text">

                                            {{ __('The number of days allowed annually for this leave type.') }}

                                        </div>

                                    </div>

                                </div>


                                {{-- Paid Leave --}}

                                <div class="col-md-6">

                                    <input type="hidden" name="is_paid" value="0">

                                    <div class="form-check form-switch form-check-custom form-check-solid mt-10">

                                        <input class="form-check-input" type="checkbox" name="is_paid" value="1"
                                            id="is_paid_inp" checked>

                                        <label class="form-check-label fw-bold" for="is_paid_inp">

                                            {{ __('Paid leave') }}

                                        </label>

                                    </div>

                                    <div class="form-text ms-8">

                                        {{ __('Whether employees receive their salary during this leave.') }}

                                    </div>

                                </div>


                                {{-- Requires Approval --}}

                                <div class="col-md-6">

                                    <input type="hidden" name="requires_approval" value="0">

                                    <div class="form-check form-switch form-check-custom form-check-solid mt-10">

                                        <input class="form-check-input" type="checkbox" name="requires_approval"
                                            value="1" id="requires_approval_inp" checked>

                                        <label class="form-check-label fw-bold" for="requires_approval_inp">

                                            {{ __('Requires approval') }}

                                        </label>

                                    </div>

                                    <div class="form-text ms-8">

                                        {{ __('Whether this leave requires manager approval.') }}

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- Status --}}

                        <div>

                            <div class="d-flex align-items-center mb-5">

                                <i class="ki-outline ki-toggle-on fs-2 text-primary me-2"></i>

                                <h4 class="fw-bold text-gray-800 mb-0">

                                    {{ __('Status') }}

                                </h4>

                            </div>

                            <div class="separator separator-dashed mb-6"></div>


                            <input type="hidden" name="is_active" value="0">


                            <div class="form-check form-switch form-check-custom form-check-solid">

                                <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                    id="is_active_inp" checked>

                                <label class="form-check-label fw-bold" for="is_active_inp">

                                    {{ __('Active') }}

                                </label>

                            </div>

                            <div class="form-text ms-8">

                                {{ __('Inactive leave types cannot be assigned to employees.') }}

                            </div>

                        </div>

                    </div>


                    {{-- Modal Footer --}}

                    <div class="modal-footer">

                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">

                            {{ __('Close') }}

                        </button>

                        <button type="submit" class="btn btn-primary">

                            <i class="ki-outline ki-check fs-2"></i>

                            {{ __('Save') }}

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>
@endsection


@push('scripts')
    <script src="{{ asset('assets/dashboard/js/global/datatable-config.js') }}"></script>

    <script src="{{ asset('assets/dashboard/js/datatables/datatables.bundle.js') }}"></script>

    <script src="{{ asset('assets/dashboard/js/datatables/leave-types.js') }}"></script>

    <script src="{{ asset('assets/dashboard/js/global/crud-operations.js') }}"></script>
@endpush
