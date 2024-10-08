<?php
namespace popupnotification;

class FrontEnd
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'assets_load'));
        add_action('wp', array($this, 'display_time'));
    }

    public function markup($options)
    {
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

    public function is_page_selected($selected_page)
    {
        // Check which page type is selected and return whether the current page matches
        switch ($selected_page) {
            case 'homepage':
                return is_home() || is_front_page();
            case 'page':
                return is_page();
            case 'post':
                return is_single();
            case 'archive':
                return is_archive();
            case 'search':
                return is_search();
            case 'website':
                return true; // Show on the entire website
            default:
                return false;
        }
    }

    function display_time()
    {
        $data = get_option('vp-options_data');
        $options = maybe_unserialize($data);

        // Check if the time delay is set in the options
        if (!isset($options['dtime'])) {
            $options['dtime'] = '';
        }

        // Check if the selected page type is set in the options
        if (!isset($options['selectpage'])) {
            $options['selectpage'] = 'homepage'; // Default to homepage
        }

        // Only display the popup if the page type matches the selected option
        if (!$this->is_page_selected($options['selectpage'])) {
            return; // Don't display the popup if the page doesn't match
        }

        // Define the cookie name and duration for showing the notification again
        $cookie_name = "notification_shown";
        $notification_delay = (int) $options['dtime'] * 3600;

        // Check if the cookie is set or if the delay has passed
        if (!isset($_COOKIE[$cookie_name]) || (time() - $_COOKIE[$cookie_name]) > $notification_delay) {
            setcookie($cookie_name, time(), time() + $notification_delay, "/");

            // Output the video popup markup
            $this->markup($options);
        } else {
            // Show the time remaining until the next notification
            echo "No notification this time. Notification will appear after " .
                ($notification_delay - (time() - $_COOKIE[$cookie_name])) . " seconds.";
        }
    }
}
?>
