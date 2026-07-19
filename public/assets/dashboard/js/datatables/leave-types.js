"use strict";

var datatable;

var KTDatatablesServerSide = (function () {
    let dbTable = "leave-types";

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
                { data: "id" },

                { data: "name" },

                { data: "code" },

                { data: "is_paid" },

                { data: "requires_approval" },

                { data: "is_active" },

                { data: "created_at" },

                { data: null },
            ],

            columnDefs: [
                // Checkbox

                {
                    targets: 0,

                    orderable: false,

                    render: function (data) {
                        return `

                            <div class="form-check form-check-sm form-check-custom form-check-solid">

                                <input class="form-check-input"

                                    type="checkbox"

                                    value="${data}" />

                            </div>

                        `;
                    },
                },

                // Name

                {
                    targets: 1,

                    render: function (data, type, row) {
                        return `

                            <div class="d-flex flex-column justify-content-center">

                                <span class="text-gray-800 fw-bold">

                                    ${row.name ?? ""}

                                </span>

                            </div>

                        `;
                    },
                },

                // Code

                {
                    targets: 2,

                    render: function (data, type, row) {
                        return `

                            <span class="badge badge-light-primary">

                                ${row.code ?? ""}

                            </span>

                        `;
                    },
                },

                // Paid

                {
                    targets: 3,

                    render: function (data, type, row) {
                        return row.is_paid
                            ? `

                                <span class="badge badge-light-success">

                                    ${__("Yes")}

                                </span>

                            `
                            : `

                                <span class="badge badge-light-danger">

                                    ${__("No")}

                                </span>

                            `;
                    },
                },

                // Requires Approval

                {
                    targets: 4,

                    render: function (data, type, row) {
                        return row.requires_approval
                            ? `

                                <span class="badge badge-light-success">

                                    ${__("Yes")}

                                </span>

                            `
                            : `

                                <span class="badge badge-light-warning">

                                    ${__("No")}

                                </span>

                            `;
                    },
                },

                // Status

                {
                    targets: 5,

                    render: function (data, type, row) {
                        return row.is_active
                            ? `

                                <span class="badge badge-light-success">

                                    ${__("Active")}

                                </span>

                            `
                            : `

                                <span class="badge badge-light-danger">

                                    ${__("Inactive")}

                                </span>

                            `;
                    },
                },

                // Created At

                {
                    targets: 6,

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

                    render: function (data, type, row) {
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

                                        <a href="#"

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

    var handleEditRows = () => {
        const editButtons = document.querySelectorAll(
            '[data-kt-docs-table-filter="edit_row"]',
        );

        editButtons.forEach((d) => {
            d.addEventListener("click", function (e) {
                e.preventDefault();

                let currentBtnIndex = $(editButtons).index(d);

                let data = datatable

                    .row(currentBtnIndex)

                    .data();

                $("#form_title").text(__("Edit leave type"));

                // Basic Information

                $("#name_inp").val(data.name);

                $("#code_inp").val(data.code);

                $("#description_inp").val(data.description);

                // Leave Settings

                $("#annual_days_inp").val(data.annual_days);

                $("#is_paid_inp").prop(
                    "checked",

                    Boolean(data.is_paid),
                );

                $("#requires_approval_inp").prop(
                    "checked",

                    Boolean(data.requires_approval),
                );

                // Status

                $("#is_active_inp").prop(
                    "checked",

                    Boolean(data.is_active),
                );

                // Update Form

                $("#crud_form").attr(
                    "action",

                    `/dashboard/${dbTable}/${data.id}`,
                );

                $("#crud_form")
                    .find("input[name='_method']")

                    .remove();

                $("#crud_form").prepend(
                    `<input type="hidden"

                        name="_method"

                        value="PUT">`,
                );

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
