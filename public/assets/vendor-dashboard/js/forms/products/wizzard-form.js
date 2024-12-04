"use strict";

// Class definition
var KTCreateAccount = function () {
	// Elements
	var modal;
	var modalEl;

	var stepper;
	var form;
	var formSubmitButton;
	var formContinueButton;
	var formPreviousButton;
    var UIBlocker;
    var stepIsValid;
    const LAST_STEP = 3;

	// Variables
	var stepperObj;

	// Private Functions
	var initStepper = function () {
        UIBlocker = new KTBlockUI(document.querySelector("#card-body"));
		// Initialize Stepper
		stepperObj = new KTStepper(stepper);

		// Stepper change event
		stepperObj.on('kt.stepper.changed', function (stepper) {
			if (stepperObj.getCurrentStepIndex() === LAST_STEP + 1) {
				formSubmitButton.classList.remove('d-none');
				formSubmitButton.classList.add('d-inline-block');
				formContinueButton.classList.add('d-none');
			} else if (stepperObj.getCurrentStepIndex() === LAST_STEP + 2) {
				formSubmitButton.classList.add('d-none');
				formContinueButton.classList.add('d-none');
				formPreviousButton.classList.add('d-none');
			}else if (stepperObj.getCurrentStepIndex() === LAST_STEP + 3) {
				formSubmitButton.classList.add('d-none');
				formContinueButton.classList.add('d-none');
				formPreviousButton.classList.add('d-none');
			} else {
				formSubmitButton.classList.remove('d-inline-block');
				formSubmitButton.classList.remove('d-none');
				formContinueButton.classList.remove('d-none');
			}
		});

		// Validation before going to next page
		stepperObj.on('kt.stepper.next', function (stepper) {
            validateStep(stepper.getCurrentStepIndex() - 1, stepper);

            if(stepper.getCurrentStepIndex() == LAST_STEP){

                let doctorWorksFor = $("input[name='work_for']:checked").val();

                if(doctorWorksFor == 'clinic'){

                    $("[id^=medical_schedules_").remove(); // delete any medical centers schedules if exists
                    $('#medical_centers_inp').val('').trigger('change');
                }else if(doctorWorksFor == 'medical_center'){

                    $("#clinic-schedules").remove(); // delete any clinic schedules if exists
                }
            }
		});

		// Prev event
		stepperObj.on('kt.stepper.previous', function (stepper) {
			stepper.goPrevious();
			KTUtil.scrollTop();
		});
	}


    var validateStep = function(step, stepper){
        let formData = new FormData( document.getElementById('kt_create_account_form')); console.log(step);
        UIBlocker.block();

        $.ajax({
            type: "post",
            url: $(form).attr('action') + `/${step}`,
            data: formData,
            enctype: 'multipart/form-data',
            processData:false,
            contentType: false,
            cache: false,
            success: function (response) {
                removeValidationMessages();
                let currentStep = stepper.getCurrentStepIndex(); console.log(stepper.getCurrentStepIndex());

                if(currentStep == LAST_STEP)
                    submitFormByAjax();
                else{
                    console.log('error');
                    UIBlocker.release();
                    stepper.goNext();
                    KTUtil.scrollTop();
                }
            },
            error (response) {
                form = $(form);
                stepIsValid = false;

                UIBlocker.release();
                removeValidationMessages();

                if (response.status === 422){
                    displayValidationMessages(response.responseJSON.errors, form);
                    handleRestoredItem();
                }else if (response.status === 403)
                    unauthorizedAlert();
                else
                    errorAlert(response.responseJSON.message , 5000)
            },
        });

        return stepIsValid;
    }

	var handleForm = function() {
		formSubmitButton.addEventListener('click', function (e) {
            validateStep(stepperObj.getCurrentStepIndex() - 1, stepperObj, true);
		});
	}

    var submitFormByAjax = function() {
		form = document.getElementById('kt_create_account_form');

        ajaxSubmission({
            form: form,
            successCallback: function (response) {
                UIBlocker.release();
                stepperObj.goNext();
                KTUtil.scrollTop();
                showToast();

                setTimeout(function(){
                    window.location = '/vendor/products';
                }, 1000);
            },
            errorCallback: function (response) {
                removeValidationMessages();

                if (response.status === 422)
                    displayValidationMessages(response.responseJSON.errors , $(form));
                else if (response.status === 403)
                    unauthorizedAlert();
                else
                    errorAlert(response.responseJSON.message , 5000)
            },
            complete: function () {

            }
        });
	}


    var handleRestoredItem = function() {
        $(".restore-item").on('click', function (e) {
            e.preventDefault();
            UIBlocker.block();

            $.ajax({
                type: "get",
                url: $(this).attr('href'),
                success: function (data) {
                    showToast("تم استعادة الطبيب بنجاح");

                    setTimeout(function(){
                        window.location = '/dashboard/doctors';
                    }, 1000);
                }
            });
        });
    }



	return {
		// Public Functions
		init: function () {
			// Elements
			modalEl = document.querySelector('#kt_modal_create_account');

			if ( modalEl ) {
				modal = new bootstrap.Modal(modalEl);
			}

			stepper = document.querySelector('#kt_create_account_stepper');

			if ( !stepper ) {
				return;
			}

			form = stepper.querySelector('#kt_create_account_form');
			formSubmitButton = stepper.querySelector('[data-kt-stepper-action="submit"]');
			formContinueButton = stepper.querySelector('[data-kt-stepper-action="next"]');
			formPreviousButton = stepper.querySelector('[data-kt-stepper-action="previous"]');
			stepIsValid = false;

			initStepper();
			handleForm();
		}
	};
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTCreateAccount.init();
});



