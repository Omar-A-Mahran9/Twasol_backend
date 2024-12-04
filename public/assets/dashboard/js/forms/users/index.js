$(document).ready(function () {
    retrieveusersFormBackend();

    $("#filter-form").submit(function (e) {
        e.preventDefault();
        retrieveusersFormBackend();
    });

    $("input[name='name']").keyup(function (e) {
        retrieveusersFormBackend();
    });

    pageTransition();
});
var users = null;

function retrieveusersFormBackend() {
    let form = document.getElementById('filter-form');
    let isAdvancedSearch = $("#kt_advanced_search_form").hasClass("show");

    $("input[name='advanced_search']").val(isAdvancedSearch);
    showLoading();
    $.ajax({
        type: "get",
        url: "/dashboard/users",
        data: $(form).serialize(),
        success: function (response) {
            hideLoading();
            userItems(response);
        },
        error: function(response){
            hideLoading();
            console.log(response);
        }
    });
}

var userItems = function (response) {
    users = response.users.data || {};

    userCards = `
        <!--begin::Col-->
        <div class="col-md-6 col-xxl-4">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-center flex-column">
                    <!--begin::Button-->
                    <a href="#" onclick="addNew()" data-bs-toggle="modal" data-bs-target="#crud_modal" data-kt-docs-table-toolbar="base" class="btn btn-clear d-flex flex-column flex-center">
                        <!--begin::Illustration-->
                        <img src="/assets/dashboard/media/illustrations/sketchy-1/add-user.png" alt=""
                            class="mw-100 mh-175px">
                        <!--end::Illustration-->
                        <!--begin::Label-->
                        <div class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">
                            <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-11-29-094551/core/html/src/media/icons/duotune/general/gen041.svg-->
                            <img class="w-50" src="/assets/web/images/User/gamer.svg" >
                            <!--end::Svg Icon-->
                            ${ __('تسجيل عميل جديد') }
                        </div>
                        <!--end::Label-->
                    </a>
                    <!--begin::Button-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Col-->
        `;


    if (Object.keys(users).length > 0) {
        $("#no-results-alert").hide();
        $.each(users, function (index, user) {
            let userNameToArray =  user.name.split(" ");
            let firstName = userNameToArray[0].charAt(0);
            let lastName = userNameToArray.length > 1 ?userNameToArray[userNameToArray.length - 1].charAt(0):'';
            userCards += `
            <div class="col-md-6 col-xl-4" id="card-${user.id}">
                <!--begin::Card-->
                <div class="card border-hover-primary">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-9">
                        <!--begin::Card Title-->
                        <div class="card-title m-0">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-50px">
                                <div id="profileImage" style="background:${getRandomColorCode()}">${firstName+lastName} </div>
                            </div>
                            <!--end::Avatar-->
                            <a href="/dashboard/users/${user.id}" class="text-gray-900 text-hover-primary fs-2 fw-bold ms-3">${user.name}</a>
                        </div>
                        <!--end::Car Title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <div class="me-0">
                                <button type="button"
                                    class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary dropdown-btn me-n3"
                                    data-kt-menu-trigger="hover" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-12-26-231111/core/html/src/media/icons/duotune/coding/cod001.svg-->
                                    <span class="svg-icon svg-icon-3 svg-icon-primary"><svg width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3"
                                                d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z"
                                                fill="currentColor" />
                                            <path
                                                d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--begin::Menu 3-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                    data-kt-menu="true">
                                    <!--begin::Heading-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">${ __('الإجراءات') }</div>
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="/dashboard/users/${user.id}"
                                            class="menu-link flex-stack px-3">${ __('بيانات العميل') }
                                            <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-12-26-231111/core/html/src/media/icons/duotune/general/gen045.svg-->
                                            <span class="svg-icon svg-icon-muted svg-icon-2">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10"
                                                        fill="currentColor" />
                                                    <rect x="11" y="17" width="7" height="2" rx="1" transform="rotate(-90 11 17)"
                                                        fill="currentColor" />
                                                    <rect x="11" y="9" width="2" height="2" rx="1" transform="rotate(-90 11 9)"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" onclick="editUser(${user.id})"
                                            class="menu-link flex-stack px-3">${ __('تعديل') }
                                            <i class="fonticon-content-marketing fs-6"></i></a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link flex-stack px-3" onclick="deleteUser(${user.id})">${ __('حذف') }
                                            <i class="fonticon-trash-bin fs-3"></i></a>
                                    </div>
                                    <!--end::Menu item-->
                                    ${user.active ? `<div class="menu-item px-3">
                                                        <a href="#" class="menu-link flex-stack px-3" onclick="blockUser(${user.id})">${ __('حظر') }
                                                            <i class="fonticon-trash-bin fs-3"></i>
                                                        </a>
                                                    </div>`
                                                    :
                                                    `<div class="menu-item px-3">
                                                        <a href="#" class="menu-link flex-stack px-3" onclick="activateUser(${user.id})">${ __('الغاء الحظر') }
                                                        <i class="fonticon-trash-bin fs-3"></i></a>
                                                    </div>`
                                    }

                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu 3-->
                            </div>
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end:: Card header-->
                    <!--begin:: Card body-->
                    <div class="card-body p-9 pt-4">
                        <div class="d-flex flex-column">
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                <a href="javascript:;" class="d-flex align-items-center text-gray-400 me-5 mb-2 cursor-default disabled">
                                    <i class="fa-solid fa-ranking-star fa-lg"> </i>

                                    <!--end::Svg Icon-->${ user.rank? user.rank.name: __('لم يحدد بعد') }
                                </a>
                                <a href="tel:${ user.phone }"
                                    class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    <!--begin:: Icon | path: icons/duotune/general/gen018.svg-->
                                    <i class="fonticon-outgoing-call me-1"></i>
                                    <!--end:: Icon-->${ user.phone }
                                </a>
                                <a href="mailto: ${ user.email }"
                                    class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3"
                                                d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                fill="currentColor" />
                                            <path
                                                d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->${ user.email }
                                </a>
                            </div>
                            <!--end::Info-->
                        </div>

                        <!--begin::Info-->
                        <div class="d-flex flex-wrap">
                            <!--begin::Due-->
                            <div class="border border-gray-300 border-dashed rounded py-2 px-4 me-2 mb-3">
                                <div class="fs-6 text-gray-800 fw-bold">${ user.created_at }</div>
                                <div class="fw-semibold text-gray-400">${ __('تاريخ الاشتراك') }</div>
                            </div>
                            <!--end::Due-->
                            <!--begin::Budget-->
                            <div class="border border-gray-300 border-dashed rounded py-2 me-2 px-4 mb-3">
                                <div class="fs-6 text-gray-800 fw-bold">${  user.wallet_balance + ' ' + __('دولار') }</div>
                                <div class="fw-semibold text-gray-400">${ __('رصيد المحفظة') }</div>
                            </div>
                            <!--end::Budget-->
                            <!--begin::Budget-->
                            <div class="border border-gray-300 border-dashed rounded py-2 px-4 mb-3">
                                <div class="fs-6 text-gray-800 fw-bold">${ user.orders.length + ' ' + __('الطلبات')}</div>
                                <div class="fw-semibold text-gray-400">${ __('عدد الطلبات') }</div>
                            </div>
                            <!--end::Budget-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end:: Card body-->
                </div>
                <!--end::Card-->
            </div>
            `
        });


    }else{


        if(response.total > 0){ // check if database contains users
            userCards = ``;
            $("#no-results-alert").fadeIn();
        }
    }

    $(".users-container").html(userCards);
    deleteuser();
    paginator(response);
    KTMenu.createInstances();

}

