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
        ?>
        <!-- Overlay -->
        <div class="overlay" id="overlay"></div>

        <!-- Video Popup -->
        <div class="video-popup" id="videoPopup">
            <button class="close-btn" id="closePopup">Close</button>
            <iframe id="popupVideo" src="https://www.youtube.com/embed/dQw4w9WgXcQ" allowfullscreen></iframe>
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



