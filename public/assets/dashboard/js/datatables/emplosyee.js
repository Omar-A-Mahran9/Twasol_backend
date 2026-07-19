"use strict";

var datatable;

var KTDatatablesServerSide = (function () {
    let dbTable = "employees";

    // Initialize Datatable
    var initDatatable = function () {
        datatable = $("#kt_datatable").DataTable({
            language: language,
            searchDelay: searchDelay,
            processing: processing,
            serverSide: serverSide,
            order: [],
            stateSave: saveState,

            select: {
                style: "multi",
                selector: 'td:first-child input[type="checkbox"]',
                className: "row-selected",
            },

            ajax: {
                url: `/dashboard/${dbTable}`,
            },

            columns: [
                { data: "id" }, // Checkbox
                { data: "name" }, // Employee
                { data: "phone" }, // Phone
                { data: "department" }, // Department
                { data: "job_title" }, // Job title
                { data: "employment_status" }, // Employment status
                { data: "hire_date" }, // Hire date
                { data: "created_at" }, // Created at
                { data: null }, // Actions
            ],

            columnDefs: [
                // Checkbox
                {
                    targets: 0,
                    orderable: false,

                    render: function (data) {
                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="${data}" />
                            </div>
                        `;
                    },
                },

                // Employee
                {
                    targets: 1,

                    render: function (data, type, row) {
                        return `
                            <div class="d-flex flex-column justify-content-center">

                                <a href="javascript:;"
                                    class="mb-1 text-gray-800 text-hover-primary">

                                    ${row.name ?? ""}

                                </a>

                            </div>
                        `;
                    },
                },

                // Email
                {
                    targets: 2,

                    render: function (data, type, row) {
                        return `
                            <div class="d-flex flex-column justify-content-center">

                                <a href="mailto:${row.email ?? ""}"
                                    class="text-gray-800 text-hover-primary">

                                    ${row.phone ?? ""}

                                </a>

                            </div>
                        `;
                    },
                },

                // Department
                {
                    targets: 3,

                    render: function (data, type, row) {
                        return `
                            <span class="text-gray-800">
                                ${row.department?.name ?? ""}
                            </span>
                        `;
                    },
                },

                // Job Title
                {
                    targets: 4,

                    render: function (data, type, row) {
                        return `
                            <span class="text-gray-800">
                                ${row.job_title ?? ""}
                            </span>
                        `;
                    },
                },

                // Employment Status
                {
                    targets: 5,

                    render: function (data, type, row) {
                        let badgeClass = "badge-light-primary";

                        if (row.employment_status === "suspended") {
                            badgeClass = "badge-light-warning";
                        }

                        if (row.employment_status === "terminated") {
                            badgeClass = "badge-light-danger";
                        }

                        return `
                            <span class="badge ${badgeClass}">
                                ${__(row.employment_status ?? "")}
                            </span>
                        `;
                    },
                },

                // Hire Date
                {
                    targets: 6,

                    render: function (data, type, row) {
                        return `
                            <span class="text-gray-800">
                                ${row.hire_date ?? ""}
                            </span>
                        `;
                    },
                },

                // Created At
                {
                    targets: 7,

                    render: function (data, type, row) {
                        return `
                            <span class="text-gray-800">
                                ${row.created_at ?? ""}
                            </span>
                        `;
                    },
                },

                // Actions
                {
                    targets: -1,
                    data: null,
                    orderable: false,

                    render: function () {
                        return `
                            <div>

                                <a href="#"
                                    class="btn btn-light btn-active-light-primary btn-sm"
                                    data-kt-menu-trigger="click"
                                    data-kt-menu-placement="bottom-end">

                                    <span class="svg-icon svg-icon-dark svg-icon-1 m-0">
                                        <i class="ki-outline ki-dots-horizontal fs-2"></i>
                                    </span>

                                </a>

                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                    data-kt-menu="true">

                                    <div class="menu-item px-3">

                                        <a href="javascript:;"
                                            class="menu-link px-3"
                                            data-kt-docs-table-filter="edit_row">

                                            ${__("Edit")}

                                        </a>

                                    </div>

                                    <div class="menu-item px-3">

                                        <a href="javascript:;"
                                            class="menu-link px-3"
                                            data-kt-docs-table-filter="delete_row">

                                            ${__("Delete")}

                                        </a>

                                    </div>

                                </div>

                            </div>
                        `;
                    },
                },
            ],
        });

        // Re-init functions on every table redraw
        datatable.on("draw", function () {
            initToggleToolbar();
            toggleToolbars();

            handleEditRows();

            deleteRowWithURL(`/dashboard/${dbTable}/`);

            deleteSelectedRowsWithURL({
                url: `/dashboard/${dbTable}/delete-selected`,
                restoreUrl: `/dashboard/${dbTable}/restore-selected`,
            });

            KTMenu.createInstances();
        });
    };

    // Handle Edit
    var handleEditRows = function () {
        const editButtons = document.querySelectorAll(
            '[data-kt-docs-table-filter="edit_row"]',
        );

        editButtons.forEach((button) => {
            button.addEventListener("click", function (e) {
                e.preventDefault();

                // Get current row data
                const row = datatable.row($(button).closest("tr")).data();

                if (!row) {
                    return;
                }

                // Change form title
                $("#form_title").text(__("Edit employee"));

                // Personal Information
                $("#name_inp").val(row.name ?? "");
                $("#national_id_inp").val(row.national_id ?? "");
                $("#phone_inp").val(row.phone ?? "");
                $("#email_inp").val(row.email ?? "");
                $("#birth_date_inp").val(row.birth_date ?? "");

                $("#gender_inp")
                    .val(row.gender ?? "")
                    .trigger("change");

                $("#marital_status_inp")
                    .val(row.marital_status ?? "")
                    .trigger("change");

                $("#address_inp").val(row.address ?? "");

                // Job Information
                $("#department_id_inp")
                    .val(row.department_id ?? "")
                    .trigger("change");

                $("#job_title_inp").val(row.job_title ?? "");
                $("#hire_date_inp").val(row.hire_date ?? "");

                $("#contract_type_inp")
                    .val(row.contract_type ?? "")
                    .trigger("change");

                $("#employment_status_inp")
                    .val(row.employment_status ?? "")
                    .trigger("change");

                $("#termination_date_inp").val(row.termination_date ?? "");

                // Update Form Action
                $("#crud_form").attr(
                    "action",
                    `/dashboard/${dbTable}/${row.id}`,
                );

                // Remove old method
                $("#crud_form").find("input[name='_method']").remove();

                // Add PUT method
                $("#crud_form").prepend(
                    `<input type="hidden" name="_method" value="PUT">`,
                );

                // Clear old validation errors
                $("#crud_form").find(".is-invalid").removeClass("is-invalid");

                $("#crud_form").find(".invalid-feedback").html("");

                // Reset to first tab
                if (typeof currentTabIndex !== "undefined") {
                    currentTabIndex = 0;
                }

                if (typeof goToTab === "function") {
                    goToTab(0);
                }

                // Show Modal
                $("#crud_modal").modal("show");
            });
        });
    };

    // Public methods
    return {
        init: function () {
            initDatatable();

            handleSearchDatatable();

            initToggleToolbar();

            handleEditRows();

            deleteRowWithURL(`/dashboard/${dbTable}/`);

            deleteSelectedRowsWithURL({
                url: `/dashboard/${dbTable}/delete-selected`,
                restoreUrl: `/dashboard/${dbTable}/restore-selected`,
            });
        },
    };
})();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSide.init();
});