var paginator = function (response) {
    var links = '';
    var paginationContent = '';
    var users = response.users.data || [];
    var paginationData = response.users;
    var prevUrl = paginationData.prev_page_url || 'javascript:;';
    var nextUrl = paginationData.next_page_url || 'javascript:;';

    if (users.length != 0) {
        for (var i = 1; i <= paginationData.last_page ; i++) {
            var isCurrentPage = paginationData.current_page == i;
            var activeClass = isCurrentPage ? 'active' : '';

            if(paginationData.links[i] !== undefined){
                links += `
                <li class="page-item ${activeClass}">
                    <a href="${isCurrentPage? '#': paginationData.links[i].url}" class="page-link">${i}</a>
                </li>
                `;
            }
        }
        paginationContent = `
        <div class="spinner-border spinner-border-sm my-auto d-none" id="pagination-loading" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <li class="page-item previous ${prevUrl == 'javascript:;'? 'disabled': ''}">
            <a href="${prevUrl}" class="page-link">
                <i class="previous"></i>
            </a>
        </li>
        ${links}
        <li class="page-item next ${nextUrl == 'javascript:;'? 'disabled': ''}">
            <a href="${nextUrl}" class="page-link">
                <i class="next"></i>
            </a>
        </li>
        `;

        $(".pagination-info").text(`عرض 1 إلى ${paginationData.per_page} من إجمالي ${paginationData.total}`);

        $("#pagination-container").show();
    } else {
        $("#pagination-container").hide();
    }

    $(".pagination").html(paginationContent);

}

