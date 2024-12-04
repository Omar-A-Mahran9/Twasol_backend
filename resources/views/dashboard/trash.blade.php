@extends('dashboard.partials.master')
@push('styles')
    <link href="{{ asset('assets/dashboard/css/datatables' . (isDarkMode() ? '.dark' : '') . '.bundle.css') }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ asset('assets/dashboard/plugins/custom/datatables/datatables.bundle' . (isArabic() ? '.rtl' : '') . '.css') }}"
        rel="stylesheet" type="text/css" />
    <style>
        .headerIcons {
            font-size: 1.5rem;
        }

        .activeTab,
        .activeTab i {
            color: #0095E8;
            background-color: #fff !important;
        }

        .trashTab {
            background-color: #F5F8FA;
        }
    </style>
@endpush
@section('content')
    <div class="row justify-content-center">

        <div class="trashTab col-md-3 col-12 card  text-center h2 py-5 mb-0 text-hover-primary activeTab" data-model="Admin"
            style="cursor: pointer">
            <i class="fa fa-user-shield headerIcons"></i>
            <span>{{ __('Admins') }}</span>
        </div>
        <div class="trashTab col-md-3 col-12 card  text-center h2 py-5 mb-0 text-hover-primary" data-model="Vendor"
            style="cursor: pointer">
            <i class="fa fa-users headerIcons"></i>
            <span>{{ __('Vendors') }}</span>
        </div>
        <div class="trashTab col-md-3 col-12 card  text-center h2 py-5 mb-0 text-hover-primary" data-model="Product"
            style="cursor: pointer">
            <i class="fa fa-dolly headerIcons"></i>
            <span>{{ __('Products') }}</span>
        </div>
        <div class="trashTab col-md-3 col-12 card  text-center h2 py-5 mb-0 text-hover-primary" data-model="SubCategory"
            style="cursor: pointer">
            <i class="ki-outline ki-category fs-2"></i>
            <span>{{ __('Subcategory') }}</span>
        </div>

    </div>

    <!-- begin :: Datatable card -->
    <div class="row card mb-2">
        <!-- begin :: Card Body -->
        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">

            <div id="table-container">

                <!-- begin :: Datatable -->
                <table id="kt_datatable" class="table text-center table-row-dashed fs-6 gy-5">

                    <thead>
                        <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0" id="table-header">
                            <th style="text-align: center; width: 413.25px;">#</th>
                            {{-- <th>{{ __("image") }}</th> --}}
                            <th style="text-align: center; width: 413.25px;">{{ __('Name') }}</th>
                            <th style="text-align: center; width: 413.25px;">{{ __('Email') }}</th>
                            <th style="text-align: center; width: 413.25px;" class="min-w-100px">{{ __('Actions') }}</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-600 fw-bold text-center">

                    </tbody>
                </table>
                <!-- end   :: Datatable -->

            </div>
        </div>
        <!-- end   :: Card Body -->
    </div>
    <!-- end   :: Datatable card -->
