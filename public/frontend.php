<?php
namespace popupnotification;

class FrontEnd
{
    public function __construct()
    {
        add_action('wp_body_open', array($this, 'markup'));
        add_action('wp_enqueue_scripts', array($this, 'assets_load'));
        add_action('init', array($this, 'display_time'));
    }

    public function markup()
    {
        $data = get_option('vp-options_data');
        $options = maybe_unserialize($data);
        if (!isset($options['video_url'])) {
            $options['video_url'] = '';
        }
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


// Define the cookie name and duration for showing the notification again
        $cookie_name = "notification_shown";
        $notification_delay = 30; // 300 seconds = 5 minutes

// Check if the cookie is set or if the delay has passed
        if (!isset($_COOKIE[$cookie_name]) || (time() - $_COOKIE[$cookie_name]) > $notification_delay) {

            // If no cookie exists or the delay has passed, show the notification
            echo "<div style='padding: 10px; background-color: #f0ad4e; color: white;'>
            This is your notification message!
          </div>";

            
            // Set or update the cookie to mark the current time as when the notification was shown
            setcookie($cookie_name, time(), time() + $notification_delay, "/"); // Cookie expires after 5 minutes

        } else {
            // Optionally, you can show a different message or nothing at all
            echo "No notification this time. Notification will appear after " .
                ($notification_delay - (time() - $_COOKIE[$cookie_name])) . " seconds.";
        }

    }
}

?>