var pageTransition = function () {
    $(document).on('click', '.page-link', function (e) {
        e.preventDefault();

        var url = $(this).attr('href');

        if (url != '#') {
            $("#pagination-loading").removeClass('d-none')

            $.get(url, $("#filterForm").serialize(), function (response) {

                $("#pagination-loading").addClass('d-none')
                userItems(response);
            });

        }
    });
}

function showLoading(){
    $('#users-container').html('');
    $('#loading-alert').removeClass('d-none');
}
function hideLoading(){
    $('#loading-alert').addClass('d-none');
}

function deleteuser(params) {
    $('.delete-item').on('click', function (e) {
        e.preventDefault();

        let id = $(this).attr('data-id');
        deleteElement('' , `/dashboard/users/${id}` , () => retrieveusersFormBackend())
    });
}

function editUser(id){
    let user = users.find(user => user.id === id);
    console.log(user);
    $("#form_title").text(__('تعديل بيانات الفئة'));
    // $("#name_en_inp").val(data.name_en);
    // $("#name_ar_inp").val(data.name_ar);
    $('#name_inp').val(user.name??'')
    $('#email_inp').val(user.email??'')
    $('#phone_inp').val(user.phone??'')
    $(`#rank_id_inp`).val(user.rank_id).attr('selected',true)

    $(`#rank_id_inp`).trigger('change');
    $('#affiliate_discount_inp').val(user.affiliate_discount??'')

    $("#crud_form").attr('action', `/dashboard/users/${user.id}`);
    $("#crud_form").prepend(`<input type="hidden" name="_method" value="PUT">`);
    $("[for*='password']").removeClass('required');
    $("#crud_modal").modal('show');
}

function addNew(){

    $("#form_title").text(__('اضافة عميل جديد'));
    $("[name='_method']").remove();
    $("#crud_form").trigger('reset');
    $("#crud_form").attr('action', `/dashboard/users`);
}

function deleteUser(id){
    deleteAlert(`${__('هل انت متاكد من حذف  ')} ${__('عناصر سيتم حذف البيانات المرتبطة بهم')}`).then(function (result) {
        if (result.value){
            loadingAlert(__("جار الحذف..."))
            $.ajax({
                type: "delete",
                url: `/dashboard/users/${id}`,
                success: function () {
                    showToast(__("تم حذف العنصر بنجاح"));
                    retrieveusersFormBackend();
                },
                error: function (err) {
                    if (err.hasOwnProperty('responseJSON')) {
                        if (err.responseJSON.hasOwnProperty('message')) {
                            errorAlert(err.responseJSON.message)
                        }
                    }
                    console.log(err);
                }
            });

        }
    });
}

function blockUser(id){
    blockAlert(`${__('هل انت متاكد من حظر  ')} ${__('المستخدم سيتم حذف البيانات المرتبطة به')}`).then(function (result) {
        if (result.value){
            loadingAlert(__("جار الحظر..."))
            $.ajax({
                type: "get",
                url: `/dashboard/users/${id}/block`,
                success: function () {
                    showToast(__("تم حظر المستخدم بنجاح"));
                    retrieveusersFormBackend();
                },
                error: function (err) {
                    if (err.hasOwnProperty('responseJSON')) {
                        if (err.responseJSON.hasOwnProperty('message')) {
                            errorAlert(err.responseJSON.message)
                        }
                    }
                    console.log(err);
                }
            });

        }
    });
}

function activateUser(id){
    activateAlert(`${__('هل انت متاكد من الغاء حظر هذا المستخدم')}`).then(function (result) {
        if (result.value){
            loadingAlert(__("جار الغاء الحظر..."))
            $.ajax({
                type: "get",
                url: `/dashboard/users/${id}/activate`,
                success: function () {
                    showToast(__("تم الغاء حظر المستخدم بنجاح"));
                    retrieveusersFormBackend();
                },
                error: function (err) {
                    if (err.hasOwnProperty('responseJSON')) {
                        if (err.responseJSON.hasOwnProperty('message')) {
                            errorAlert(err.responseJSON.message)
                        }
                    }
                    console.log(err);
                }
            });

        }
    });
}

