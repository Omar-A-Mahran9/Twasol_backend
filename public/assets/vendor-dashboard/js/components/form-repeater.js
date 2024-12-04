$('.form-repeater').repeater({
    initEmpty: false,

    defaultValues: {
        'text-input': 'foo'
    },

    show: function () {
        let newInputs = $(this).find(".form-control");

        $.each(newInputs, function (indexInArray, newInput) {
            let inputName = $(newInput).attr('name');
            let refactoredName = inputName.replaceAll("]", "").replaceAll("[", "_");
            let validationElement = $(newInput).parents("[class*='col-']").find(".invalid-feedback")

            $(newInput).attr("id", `${refactoredName}_inp`);
            $(validationElement).attr("id", refactoredName);
        });

        autosize($('textarea'));
        KTImageInput.init();

        $(this).slideDown();
    },

    hide: function (deleteElement) {
        let newInputs = $(this).find(".form-control");

        $.each(newInputs, function (indexInArray, newInput) {
            let inputName = $(newInput).attr('name');
            let refactoredName = inputName.replaceAll("]", "").replaceAll("[", "_");
            let validationElement = $(newInput).parents("[class*='col-']").find(".invalid-feedback")
            console.log(refactoredName, $(newInput).attr("id", `${refactoredName}_inp`));

            $(newInput).attr("id", `${refactoredName}_inp`);
            $(validationElement).attr("id", refactoredName);
        });

        autosize($('textarea'));

        $(this).slideUp(deleteElement);
    }
});
