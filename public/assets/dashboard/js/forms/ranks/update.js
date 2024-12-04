
// start code for getting the rank data by ajax request
$('.edit-rank-btn').click( function () {

    let clickedBtn = $(this);
    let rankId     = $(this).data('rank-id');

    clickedBtn.attr('disabled',true).attr("data-kt-indicator", "on")

    removeValidationMessages();

    /** turn of all checkboxes of the previous edited rank **/

    $('.edit-checkbox').prop('checked',false);

    $.ajax({
        url:"/dashboard/ranks/" + rankId + "/edit",
        method:"GET",
        success:function (response) {
            $("#kt_modal_update_rank").modal('show');

            clickedBtn.attr('disabled',false).removeAttr("data-kt-indicator")
            // set the rank name

            $('.image-input-wrapper').css('background-image', `url('${response["full_image_path"]}')`);
            $("[name='name_ar']").val( response['name_ar'] );
            $("[name='name_en']").val( response['name_en'] );
            $("[name='completed_orders_count']").val( response['completed_orders_count'] );
            $("[name='commission']").val( response['commission'] );
            $("[name='is_default']").prop('checked', response['is_default'] );

            // set the route to the update form
            $("#rank_form_update").attr('action',`/dashboard/ranks/${rankId}`);
            $("#rank_form_update").prepend(`<input type="hidden" name="_method" value="PUT">`);

        },
    });
});
// start code for getting the rank data by ajax request


