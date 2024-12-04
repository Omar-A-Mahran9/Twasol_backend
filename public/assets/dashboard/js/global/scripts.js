UIBlocker = new KTBlockUI(document.querySelector(".modal-content"));

/** click on ... to show the text in DataTables **/

let showMoreInDT = function (element) {
    console.log(12);
    $(element).next().hide();
    $(element).next().next().show();
};

let getStatusObject = function (statusNameEn) {
    return (
        ordersStatuses.find((status) => status["name_en"] === statusNameEn) ?? {
            name_ar: statusNameEn,
            name_en: statusNameEn,
            color: "#219ed4",
        }
    );
};

let showHidePass = function (fieldId, showPwIcon) {
    let passField = $("#" + fieldId);

    if (passField.attr("type") === "password") {
        passField.attr("type", "text");
        showPwIcon
            .children()
            .eq(0)
            .removeClass("fa-eye")
            .addClass("fa-eye-slash");
    } else {
        passField.attr("type", "password");
        showPwIcon
            .children()
            .eq(0)
            .removeClass("fa-eye-slash")
            .addClass("fa-eye");
    }
};

let blockUi = function (id) {
    /** block container ui **/
    KTApp.block(id, {
        overlayColor: "#000000",
        state: "danger",
        message: __("Please wait..."),
    });
};

let unBlockUi = function (id, timer = 0) {
    /** unblock container ui **/
    setTimeout(function () {
        KTApp.unblock(id);
    }, timer);
};

/** Begin :: System Alerts  **/

let deleteAlert = function (message = "") {
    if (message == "")
        message = `${
            __("Are you sure you want to delete this") +
            " " +
            __("item") +
            " " +
            __("?") +
            " " +
            __("All data related to this") +
            " " +
            __("item") +
            " " +
            __("will be deleted")
        }`;
    return Swal.fire({
        text: message,
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: __("Yes, Delete !"),
        cancelButtonText: __("No, Cancel"),
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary",
        },
    });
};

let blockAlert = function (message = "") {
    if (message == "")
        message = `${
            __("Are you sure you want to block this") +
            " " +
            __("user") +
            " " +
            __("?") +
            " " +
            __("All data related to this") +
            " " +
            __("user") +
            " " +
            __("will be blocked")
        }`;
    return Swal.fire({
        text: message,
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: __("Yes, Block !"),
        cancelButtonText: __("No, Cancel"),
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary",
        },
    });
};

let activateAlert = function (message = "") {
    if (message == "")
        message = `${
            __("هل أنت متأكد من الغاء حظر هذا") +
            " " +
            __("المستخدم") +
            " " +
            __("؟")
        }`;
    return Swal.fire({
        text: message,
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: __("نعــم, ألغي الحظر !"),
        cancelButtonText: __("لا , ألغي"),
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary",
        },
    });
};

let confirmationAlert = function (
    message = __("Are You sure for doing this action ?"),
    icon = "warning",
    confirmBtnText = __("Yes, Sure !"),
    cancelButtonText = __("No, Cancel")
) {
    return Swal.fire({
        text: message,
        icon: icon,
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: confirmBtnText,
        cancelButtonText: cancelButtonText,
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary",
        },
    });
};

let errorAlert = function (message = __("something went wrong"), time = 5000) {
    return Swal.fire({
        text: __(message),
        icon: "error",
        buttonsStyling: false,
        showConfirmButton: false,
        timer: time,
        customClass: {
            confirmButton: "btn fw-bold btn-primary",
        },
    });
};

let successAlert = function (
    message = __("Operation done successfully"),
    timer = 1000
) {
    return Swal.fire({
        text: message,
        icon: "success",
        buttonsStyling: false,
        showConfirmButton: false,
        timer: timer,
    });
};

let restoreAlert = function () {
    return Swal.fire({
        text: __("Deleted successfully"),
        icon: "success",
        buttonsStyling: false,
        showCancelButton: true,
        confirmButtonText: __("Restore"),
        cancelButtonText: __("Ok"),
        customClass: {
            confirmButton: "btn fw-bold btn-warning",
            cancelButton: "btn fw-bold btn-primary",
        },
    });
};

