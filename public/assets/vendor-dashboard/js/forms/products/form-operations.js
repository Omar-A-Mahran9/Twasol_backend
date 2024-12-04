    let doctorSchedules = JSON.parse($("input[name='doctor_schedules']").val() || "[]");

    getSubspecializationOnChoosingParent();
    generateClinicSchedulesIfNotExist();
    showCorrectWorkForFields($("input[name='work_for']:checked").val());
    onWorksForRadioChange();

    $('#medical_centers_inp').select2();
    let currentMedicals = $('#medical_centers_inp').select2('data');

    $.each(currentMedicals, function (key, medicalCenter) {
        generateMedicalCenterSchedules(medicalCenter);
    });

    $('#medical_centers_inp').on('select2:select', function (e) { /** generate schedules on adding new medical center **/
        let medicalCenter = e.params.data;
        generateMedicalCenterSchedules(medicalCenter);
    });

    $('#medical_centers_inp').on('select2:unselect', function (e) {/** delete schedules on removing medical center **/
        let medicalCenter = e.params.data;
        $(`#medical_schedules_${medicalCenter.id}`).remove();
    });

    function getSubspecializationOnChoosingParent() {
        $("#main_specialization_id_inp").change(function (e) {
            e.preventDefault();

            let countryId = $(this).val();
            if(countryId == '' || !countryId)
                $("#specializations_inp").empty().trigger("change");
            else{
                $.ajax({
                type: "get",
                url: `/dashboard/settings/specializations/${countryId}/sub-specializations`,
                success: function (specializations) {
                    $("#specializations_inp").empty().trigger("change");
                    $.each(specializations, function (index, specialization) {
                        $("#specializations_inp").append(new Option(specialization.name, specialization.id));
                    });
                }
            });
            }
        });
    }

    function generateClinicSchedulesIfNotExist() {
        if ($('#clinic-schedules').length === 0) {

            $(".schedules").prepend(`
                <div id="clinic-schedules">
                    <!--begin::Heading-->
                    <div class="py-10">
                        <!--begin::Title-->
                        <h4 class="fw-bold text-dark">${ __('مواعيد العمل بالعيادة') }</h4>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <div class="row justify-content-center">
                        ${reservationTypesWithId(0)}
                        ${buildDaysCardsWithId(0)}
                    </div>
                </div>
            `);

            openCheckedDays();
            reinitializeTimepickerInputs();
        }
    }

    function generateMedicalCenterSchedules(medicalCenter) {

        $(".schedules").append(`
            <div id="medical_schedules_${medicalCenter.id}">
                <!--begin::Heading-->
                <div class="py-10">
                    <!--begin::Title-->
                    <h4 class="fw-bold text-dark">${ __('مواعيد العمل بمركز ') } ( ${medicalCenter.text} )</h4>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <div class="row justify-content-center">
                    ${reservationTypesWithId(medicalCenter.id)}
                    ${buildDaysCardsWithId(medicalCenter.id)}
                </div>
            </div>
        `);

        openCheckedDays();
        reinitializeTimepickerInputs();
    }

    function openCheckedDays() {
        let $checkedInputs = $("[id*='Checked_']:checked");

        $.each($checkedInputs, function (key, input) {
            let collapseCardId = $(input).attr('data-bs-target');

            $(collapseCardId).addClass("show")
        });
    }

    function buildDaysCardsWithId(id) {
        let daysCards = '';
        let weekDays = ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday'];



        $.each(weekDays, function(key, day) {
            console.log(getValue(id, day, 'start_time'));
            daysCards += `
            <div class="col-lg-4 mb-5">
                <div class="card shadow-sm">
                    <div class="card-header collapsible cursor-pointer rotate">
                        <h3 class="card-title">${ __(day) }</h3>
                        <div class="card-toolbar">
                            <div class="form-check form-switch">
                                <input class="form-check-input"
                                    name="schedules[${id}][${day}][is_available]"
                                    data-day="${day}"
                                    type="checkbox"
                                    role="switch"
                                    ${getValue(id, day, 'is_available') == 1? 'checked': ''}
                                    id="${day}Checked_${id}"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#${day}_${id}">
                                <label class="form-check-label" for="${day}Checked_${id}">${ __('متاح') }</label>
                            </div>
                        </div>
                    </div>
                    <div id="${day}_${id}" class="collapse">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <label for="start_time_inp" class="form-label fs-6 fw-bold mb-3"><span class="required">${ __('بداية العمل') }</span></label>
                                    <input type="start_time" name="schedules[${id}][${day}][start_time]" value="${getValue(id, day, 'start_time')}" class="form-control form-control-lg form-control-solid timepicker" id="schedules_${id}_${day}_start_time_inp" placeholder="${ __('من') }" >
                                    <div class="fv-plugins-message-container invalid-feedback" id="schedules_${id}_${day}_start_time"></div>
                                </div>
                                <div class="col-6">
                                    <label for="end_time_inp" class="form-label fs-6 fw-bold mb-3"><span class="required">${ __('نهاية العمل') }</span></label>
                                <input type="end_time" name="schedules[${id}][${day}][end_time]" value="${getValue(id, day, 'end_time')}" class="form-control form-control-lg form-control-solid timepicker" id="schedules_${id}_${day}_end_time_inp" placeholder="${ __('إلى') }" >
                                <div class="fv-plugins-message-container invalid-feedback" id="schedules_${id}_${day}_end_time"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="break_start_time_inp" class="form-label fs-6 fw-bold mb-3"><span class="">${ __('بداية الراحة') }</span></label>
                                    <input type="text" name="schedules[${id}][${day}][break_start_time]" value="${getValue(id, day, 'break_start_time')}" class="form-control form-control-lg form-control-solid timepicker" id="schedules_${id}_${day}_break_start_time_inp" placeholder="${ __('من') }" >
                                    <div class="fv-plugins-message-container invalid-feedback" id="schedules_${id}_${day}_break_start_time"></div>
                                </div>
                                <div class="col-6">
                                    <label for="break_end_time_inp" class="form-label fs-6 fw-bold mb-3"><span class="">${ __('نهاية الراحة') }</span></label>
                                    <input type="text" name="schedules[${id}][${day}][break_end_time]" value="${getValue(id, day, 'break_end_time')}" class="form-control form-control-lg form-control-solid timepicker" id="schedules_${id}_${day}_break_end_time_inp" placeholder="${ __('إلى') }" >
                                    <div class="fv-plugins-message-container invalid-feedback" id="schedules_${id}_${day}_break_end_time"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;
        });

        return daysCards;
    }

    function reservationTypesWithId(id) {

        return `
        <div class="row d-flex flex-row mb-4 justify-content-center">
            <div class="col-lg-12 text-center">
                <label class="form-label fs-6 fw-bold mb-3"><span class="required">${ __('آلية الحجز') }</span></label>
            </div>
            <div class="container mx-0" style="width:fit-content">
                <input class="form-check-input" name="schedules[${id}][reservation_type]" type="radio" value="specified_time" id="specified_time_${id}" checked="checked" />
                <label class="form-check-label" for="specified_time_${id}">
                    ${ __('الدخول بميعاد محدد') }
                </label>
            </div>
            <div class="container mx-0" style="width:fit-content">
                <input class="form-check-input" name="schedules[${id}][reservation_type]" type="radio" value="advance" id="advance_${id}" ${getValue(id, '', 'reservation_type') == 'advance'? 'checked': ''}/>
                <label class="form-check-label" for="advance_${id}" >
                    ${ __("الدخول بأسبقية الحضور") }
                </label>
            </div>
        </div>
        `;
    }

    function getValue(medicalId, day, field) {
        let value = '';
        let medicalData = doctorSchedules[medicalId];

        if(medicalData != undefined){

            if (field == 'reservation_type') {
                return medicalData['reservation_type']
            }

            let daySchedules = Object.values(medicalData['schedules']).find(function(e) { return e.day_of_week == day; });

            if(daySchedules)
                return daySchedules[field] || '';
        }

        return value;
    }

    function onWorksForRadioChange() {
        $("input[name='work_for']").click(function (e) {
            let workFor = $(this).val();
            showCorrectWorkForFields(workFor);
        });
    }

    function showCorrectWorkForFields(workFor) {
        if (workFor == 'clinic' || workFor == 'both') {
                $(".medical_center").fadeOut();
                generateClinicSchedulesIfNotExist();

            } else if(workFor == 'medical_center')
                $(".clinic").fadeOut();

            $(`.${workFor}`).fadeIn();
    }

    function reinitializeTimepickerInputs() {
        $(".timepicker").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            locale: locale
        });
    }
