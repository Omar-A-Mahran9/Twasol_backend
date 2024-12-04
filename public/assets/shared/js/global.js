let removeValidationMessages = function() {
    let errorElements = $('.invalid-feedback');
    errorElements.html('').css('display','none');
    $('form .form-control').removeClass('is-invalid is-valid')
    $('form .form-select').removeClass('is-invalid is-valid')
}

let displayValidationMessages = function(errors ,form = null) {
    form.find('.form-control:not(".controls")').addClass('is-valid')
    form.find('.form-select').addClass('is-valid')
    $.each(errors, (key, errorMessage) => getErrorElement(form,key).html(errorMessage).css('display','block'));
    scrollToFirstErrorElement(errors);
}

function getErrorElement(form,errorKey) {
    let inputId = errorKey.replaceAll('.','_');
    let errorInput   = form.find(`[id='${inputId}_inp']`) ?? form.find(`[id='${inputId}_inp_edit']`);
    let errorElement = form.find(`[id='${inputId}']`);

    if (!errorElement.length){
        let inputName = getFormRepeaterInputName(errorKey);
        errorInput = form.find(`[name='${inputName}']`);
        errorElement = errorInput.siblings('.error-element');
    }
    errorInput.removeClass('is-valid');
    errorInput.addClass('is-invalid');
    /** For select2 **/
    if (errorInput.hasClass('form-select')) {
        let $select2Span = errorInput.siblings('.select2-container').find('.select2-selection');
        $select2Span.removeClass('is-valid');
        $select2Span.addClass('is-invalid');
    }

    return errorElement
}

function getFormRepeaterInputName(errorKey){
    let repeaterInputNameParts = errorKey.split(".");
    let formRepeaterName = repeaterInputNameParts[0];
    let repeaterInputIndex = repeaterInputNameParts[1];
    let repeaterInputName = repeaterInputNameParts[2];

    return `${formRepeaterName}[${repeaterInputIndex}][${repeaterInputName}]`;
}

function scrollToFirstErrorElement(errors) {
    let firstErrorElementId = Object.keys(errors)[0].replaceAll('.', '_');
    let firstErrorElement = document.getElementById(firstErrorElementId);

    if (!firstErrorElement || firstErrorElement == undefined){
        let inputName = getFormRepeaterInputName(Object.keys(errors)[0]);
        firstErrorElement = document.getElementsByName(inputName)[0];
    }

    console.log(firstErrorElement, firstErrorElementId);
    firstErrorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

$.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
});