@endsection
@push('scripts')
    <script>
        let tabs = $('.trashTab');
        let tableHeader = $('thead tr').first();
        let modelName = 'Admin';
        let datatable = null;
        let userAbilites = @json(auth()->user()->abilities());
        let canDelete = userAbilites.includes('delete_recycle_bin');
        let canRestore = userAbilites.includes('restore_recycle_bin');
        let lightboxPath = "{{ asset('assets/dashboard/plugins/custom/fslightbox/fslightbox.bundle.js') }}";

        // start map containts (html) table header columns
        let tableHeaderColumns = new Map();
        tableHeaderColumns.set('Admin', `<th style="text-align: center; width: 413.25px;">#</th>
                     <th style="text-align: center; width: 413.25px;">{{ __('Name') }}</th>
                    <th style="text-align: center; width: 413.25px;">{{ __('Email') }}</th>
                    <th style="text-align: center; width: 413.25px;" class="min-w-100px">{{ __('Actions') }}</th>`);

        tableHeaderColumns.set('Vendor', `<th style="text-align: center; width: 413.25px;">#</th>
                    <th style="text-align: center; width: 413.25px;">{{ __('Name') }}</th>
                    <th style="text-align: center; width: 413.25px;">{{ __('Phone') }}</th>
                    <th style="text-align: center; width: 413.25px;">{{ __('Email') }}</th>
                    <th style="text-align: center; width: 413.25px;">{{ __('Commercial register number') }}</th>
                    <th style="text-align: center; width: 413.25px;">{{ __('National ID') }}</th>
                    <th style="text-align: center; width: 413.25px;" class="min-w-100px">{{ __('Actions') }}</th>`);

        tableHeaderColumns.set('Product', `<th style="text-align: center; width: 413.25px;">#</th>
                    <th style="text-align: center; width: 413.25px;">{{ __('Image') }}</th>
                    <th style="text-align: center; width: 413.25px;">{{ __('Name') }}</th>
                    <th style="text-align: center; width: 413.25px;">{{ __('Vendor name') }}</th>
                    <th style="text-align: center; width: 413.25px;" class="min-w-100px">{{ __('Actions') }}</th>`);

        tableHeaderColumns.set('SubCategory', `<th style="text-align: center; width: 413.25px;">#</th>
                    <th style="text-align: center; width: 413.25px;">{{ __('Image') }}</th>
                    <th style="text-align: center; width: 413.25px;">{{ __('Name') }}</th>
                    <th style="text-align: center; width: 413.25px;">{{ __('Description') }}</th>
                    <th style="text-align: center; width: 413.25px;" class="min-w-100px">{{ __('Actions') }}</th>`);
        // end map containts (html) table header columns

        // start map containts data table columns names
        let dataTableColumns = new Map();
        dataTableColumns.set('Admin', [{
                data: 'id'
            },
            {
                data: 'name'
            },
            {
                data: 'email'
            },
            {
                data: null
            },
        ]);

        dataTableColumns.set('Vendor', [{
                data: 'id'
            },
            {
                data: 'name'
            },
            {
                data: 'phone'
            },
            {
                data: 'email'
            },
            {
                data: 'commercial_register_number'
            },
            {
                data: 'national_id'
            },
            {
                data: null
            },
        ]);

        dataTableColumns.set('Product', [{
                data: 'id'
            },
            {
                data: 'images'
            }, {
                data: 'name'
            },
            {
                data: 'vendor.name',
                name: 'vendor_id'
            },
            {
                data: null
            },
        ]);

        dataTableColumns.set('SubCategory', [{
                data: 'id'
            },
            {
                data: 'images'
            }, {
                data: 'name'
            },
            {
                data: 'description',
            },
            {
                data: null
            },
        ]);

        // end map containts data table columns names

        // start map containts data table columns definitions
        let dataTableColumnsDefs = new Map();
        dataTableColumnsDefs.set('Admin', [{
            targets: 0,
            render: function(data, type, row, meta) {
                return meta.row + 1; // Return row number starting from 1
            }
        }, {
            targets: -1,
            data: null,
            render: function(data, type, row) {


                return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                ${__('Actions')}
                                <span class="svg-icon svg-icon-5 m-0">
                                    <i class="fa fa-angle-down mx-1"></i>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">

                            ${ canRestore ? `<!--begin::Menu item-->
                                                                                                                                                                                                                                                                                                            <div class="menu-item px-3">
                                                                                                                                                                                                                                                                                                                <a href="#" class="menu-link px-3 d-flex justify-content-between restore-row" data-row-id="${row.id}" data-type="${__('admin')}" >
                                                                                                                                                                                                                                                                                                                <span> ${__('Restore')} </span>
                                                                                                                                                                                                                                                                                                                <span>  <i class="fas fa-share text-primary"></i> </span>
                                                                                                                                                                                                                                                                                                                </a>

                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                            <!--end::Menu item-->` : ``
                            }
                            </div>
                            <!--end::Menu-->
                        `;
            },
        }, ]);
        // /dashboard/trash/${modelName}/${ row.id }
        dataTableColumnsDefs.set('Vendor', [{
            targets: 0,
            render: function(data, type, row, meta) {
                return meta.row + 1; // Return row number starting from 1
            }
        }, {
            targets: -1,
            data: null,
            render: function(data, type, row) {

                return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                ${__('Actions')}
                                <span class="svg-icon svg-icon-5 m-0">
                                    <i class="fa fa-angle-down mx-1"></i>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">


                                ${ canRestore ? `<!--begin::Menu item-->
                                                                                                                                                                                                                                                                            <div class="menu-item px-3">
                                                                                                                                                                                                                                                                                <a href="#" class="menu-link px-3 d-flex justify-content-between restore-row" data-row-id="${row.id}" data-type="${__('vendor')}" >
                                                                                                                                                                                                                                                                                <span> ${__('Restore')} </span>
                                                                                                                                                                                                                                                                                <span>  <i class="fas fa-share text-primary"></i> </span>
                                                                                                                                                                                                                                                                                </a>

                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                            <!--end::Menu item-->` : ``
                            }


                            </div>
                            <!--end::Menu-->
                        `;
            },
        }, ]);
        {{--   product  --}}
        dataTableColumnsDefs.set('Product', [{
            targets: 0,
            render: function(data, type, row, meta) {
                return meta.row + 1; // Return row number starting from 1
            }
        }, {
            targets: 1,
            render: function(data, type, row) {
                console.log(data);
                return `<a class="d-block overlay" style="height:47px;" data-fslightbox="lightbox-basic" href="${data[0]?.full_image_path}">
                                     <!--begin::Image-->
                                     <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded"
                                          style="height:56px;width:100px;border-radius:4px;margin:auto;background-image:url('${data[0]?.full_image_path}');background-size:contain;">
                                     </div>
                                     <!--end::Image-->

                                     <!--begin::Action-->
                                     <div style="width:47px;margin: auto;" class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                         <i class="bi bi-eye-fill text-white fs-3x"></i>
                                     </div>
                                     <!--end::Action-->
                                 </a>`;

            }
        }, {
            targets: 3,
            render: function(data, type, row) {
                return `
                    <div>
                        <!--begin::Info-->
                        <div class="d-flex flex-column justify-content-center">
                            <span class="mb-1 text-gray-800">${data? data: 'ــ'}</span>
                        </div>
                        <!--end::Info-->
                    </div>
                `;
            }
        }, {
            targets: -1,
            data: null,
            render: function(data, type, row) {

                return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                ${__('Actions')}
                                <span class="svg-icon svg-icon-5 m-0">
                                    <i class="fa fa-angle-down mx-1"></i>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">


                                ${ canRestore ? `<!--begin::Menu item-->
                                                                                                                                                                                                                                                                            <div class="menu-item px-3">
                                                                                                                                                                                                                                                                                <a href="#" class="menu-link px-3 d-flex justify-content-between restore-row" data-row-id="${row.id}" data-type="${__('product')}" >
                                                                                                                                                                                                                                                                                <span> ${__('Restore')} </span>
                                                                                                                                                                                                                                                                                <span>  <i class="fas fa-share text-primary"></i> </span>
                                                                                                                                                                                                                                                                                </a>

                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                            <!--end::Menu item-->` : ``
                            }


                            </div>
                            <!--end::Menu-->
                        `;
            },
        }, ]);

        dataTableColumnsDefs.set('SubCategory', [{
                targets: 0,
                render: function(data, type, row, meta) {
                    return meta.row + 1; // Return row number starting from 1
                }
            },
            {
                targets: 1,
                render: function(data, type, row) {
                    return `<a class="d-block overlay" style="height:47px;" data-fslightbox="lightbox-basic" href="${row.full_image_path}">
                                     <!--begin::Image-->
                                     <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded"
                                          style="height:56px;width:100px;border-radius:4px;margin:auto;background-image:url('${row.full_image_path}');background-size:contain;">
                                     </div>
                                     <!--end::Image-->

                                     <!--begin::Action-->
                                     <div style="width:47px;margin: auto;" class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                         <i class="bi bi-eye-fill text-white fs-3x"></i>
                                     </div>
                                     <!--end::Action-->
                                 </a>`;

                }
            },
            {
                targets: -1,
                data: null,
                render: function(data, type, row) {

                    return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                ${__('Actions')}
                                <span class="svg-icon svg-icon-5 m-0">
                                    <i class="fa fa-angle-down mx-1"></i>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">


                                ${ canRestore ? `<!--begin::Menu item-->
                                                                                                                                                                                                                                                                            <div class="menu-item px-3">
                                                                                                                                                                                                                                                                                <a href="#" class="menu-link px-3 d-flex justify-content-between restore-row" data-row-id="${row.id}" data-type="${__('product')}" >
                                                                                                                                                                                                                                                                                <span> ${__('Restore')} </span>
                                                                                                                                                                                                                                                                                <span>  <i class="fas fa-share text-primary"></i> </span>
                                                                                                                                                                                                                                                                                </a>

                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                            <!--end::Menu item-->` : ``
                            }


                            </div>
                            <!--end::Menu-->
                        `;
                },
            },
        ]);
        // end map containts data table columns definitions

        tabs.click(function() {

            tabs.removeClass('activeTab');
            $(this).addClass('activeTab');

            modelName = $(this).data('model');
            $('#table-container').html(`
                <table id="kt_datatable" class="table text-center table-row-dashed fs-6 gy-5">

                <thead>
                    <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0" id='table-header' >
                    ${ tableHeaderColumns.get(modelName) }
                    </tr>
                </thead>

                <tbody class="text-gray-600 fw-bold text-center">

                </tbody>
                </table>`);


            KTDatatable.init();

        })
    </script>
    <script src="{{ asset('assets/dashboard/js/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/datatables/trash.js') }}"></script>
@endpush