let inputAlert = function () {
    return Swal.fire({
        icon: "warning",
        title: __("اكتب تعليق"),
        html: '<input id="swal-input1" class="form-control">',
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonColor: "#1E1E2D",
        cancelButtonColor: "#c61919",
        confirmButtonText: `<span> ${__("تغيير")} </span>`,
        cancelButtonText: `<span> ${__("الغاء")} </span>`,
        preConfirm: () => {
            return [document.getElementById("swal-input1").value];
        },
    });
};

let changeStatusAlert = function (type = "change") {
    if (type == "date") {
        return Swal.fire({
            icon: "warning",
            title: __("Pick new date"),
            html: '<input type="date" required id="swal-input1" class="form-control">',
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonColor: "#1E1E2D",
            cancelButtonColor: "#c61919",
            confirmButtonText: `<span> ${__("change")} </span>`,
            cancelButtonText: `<span> ${__("cancel")} </span>`,
            preConfirm: () => {
                return [document.getElementById("swal-input1").value];
            },
        });
    }

    return Swal.fire({
        icon: "warning",
        title: __("change order status"),
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonColor: "#1E1E2D",
        cancelButtonColor: "#c61919",
        confirmButtonText: `<span> ${__("change")} </span>`,
        cancelButtonText: `<span> ${__("cancel")} </span>`,
    });
};

let warningAlert = function (title, message, time = 5000) {
    return swal.fire({
        title: __(title),
        text: __(message),
        icon: "warning",
        showConfirmButton: false,
        timer: time,
    });
};

let unauthorizedAlert = function () {
    return swal.fire({
        title: __("Error !"),
        text: __("This action is unauthorized."),
        icon: "error",
        showConfirmButton: false,
        timer: 5000,
    });
};

let loadingAlert = function (message = __("Loading...")) {
    return Swal.fire({
        text: message,
        icon: "info",
        buttonsStyling: false,
        showConfirmButton: false,
        timer: 2000,
    });
};

let getImagePathFromDirectory = function (
    imageName,
    directory,
    defaultImage = "default.jpg"
) {
    let path = `/storage/Images/${directory}/${imageName}`;

    if (imageName && directory && isFileExists(path)) return path;
};

function isFileExists(urlToFile) {
    var xhr = new XMLHttpRequest();
    xhr.open("HEAD", urlToFile, false);
    xhr.send();

    if (xhr.status == "404") {
        return false;
    } else {
        return true;
    }
}

/** End :: System Alerts  **/

let initTinyMc = function (editingInp = false, height = 400) {
    tinymce.init({
        height,
        selector: ".tinymce",
        menubar: false,
        toolbar: [
            "styleselect",
            "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify forecolor backcolor",
            "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code",
        ],
        plugins: "advlist autolink link lists charmap print preview code save",
        save_onsavecallback: function () {},
    });

    if (!editingInp) $(".tinymce").val(null);
};

let deleteElement = (deletedElementName, deletionUrl, callback) => {
    deleteAlert().then(function (result) {
        if (result.value) {
            loadingAlert(__("deleting now ..."));

            $.ajax({
                method: "delete",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: deletionUrl,
                success: (response) => {
                    setTimeout(() => {
                        successAlert(
                            `${
                                __("You have deleted the") +
                                " " +
                                deletedElementName +
                                " " +
                                __("successfully !")
                            } `
                        ).then(function () {
                            if (typeof callback === "function") {
                                callback(response);
                            }
                        });
                    }, 1000);
                },
                error: (err) => {
                    if (err.hasOwnProperty("responseJSON")) {
                        if (err.responseJSON.hasOwnProperty("message")) {
                            errorAlert(err.responseJSON.message);
                        }
                    }
                },
            });
        } else if (result.dismiss === "cancel") {
            errorAlert(__("was not deleted !"));
        }
    });
};

