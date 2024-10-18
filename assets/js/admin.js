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

    // search functionality
    jQuery('.js-example-basic-multiple').select2({
        ajax: {
            url: '../wp-content/plugins/popup-notification/admin/search-pages.php', // PHP ফাইলের URL
            dataType: 'json', // সার্ভার থেকে JSON ফরম্যাটে ডাটা নেয়ার জন্য

            // সার্চ টার্ম ইনপুট পাঠানো
            data: function(params) {
                return {
                    search: params.term // ইউজারের টাইপ করা সার্চ টার্ম
                };
            },

            // সার্ভার থেকে রিটার্নকৃত ডাটা প্রক্রিয়া করা
            processResults: function(data) {
                return {
                    results: data // সার্ভার থেকে আসা ডাটা Select2 তে দেখাবে

                };
            }
        },
        minimumInputLength: 2 // ২ অক্ষর টাইপ করলে সার্চ শুরু হবে
    });



});
