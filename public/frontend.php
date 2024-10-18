<?php
namespace popupnotification;

class FrontEnd
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'assets_load'));
        add_action('wp', array($this, 'display_time'));
    }

    public function markup()
    {
        $data = get_option('vp-options_data');
        $options = maybe_unserialize($data);
        // Display the HTML for the video popup
        ?>
        <!-- Overlay -->
        <div class="overlay" id="overlay"></div>

        <!-- Video Popup -->
        <div class="video-popup" id="videoPopup">
            <button class="close-btn" id="closePopup">Close</button>
            <iframe id="popupVideo" src="<?php echo esc_url($options['video_url']); ?>" allowfullscreen></iframe>
        </div>
        <?php
    }

    public function assets_load()
    {
        wp_enqueue_style('frontend-css', PP_URL . '/assets/css/frontend.css', array(), PP_VERSION, 'all');
        wp_enqueue_script('frontend-js', PP_URL . '/assets/js/frontend.js', array(), PP_VERSION, true);
    }


    function display_time()
    {
        $data = get_option('vp-options_data');
        $options = maybe_unserialize($data);

        if (!isset($options['dtime'])) {
            $options['dtime'] = '';
        }

        // Check if the selected page type is set in the options
        if (!isset($options['selectpage'])) {
            $options['selectpage'] = 'homepage';
        }

        $selected_page = $options['selectpage'];


        // Check if the current page matches the selected page type
        $is_page_selected = false;

        if ($selected_page === 'homepage') {
            $is_page_selected = is_home() || is_front_page();
        } elseif ($selected_page === 'page') {
            $is_page_selected = is_page();
        } elseif ($selected_page === 'post') {
            $is_page_selected = is_single();
        } elseif ($selected_page === 'archive') {
            $is_page_selected = is_archive();
        } elseif ($selected_page === 'search') {
            $is_page_selected = is_search();
        } elseif ($selected_page === 'website') {
            $is_page_selected = true; // For 'website', always return true
        }

        $specefic_page = $options['speceficdata'];

        foreach ($specefic_page as $page) {
            if ($specefic_page == is_page($page)) {
                $is_page_selected = true;
            }
        }


        // Now handle the cookie logic and show the popup if needed
        $cookie_name = "notification_shown";
        $notification_delay = (int)$options['dtime'];

        if (!isset($_COOKIE[$cookie_name]) || (time() - $_COOKIE[$cookie_name]) > $notification_delay) {
            if ($is_page_selected) {
                // Set the cookie
                setcookie($cookie_name, time(), time() + $notification_delay, "/");

                // Output the video popup markup
                $this->markup();
            }
        } else {
            echo "No notification this time. Notification will appear after " .
                ($notification_delay - (time() - $_COOKIE[$cookie_name])) . " seconds.";
        }
    }

}

?>
