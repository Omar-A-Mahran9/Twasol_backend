$(document).ready(function () {

    $("#user_id_inp").select2({
        ajax: {
            url: "/dashboard/select2-ajax/users",
            data: function (params) {
                var query = {
                    search: params.term,
                }
                return query;
            }
        }
    });

    $("#product_id_inp").select2({
        ajax: {
            url: "/dashboard/select2-ajax/products",
            data: function (params) {
                var query = {
                    search: params.term,
                }
                return query;
            }
        }
    });


    $("#category_id_inp,#all_categories").select2({
        ajax: {
            url: "/dashboard/select2-ajax/categories",
            data: function (params) {
                var query = {
                    search: params.term,
                }
                return query;
            }
        }
    });

});