function ajaxSubmission({ form, successCallback, errorCallback, complete }) {
    let formData = new FormData(form);
    form = $(form);
    let submitBtn = $(form).find("[type=submit]");
    submitBtn.attr("disabled", true);

    $.ajax({
        method: form.attr("method"),
        url: form.attr("action"),
        data: formData,
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        cache: false,
        success: successCallback,
        error: errorCallback,
        complete: complete,
    });
}

/** Start :: save tiny mce  **/
let saveTinyMceDataIntoTextArea = () => {
    if ($('textarea[class="tinymce"]').length) tinymce.triggerSave();
};
/** Start :: save tiny mce  **/

function onImgError(
    image,
    placeholder = "/assets/dashboard/media/placeholders/default.png"
) {
    image.src = placeholder;
}

/** Start :: Submit any form in dashboard function  **/
let submitForm = (form) => {
    let submitBtn = $(form).find("[type=submit]");

    submitBtn.attr("disabled", true).attr("data-kt-indicator", "on");

    saveTinyMceDataIntoTextArea();

    ajaxSubmission({
        form: form,
        successCallback: function (response) {
            form = $(form);
            removeValidationMessages();

            if (form.data("success-callback") !== undefined) {
                window[form.data("success-callback")](response);
                showToast();
            } else {
                if (
                    form.data("redirection-url") &&
                    form.data("redirection-url") !== "#"
                ) {
                    showToast();
                    window.location.replace(form.data("redirection-url"));
                } else {
                    showToast();
                }
            }
        },
        errorCallback: function (response) {
            form = $(form);

            removeValidationMessages();

            if (response.status === 422)
                displayValidationMessages(response.responseJSON.errors, form);
            else if (response.status === 403) unauthorizedAlert();
            else if (response.status === 419) window.location.reload();
            else errorAlert(response.responseJSON.message, 5000);

            if (form.data("error-callback") !== undefined)
                window[form.data("error-callback")](response.status, response);
        },
        complete: function () {
            submitBtn.attr("disabled", false).removeAttr("data-kt-indicator");
        },
    });
};
/** End   :: Submit any form in dashboard function  **/

let showToast = function (message = null) {
    const toastElement = document.getElementById("kt_docs_toast_toggle");
    const toast = bootstrap.Toast.getOrCreateInstance(toastElement);
    if (message) $(".toast-body").text(message);
    toast.show();

    playSuccessSound();
};

function playNotificationSound() {
    if (notificationSoundOn) playSound($("#notification-sound"));
}

function playSuccessSound() {
    playSound($("#success-sound"));
}

function playErrorSound() {
    playSound($("#error-sound"));
}

function playSound(soundElement) {
    if (soundStatus != "stop") {
        try {
            soundElement.trigger("play");
        } catch (error) {
            console.log(error);
        }
    }
}

var reinitializeTooltip = () => {
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    const tooltipList = [...tooltipTriggerList].map(
        (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
    );
};

var hideValidationMessagesOnModalShow = () => {
    $("#crud_modal").on("hidden.bs.modal", function (e) {
        removeValidationMessages();
    });
};

$(document).ready(function () {
    hideValidationMessagesOnModalShow();

    /** Start :: ajax request form  **/
    $(".ajax-form").submit(function (event) {
        event.preventDefault();

        submitForm(this);
    });
    /** End   :: ajax request form  **/

    $(".datepicker").flatpickr({
        dateFormat: "Y-m-d",
        locale: locale,
    });

    $(".timepicker").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        locale: locale,
    });
});
function getRandomColorCode() {
    // Generate random values for red, green, and blue
    const red = Math.floor(Math.random() * 256);
    const green = Math.floor(Math.random() * 256);
    const blue = Math.floor(Math.random() * 256);

    // Create the color code using RGB values
    const colorCode = `rgb(${red}, ${green}, ${blue})`;

    return colorCode;
}

$(".multiselectsplitter").multiselectsplitter();
