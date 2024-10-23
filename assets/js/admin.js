jQuery(document).ready(function () {
    jQuery("#specefic").on("change", function () {
        if (jQuery(this).is(':checked')) {
            jQuery(".specefic-options-wrapper").show();
            jQuery(".overlay").show();
        }
    });
    jQuery(".overlay").on("click", function () {
        jQuery(".specefic-options-wrapper").hide();
        jQuery(".overlay").hide();
    });
    jQuery("#specefic-close-btn").click(function () {
        jQuery(".specefic-options-wrapper").hide();
        jQuery(".overlay").hide();
    });

    // select2 js
    jQuery('.js-example-basic-multiple').select2({
        width: 'resolve'
    });

    jQuery('.js-example-basic-multiple').select2({
        ajax: {
            url: myAjax.ajaxurl,
            type: 'POST',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    action: 'my_action',
                    search_query: params.term,
                };
            },
            processResults: function(response) {
                if (response.success) {
                    return {
                        results: response.data.map(function(post) {
                            return {
                                id: post.link,
                                text: post.title
                            };
                        })
                    };
                } else {
                    return {
                        results: [{ id: '', text: 'No results found' }]
                    };
                }
            },
            cache: true
        },
        minimumInputLength: 3
    });


});
