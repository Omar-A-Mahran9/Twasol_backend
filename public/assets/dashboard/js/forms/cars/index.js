$(document).ready(function () {
    retrieveCarsFormBackend();

    pageTransition();
});

function retrieveCarsFormBackend() {
    let form = document.getElementById("filter-form");
    let isAdvancedSearch = $("#kt_advanced_search_form").hasClass("show");

    showLoading();
    $.ajax({
        type: "get",
        url: "/dashboard/cars",
        data: $(form).serialize(),
        success: function (response) {
            hideLoading();
            console.log(response);
            carsItems(response);
        },
        error: function (response) {
            hideLoading();
            console.log(response);
        },
    });
}

var carsItems = function (response) {
    var cars = response.cars.data || {};
    var productCards = "";

    productCards = `
        <!--begin::Col-->
        <div class="col-md-6 col-xxl-4">
            <!--begin::Card-->
            <div class="card" style="height: 100%;">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-center flex-column">
                    <!--begin::Button-->
                    <a href="/dashboard/cars/create" class="btn btn-clear d-flex flex-column flex-center">
                        <!--begin::Illustration-->
                        <img src="/assets/vendor-dashboard/media/illustrations/sketchy-1/13.png" alt=""
                            class="mw-100 mh-175px">
                        <!--end::Illustration-->
                        <!--begin::Label-->
                        <div class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">
                            <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-11-29-094551/core/html/src/media/icons/duotune/general/gen041.svg-->
                            <span class="svg-icon svg-icon-muted svg-icon-2x"><svg width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                    <rect x="10.8891" y="17.8033" width="12" height="2" rx="1"
                                        transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                                    <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            ${__("Create new car")}
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

    if (Object.keys(cars).length > 0) {
        $("#no-results-alert").hide();
        $.each(cars, function (index, car) {
            productCards += `
            <div class="col-md-6 col-xl-4" id="card-${car.id}">
                <!--begin::Card-->
                <div class="card border-hover-primary" style="height: 100%;">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-9">
                        <!--begin::Card Title-->
                        <div class="card-title m-0">
                            <!--begin::Avatar-->
                            <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                                <div class="rounded overflow-hidden me-3 w-100px h-100px w-lg-150px h-lg-150px">
                                    <div class="fs-2 fw-semibold text-success"><img src="${
                                        car?.full_image_path[0]
                                    }"  class="img-fluid"></div>
                                    </div>
                            </div>
                            <!--end::Avatar-->
                             <div class="col-md-6 col-xl-5">
                                <a href="/dashboard/cars/${
                                    car.id
                                }" class="text-gray-900 text-hover-primary fs-2 fw-bold">${
                car.name
            }</a>
                             </div>
                            <!--begin::Card toolbar-->
                             <div class="col-md-6 col-xl-1">
                            <div class="card-toolbar">
                                <div class="me-0">
                                    <button type="button"
                                        class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary dropdown-btn me-n3"
                                        data-kt-menu-trigger="hover" data-kt-menu-placement="bottom-end">
                                        <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2022-12-26-231111/core/html/src/media/icons/duotune/coding/cod001.svg-->
                                        <span class="svg-icon svg-icon-3 svg-icon-primary" style="color: #DEB893"><svg width="24" height="24"
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
                                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">${__(
                                                "Actions"
                                            )}</div>
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Menu item-->
                                       
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="/dashboard/cars/${
                                                car.id
                                            }/edit"
                                                class="menu-link flex-stack px-3">${__(
                                                    "Edit"
                                                )}
                                                <i class="fonticon-content-marketing fs-6"></i></a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link flex-stack px-3 delete-item" data-id="${
                                                car.id
                                            }">${__("Delete")}
                                                <i class="fonticon-trash-bin fs-3"></i></a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu 3-->
                                </div>
                            </div>
                            </div>
                        <!--end::Card toolbar-->
                        </div>
                        <!--end::Car Title-->

                    </div>
                    <!--end:: Card header-->
                    <!--begin:: Card body-->
                    <div class="card-body p-9 pt-4"style="display: flex;flex-direction: column;justify-content: flex-end;">

                        <!--begin::Info-->
                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-6 gap-5 ">
                            <a href="javascript:;" class="d-flex align-items-center text-gray-400 me-5 mb-2 cursor-default disabled">
                                <i class="fa fa-dollar fs-4 me-1"></i>

                               ${__("" + car.price)}  ${__("SAR")}
                            </a>

                                <a href="javascript:;" class="d-flex align-items-center text-gray-400 me-5 mb-2 cursor-default disabled">
                                <i class="fa fa-bag-shopping fs-4 me-1"></i>

                               ${__("" + car.bags_counts)} 
                            </a>
                                <a href="javascript:;" class="d-flex align-items-center text-gray-400 me-5 mb-2 cursor-default disabled">

                                     <i class="fa fa-person fs-4 me-1"></i>

                               ${__("" + car.passengers_counts)}  
                            </a>
                        </div>
                        <div class="d-flex flex-wrap">
                            <!--begin::Due-->
                            <div class="border border-gray-300 border-dashed rounded py-2 px-4 me-2 mb-3">
                                <div class="fs-6 text-gray-800 fw-bold">${
                                    car.created_at
                                }</div>
                                <div class="fw-semibold text-gray-400">${__(
                                    "Created at"
                                )}</div>
                            </div>
                 
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end:: Card body-->
                </div>
                <!--end::Card-->
            </div>
            `;
        });
    } else {
        if (response.total > 0) {
            // check if database contains products
            productCards = ``;
            $("#no-results-alert").fadeIn();
        }
    }

    $(".cars-container").html(productCards);
    deleteCar();
    paginator(response);
    KTMenu.createInstances();
    window.cars = cars;
};

var paginator = function (response) {
    var links = "";
    var paginationContent = "";
    var cars = response.cars.data || [];
    var paginationData = response.cars;
    var prevUrl = paginationData.prev_page_url || "javascript:;";
    var nextUrl = paginationData.next_page_url || "javascript:;";

    if (cars.length != 0) {
        for (var i = 1; i <= paginationData.last_page; i++) {
            var isCurrentPage = paginationData.current_page == i;
            var activeClass = isCurrentPage ? "active" : "";

            if (paginationData.links[i] !== undefined) {
                links += `
                <li class="page-item ${activeClass}">
                    <a href="${
                        isCurrentPage ? "#" : paginationData.links[i].url
                    }" class="page-link">${i}</a>
                </li>
                `;
            }
        }
        paginationContent = `
        <div class="spinner-border spinner-border-sm my-auto d-none" id="pagination-loading" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <li class="page-item previous ${
            prevUrl == "javascript:;" ? "disabled" : ""
        }">
            <a href="${prevUrl}" class="page-link">
                <i class="previous"></i>
            </a>
        </li>
        ${links}
        <li class="page-item next ${
            nextUrl == "javascript:;" ? "disabled" : ""
        }">
            <a href="${nextUrl}" class="page-link">
                <i class="next"></i>
            </a>
        </li>
        `;

        $(".pagination-info").text(
            __(`Show 1 to`) +
                ` ${paginationData.per_page} ` +
                __(`from total`) +
                ` ${paginationData.total} `
        );

        $("#pagination-container").show();
    } else {
        $("#pagination-container").hide();
    }

    $(".pagination").html(paginationContent);
};

var pageTransition = function () {
    $(document).on("click", ".page-link", function (e) {
        e.preventDefault();

        var url = $(this).attr("href");

        if (url != "#") {
            $("#pagination-loading").removeClass("d-none");

            $.get(url, $("#filterForm").serialize(), function (response) {
                $("#pagination-loading").addClass("d-none");
                carsItems(response);
            });
        }
    });
};

function showLoading() {
    $("#cars-container").html("");
    $("#loading-alert").removeClass("d-none");
}
function hideLoading() {
    $("#loading-alert").addClass("d-none");
}

function deleteCar(params) {
    $(".delete-item").on("click", function (e) {
        e.preventDefault();

        let id = $(this).attr("data-id");
        deleteElement("", `/dashboard/cars/${id}`, () =>
            retrieveCarsFormBackend()
        );
    });
}

function handlePreviewClick(imagePath) {
    // Clear the current attachments preview
    $(".attachments").html("");

    // Append the new attachment to be previewed
    $(".attachments").append(`
        <!--begin::Overlay-->
        <a class="d-block overlay" data-fslightbox="lightbox-basic" href="${imagePath}">
            <!--begin::Action-->
            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                <i class="bi bi-eye-fill text-white fs-3x"></i>
            </div>
            <!--end::Action-->
        </a>
        <!--end::Overlay-->
    `);

    // Refresh lightbox instance to ensure the new content is recognized
    refreshFsLightbox();

    // Automatically trigger the first attachment preview (lightbox)
    $("[data-fslightbox='lightbox-basic']:first").trigger("click");
}
