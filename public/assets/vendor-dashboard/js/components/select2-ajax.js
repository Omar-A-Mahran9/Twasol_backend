$(document).ready(function () {
    $("#city_id_inp").select2({
        ajax: {
            url: "/vendor/select2-ajax/cities",
            data: function (params) {
                console.log(params)
                var query = {
                    search: params.term,
                }
                return query;
            }
        }
    });



});
