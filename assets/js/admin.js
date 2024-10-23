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

    // jQuery('.js-example-basic-multiple').on('input', function () {
    //     var searchQuery = jQuery(this).val();
    //
    //     if (searchQuery.length > 2) { // Only search if input has more than 2 characters
    //         jQuery.ajax({
    //             url: myAjax.ajaxurl, // Use the localized ajax URL
    //             type: 'POST',
    //             data: {
    //                 action: 'my_action', // AJAX action name defined in PHP
    //                 search_query: searchQuery,
    //             },
    //             success: function (response) {
    //                 console.log(response); // Log the full response
    //
    //                 if (response.success) {
    //                     var resultHtml = '';
    //                     jQuery.each(response.data, function(index, post) {
    //                         console.log(post); // Log each post
    //                         resultHtml += '<li><a href="' + post.link + '">' + post.title + '</a></li>';
    //                     });
    //
    //                     console.log(resultHtml); // Log the generated HTML
    //                     jQuery('#search-results').html('<ul>' + resultHtml + '</ul>');
    //                 } else {
    //                     jQuery('#search-results').html('<p>' + response.data + '</p>');
    //                 }
    //             },
    //             error: function(jqXHR, textStatus, errorThrown) {
    //                 console.log('AJAX error:', textStatus, errorThrown); // Log AJAX errors
    //             }
    //         });
    //     } else {
    //         jQuery('#search-results').html(''); // Clear results if input is less than 2 characters
    //     }
    // });

    jQuery('.js-example-basic-multiple').select2({
        ajax: {
            url: myAjax.ajaxurl, // Use the localized ajax URL
            type: 'POST',
            dataType: 'json', // Expecting JSON response from the server
            delay: 250, // Delay the request to prevent unnecessary rapid requests
            data: function(params) {
                return {
                    action: 'my_action', // The action name to call in PHP
                    search_query: params.term, // The search query entered by the user
                };
            },
            processResults: function(response) {
                if (response.success) {
                    return {
                        results: response.data.map(function(post) {
                            return {
                                id: post.link, // ID or value you want to return
                                text: post.title // Displayed text
                            };
                        })
                    };
                } else {
                    return {
                        results: [{ id: '', text: 'No results found' }]
                    };
                }
            },
            cache: true // Enable caching to minimize requests
        },
        minimumInputLength: 3 // Minimum characters required before search starts
    });


});
