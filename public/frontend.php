<?php
namespace popupnotification;

class FrontEnd
{
    public function __construct()
    {
        add_action('wp_body_open', array($this, 'markup'));
        add_action('wp_enqueue_scripts', array($this, 'assets_load'));
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
            <iframe id="popupVideo" src="<?php echo esc_url($options['video_url']);?>" allowfullscreen></iframe>
        </div>
        <?php
    }

    public function assets_load()
    {
        wp_enqueue_style('frontend-css', PP_URL . '/assets/css/frontend.css', array(), PP_VERSION, 'all');
        wp_enqueue_script('frontend-js', PP_URL . '/assets/js/frontend.js', array(), PP_VERSION, true);
    }
}

?>



