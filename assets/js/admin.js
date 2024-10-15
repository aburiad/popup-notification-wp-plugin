jQuery(document).ready(function () {
    jQuery("#specefic").on("change", function() {
        if (jQuery(this).is(':checked')) {
            jQuery(".specefic-options-wrapper").show();  // Show when checked
        } else {
            jQuery(".specefic-options-wrapper").hide();  // Hide when unchecked
        }
    });
});
