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
                    {{ __('Employees list') }}
                </h3>
            </div>

            <div class="d-flex justify-content-center flex-wrap mb-5 mt-5">

                <div class="d-flex justify-content-end w-100" id="add_btn" data-bs-toggle="modal"
                    data-bs-target="#crud_modal" data-kt-docs-table-toolbar="base">

                    <button type="button" class="btn btn-primary w-100">
                        <span class="svg-icon svg-icon-2">
                            <i class="ki-outline ki-plus fs-2"></i>
                        </span>
                        {{ __('Add employee') }}
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
                        placeholder="{{ __('Search for employees') }}">
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
                        <th>{{ __('Employee') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('Department') }}</th>
                        <th>{{ __('Job title') }}</th>
                        <th>{{ __('Employment status') }}</th>
                        <th>{{ __('Hire date') }}</th>
                        <th>{{ __('Created at') }}</th>
                        <th class="min-w-100px">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold"></tbody>
            </table>

        </div>

    </div>


    {{-- Add/Edit Employee Modal --}}
    <form id="crud_form" class="ajax-form" action="{{ route('dashboard.employees.store') }}" method="post"
        enctype="multipart/form-data" data-success-callback="onAjaxSuccess" data-error-callback="onAjaxError">

        @csrf

        <div class="modal fade" tabindex="-1" id="crud_modal">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="form_title">
                            {{ __('Add new employee') }}
                        </h5>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-outline ki-cross fs-1"></i>
                        </div>
                    </div>

                    {{-- Section tabs — replaces one long scrolling form --}}
                    <div class="px-9 pt-6">
                        <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x fs-6" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active d-flex align-items-center gap-2" data-bs-toggle="tab"
                                    href="#tab_personal" role="tab">
                                    <i class="ki-outline ki-profile-circle fs-3"></i>
                                    {{ __('Personal') }}
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="tab" href="#tab_job"
                                    role="tab">
                                    <i class="ki-outline ki-briefcase fs-3"></i>
                                    {{ __('Job') }}
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="tab" href="#tab_files"
                                    role="tab">
                                    <i class="ki-outline ki-file-up fs-3"></i>
                                    {{ __('Files') }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="modal-body pt-6">
                        <div class="tab-content">

                            {{-- Personal tab --}}
                            <div class="tab-pane fade show active" id="tab_personal" role="tabpanel">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fv-row mb-4">
                                            <label for="name_inp" class="form-label required fs-6 fw-bold mb-3">
                                                {{ __('Full name') }}
                                            </label>
                                            <input type="text" name="name" id="name_inp"
                                                class="form-control form-control-lg form-control-solid"
                                                placeholder="{{ __('Full name') }}">
                                            <div class="fv-plugins-message-container invalid-feedback" id="name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fv-row mb-4">
                                            <label for="national_id_inp" class="form-label fs-6 fw-bold mb-3">
                                                {{ __('National ID') }}
                                            </label>
                                            <input type="text" name="national_id" id="national_id_inp"
                                                class="form-control form-control-lg form-control-solid"
                                                placeholder="{{ __('National ID') }}">
                                            <div class="fv-plugins-message-container invalid-feedback" id="national_id">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fv-row mb-4">
                                            <label for="phone_inp" class="form-label required fs-6 fw-bold mb-3">
                                                {{ __('Phone') }}
                                            </label>
                                            <input type="text" name="phone" id="phone_inp"
                                                class="form-control form-control-lg form-control-solid"
                                                placeholder="{{ __('Phone') }}">
                                            <div class="fv-plugins-message-container invalid-feedback" id="phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fv-row mb-4">
                                            <label for="email_inp" class="form-label fs-6 fw-bold mb-3">
                                                {{ __('Email') }}
                                            </label>
                                            <input type="email" name="email" id="email_inp"
                                                class="form-control form-control-lg form-control-solid"
                                                placeholder="{{ __('Email') }}">
                                            <div class="fv-plugins-message-container invalid-feedback" id="email">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="fv-row mb-4">
                                            <label for="birth_date_inp" class="form-label fs-6 fw-bold mb-3">
                                                {{ __('Birth date') }}
                                            </label>
                                            <input type="date" name="birth_date" id="birth_date_inp"
                                                class="form-control form-control-lg form-control-solid">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="fv-row mb-4">
                                            <label for="gender_inp" class="form-label fs-6 fw-bold mb-3">
                                                {{ __('Gender') }}
                                            </label>
                                            <select name="gender" id="gender_inp"
                                                class="form-select form-select-lg form-select-solid"
                                                data-placeholder="{{ __('Choose the status') }}"
                                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}" data-control="select2">
                                                <option value="">{{ __('Select gender') }}</option>
                                                <option value="male">{{ __('Male') }}</option>
                                                <option value="female">{{ __('Female') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="fv-row mb-4">
                                            <label for="marital_status_inp" class="form-label fs-6 fw-bold mb-3">
                                                {{ __('Marital status') }}
                                            </label>
                                            <select name="marital_status" id="marital_status_inp"
                                                class="form-select form-select-lg form-select-solid"
                                                data-placeholder="{{ __('Choose the status') }}"
                                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}" data-control="select2">
                                                <option value="">{{ __('Select marital status') }}</option>
                                                <option value="single">{{ __('Single') }}</option>
                                                <option value="married">{{ __('Married') }}</option>
                                                <option value="divorced">{{ __('Divorced') }}</option>
                                                <option value="widowed">{{ __('Widowed') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="fv-row mb-2">
                                    <label for="address_inp" class="form-label fs-6 fw-bold mb-3">
                                        {{ __('Address') }}
                                    </label>
                                    <textarea name="address" id="address_inp" rows="3" class="form-control form-control-lg form-control-solid"
                                        placeholder="{{ __('Address') }}"></textarea>
                                </div>

                            </div>

                            {{-- Job tab --}}
                            <div class="tab-pane fade" id="tab_job" role="tabpanel">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fv-row mb-4">
                                            <label for="department_id_inp" class="form-label fs-6 fw-bold mb-3">
                                                {{ __('Department') }}
                                            </label>
                                            <select name="department_id" id="department_id_inp"
                                                class="form-select form-select-lg form-select-solid"
                                                data-placeholder="{{ __('Choose the status') }}"
                                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}" data-control="select2">
                                                <option value="">{{ __('Select department') }}</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">
                                                        {{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="fv-plugins-message-container invalid-feedback" id="department_id">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fv-row mb-4">
                                            <label for="job_title_inp" class="form-label fs-6 fw-bold mb-3">
                                                {{ __('Job title') }}
                                            </label>
                                            <input type="text" name="job_title" id="job_title_inp"
                                                class="form-control form-control-lg form-control-solid"
                                                placeholder="{{ __('Job title') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fv-row mb-4">
                                            <label for="hire_date_inp" class="form-label fs-6 fw-bold mb-3">
                                                {{ __('Hire date') }}
                                            </label>
                                            <input type="date" name="hire_date" id="hire_date_inp"
                                                class="form-control form-control-lg form-control-solid">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fv-row mb-4">
                                            <label for="contract_type_inp" class="form-label fs-6 fw-bold mb-3">
                                                {{ __('Contract type') }}
                                            </label>
                                            <select name="contract_type" id="contract_type_inp"
                                                class="form-select form-select-lg form-select-solid"
                                                data-placeholder="{{ __('Choose the status') }}"
                                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}" data-control="select2">
                                                <option value="full_time">{{ __('Full time') }}</option>
                                                <option value="part_time">{{ __('Part time') }}</option>
                                                <option value="contractor">{{ __('Contractor') }}</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                {{-- Employment status controls whether termination date shows —
                                     avoids showing an irrelevant field to someone adding an active employee --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fv-row mb-4">
                                            <label for="employment_status_inp" class="form-label fs-6 fw-bold mb-3">
                                                {{ __('Employment status') }}
                                            </label>
                                            <select name="employment_status" id="employment_status_inp"
                                                class="form-select form-select-lg form-select-solid"
                                                data-placeholder="{{ __('Choose the status') }}"
                                                data-dir="{{ isArabic() ? 'rtl' : 'ltr' }}" data-control="select2">
                                                <option value="active">{{ __('Active') }}</option>
                                                <option value="suspended">{{ __('Suspended') }}</option>
                                                <option value="terminated">{{ __('Terminated') }}</option>
                                            </select>


                                        </div>
                                    </div>
                                    <div class="col-md-6 d-none" id="termination_date_wrapper">
                                        <div class="fv-row mb-4">
                                            <label for="termination_date_inp" class="form-label fs-6 fw-bold mb-3">
                                                {{ __('Termination date') }}
                                            </label>
                                            <input type="date" name="termination_date" id="termination_date_inp"
                                                class="form-control form-control-lg form-control-solid">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            {{-- Files tab --}}
                            <div class="tab-pane fade" id="tab_files" role="tabpanel">

                                <div class="row">
                                    <div class="col-md-4 text-center mb-6">
                                        <label class="form-label fs-6 fw-bold mb-3 d-block">
                                            {{ __('Photo') }}
                                        </label>
                                        <div class="image-input image-input-outline" data-kt-image-input="true">
                                            <div class="image-input-wrapper w-100px h-100px rounded mx-auto"
                                                style="background-image:url({{ asset('placeholder_images/avatar.png') }})">
                                            </div>
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" title="{{ __('Change photo') }}">
                                                <i class="ki-outline ki-pencil fs-6"></i>
                                                <input type="file" name="photo" id="photo_inp" accept="image/*">
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="fv-row mb-4">
                                            <label for="personal_file_inp" class="form-label fs-6 fw-bold mb-3">
                                                {{ __('Personal file') }}
                                            </label>
                                            <input type="file" name="personal_file" id="personal_file_inp"
                                                class="form-control form-control-solid">
                                            <div class="form-text">{{ __('ID copy, certificates, etc.') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="fv-row mb-4">
                                            <label for="contract_file_inp" class="form-label fs-6 fw-bold mb-3">
                                                {{ __('Contract file') }}
                                            </label>
                                            <input type="file" name="contract_file" id="contract_file_inp"
                                                class="form-control form-control-solid">
                                            <div class="form-text">{{ __('Signed employment contract') }}</div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-light-primary" id="prev_tab_btn" style="display:none">
                            <i class="ki-outline ki-arrow-right fs-3 me-1"></i>
                            {{ __('Back') }}
                        </button>

                        <div class="ms-auto d-flex gap-2">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                {{ __('Close') }}
                            </button>
                            <button type="button" class="btn btn-primary" id="next_tab_btn">
                                {{ __('Next') }}
                                <i class="ki-outline ki-arrow-left fs-3 ms-1"></i>
                            </button>
                            <button type="submit" class="btn btn-primary d-none" id="submit_btn">
                                <span class="indicator-label">{{ __('Save') }}</span>
                                <span class="indicator-progress">
                                    {{ __('Please wait....') }}
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </form>
@endsection

@push('scripts')
    <script src="{{ asset('assets/dashboard/js/global/datatable-config.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/datatables/emplosyee.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/global/crud-operations.js') }}"></script>

    <script>
        $(document).ready(function() {

            const tabOrder = [
                '#tab_personal',
                '#tab_job',
                '#tab_files'
            ];

            let currentTabIndex = 0;

            const form = $('#crud_form')[0];

            /*
            |--------------------------------------------------------------------------
            | Step Names
            |--------------------------------------------------------------------------
            */

            function getStepName(tabIndex) {

                const steps = [
                    'personal',
                    'job',
                    'files'
                ];

                return steps[tabIndex] ?? null;
            }

            /*
            |--------------------------------------------------------------------------
            | Update Footer Buttons
            |--------------------------------------------------------------------------
            */

            function updateFooterButtons(index) {

                $('#prev_tab_btn')
                    .toggle(index > 0);

                $('#next_tab_btn')
                    .toggle(
                        index < tabOrder.length - 1
                    );

                $('#submit_btn')
                    .toggleClass(
                        'd-none',
                        index < tabOrder.length - 1
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | Go To Tab
            |--------------------------------------------------------------------------
            */

            function goToTab(index) {

                if (
                    index < 0 ||
                    index >= tabOrder.length
                ) {
                    return;
                }

                const targetEl = document.querySelector(
                    `a[href="${tabOrder[index]}"]`
                );

                if (!targetEl) {
                    return;
                }

                bootstrap.Tab
                    .getOrCreateInstance(targetEl)
                    .show();

                currentTabIndex = index;

                updateFooterButtons(index);
            }

            /*
            |--------------------------------------------------------------------------
            | Clear Validation Errors
            |--------------------------------------------------------------------------
            */

            function clearValidationErrors() {

                $('#crud_form')
                    .find('.is-invalid')
                    .removeClass('is-invalid');

                $('#crud_form')
                    .find('.invalid-feedback')
                    .html('');

                $('#crud_form')
                    .find('.alert-danger')
                    .remove();

            }

            /*
            |--------------------------------------------------------------------------
            | Display Laravel Validation Errors
            |--------------------------------------------------------------------------
            */

            function displayValidationErrors(errors) {

                $.each(errors, function(field, messages) {

                    const input = $(
                        `[name="${field}"]`
                    );

                    input.addClass(
                        'is-invalid'
                    );

                    const errorContainer = $(
                        `#${field}`
                    );

                    if (errorContainer.length) {

                        errorContainer.html(
                            messages[0]
                        );

                    } else {

                        input.after(`
                        <div class="invalid-feedback">
                            ${messages[0]}
                        </div>
                    `);

                    }

                });

                // التركيز على أول حقل به خطأ
                const firstInvalidInput = $(
                    '.is-invalid:first'
                );

                if (firstInvalidInput.length) {

                    firstInvalidInput
                        .focus();

                }
            }

            /*
            |--------------------------------------------------------------------------
            | Validate Current Tab From Controller
            |--------------------------------------------------------------------------
            */

            function validateCurrentStep(callback) {

                const step = getStepName(
                    currentTabIndex
                );

                if (!step) {
                    return;
                }

                const formData = new FormData(form);

                formData.append(
                    'step',
                    step
                );

                clearValidationErrors();

                $.ajax({

                    url: "{{ route('dashboard.employees.validate-step') }}",

                    type: 'POST',

                    data: formData,

                    processData: false,

                    contentType: false,

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')

                    },

                    beforeSend: function() {

                        $('#next_tab_btn')
                            .prop(
                                'disabled',
                                true
                            );

                    },

                    success: function(response) {

                        // Validation نجح
                        if (typeof callback === 'function') {

                            callback();

                        }

                    },

                    error: function(xhr) {

                        if (
                            xhr.status === 422 &&
                            xhr.responseJSON &&
                            xhr.responseJSON.errors
                        ) {

                            displayValidationErrors(
                                xhr.responseJSON.errors
                            );

                            return;
                        }

                        console.error(
                            xhr.responseText
                        );

                    },

                    complete: function() {

                        $('#next_tab_btn')
                            .prop(
                                'disabled',
                                false
                            );

                    }

                });

            }

            /*
            |--------------------------------------------------------------------------
            | Next Button
            |--------------------------------------------------------------------------
            */

            $('#next_tab_btn').on(
                'click',
                function(e) {

                    e.preventDefault();

                    validateCurrentStep(
                        function() {

                            goToTab(
                                currentTabIndex + 1
                            );

                        }
                    );

                }
            );

            /*
            |--------------------------------------------------------------------------
            | Previous Button
            |--------------------------------------------------------------------------
            */

            $('#prev_tab_btn').on(
                'click',
                function(e) {

                    e.preventDefault();

                    goToTab(
                        currentTabIndex - 1
                    );

                }
            );

            /*
            |--------------------------------------------------------------------------
            | Direct Tab Click
            |--------------------------------------------------------------------------
            */

            document
                .querySelectorAll(
                    'a[data-bs-toggle="tab"]'
                )
                .forEach(function(tabEl) {

                    tabEl.addEventListener(
                        'show.bs.tab',
                        function(e) {

                            const targetIndex =
                                tabOrder.indexOf(
                                    tabEl.getAttribute(
                                        'href'
                                    )
                                );

                            /*
                            |--------------------------------------------------------------------------
                            | لو المستخدم رايح للأمام
                            |--------------------------------------------------------------------------
                            */

                            if (
                                targetIndex >
                                currentTabIndex
                            ) {

                                e.preventDefault();

                                validateCurrentStep(
                                    function() {

                                        goToTab(
                                            targetIndex
                                        );

                                    }
                                );

                            }

                        }
                    );

                    tabEl.addEventListener(
                        'shown.bs.tab',
                        function() {

                            currentTabIndex =
                                tabOrder.indexOf(
                                    tabEl.getAttribute(
                                        'href'
                                    )
                                );

                            updateFooterButtons(
                                currentTabIndex
                            );

                        }
                    );

                });

            /*
            |--------------------------------------------------------------------------
            | Employment Status
            |--------------------------------------------------------------------------
            */

            $('#employment_status_inp').on(
                'change',
                function() {

                    const isTerminated =
                        $(this).val() === 'terminated';

                    $('#termination_date_wrapper')
                        .toggleClass(
                            'd-none',
                            !isTerminated
                        );

                    if (!isTerminated) {

                        $('#termination_date_inp')
                            .val('')
                            .removeClass(
                                'is-invalid'
                            );

                        $('#termination_date')
                            .html('');

                    }

                }
            );

            /*
            |--------------------------------------------------------------------------
            | Add Employee
            |--------------------------------------------------------------------------
            */

            $('#add_btn').on(
                'click',
                function(e) {

                    e.preventDefault();

                    $('#form_title').text(
                        "{{ __('Add new employee') }}"
                    );

                    $('#crud_form')
                        .trigger('reset');

                    $('#crud_form')
                        .attr(
                            'action',
                            "{{ route('dashboard.employees.store') }}"
                        );

                    $('#crud_form')
                        .find(
                            "input[name='_method']"
                        )
                        .remove();

                    clearValidationErrors();

                    $('#termination_date_wrapper')
                        .addClass(
                            'd-none'
                        );

                    currentTabIndex = 0;

                    goToTab(0);

                }
            );

            /*
            |--------------------------------------------------------------------------
            | Submit Final Form
            |--------------------------------------------------------------------------
            */

            $('#crud_form').on(
                'submit',
                function(e) {

                    /*
                    |--------------------------------------------------------------------------
                    | تأكيد Validation آخر Tab قبل الحفظ
                    |--------------------------------------------------------------------------
                    */

                    e.preventDefault();

                    validateCurrentStep(
                        function() {

                            /*
                            |--------------------------------------------------------------------------
                            | بعد نجاح Validation
                            |--------------------------------------------------------------------------
                            */

                            form.submit();

                        }
                    );

                }
            );

            /*
            |--------------------------------------------------------------------------
            | Initial State
            |--------------------------------------------------------------------------
            */

            updateFooterButtons(0);

        });
    </script>
@endpush
