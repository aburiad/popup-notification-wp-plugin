jQuery(document).ready(function () {
    jQuery("#specefic").on("change", function() {
        if (jQuery(this).is(':checked')) {
            jQuery(".specefic-options-wrapper").show();
        } else {
            jQuery(".specefic-options-wrapper").hide();
        }
    });
    jQuery("#specefic-close-btn").click(function(){
        jQuery(".specefic-options-wrapper").hide();
    });

    // select2 js
    jQuery('.js-example-basic-multiple').select2({
        width: 'resolve'
    });
});
