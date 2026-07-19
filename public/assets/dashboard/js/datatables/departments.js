"use strict";

var datatable;

var KTDatatablesServerSide = (function () {
    let dbTable = "departments";

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
                            <span class="text-gray-800 fw-bold">
                                ${row.name ?? ""}
                            </span>
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

                // Created At
                {
                    targets: 3,
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

                                    <i class="ki-outline ki-dots-horizontal fs-2"></i>

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

    var handleEditRows = () => {
        const editButtons = document.querySelectorAll(
            '[data-kt-docs-table-filter="edit_row"]',
        );

        editButtons.forEach((d) => {
            d.addEventListener("click", function (e) {
                e.preventDefault();

                let currentBtnIndex = $(editButtons).index(d);

                let data = datatable.row(currentBtnIndex).data();

                $("#form_title").text(__("Edit department"));

                $("#name_inp").val(data.name);
                $("#code_inp").val(data.code);
                $("#description_inp").val(data.description);

                $("#crud_form").attr(
                    "action",
                    `/dashboard/${dbTable}/${data.id}`,
                );

                $("#crud_form").find("input[name='_method']").remove();

                $("#crud_form").prepend(
                    `<input type="hidden" name="_method" value="PUT">`,
                );

                $("#crud_modal").modal("show");
            });
        });
    };

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

KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSide.init();
});
