<?php
/**
 * Plugin Name: Popup-Notification
 * Plugin URL: https://github.com/aburiad/Popup-Notification
 * Text Domain: Popup-Notification
 * Domain Path: /languages/
 * Description: PP-NOTIFY : A Popup-Notification screen add-on for your WordPress website.
 * Version: 1.0.0
 * Author: Riad
 * Author URI: https://github.com/aburiad
 * License: GPL-2.0-or-later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Tested up to: 6.6
 */


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if (!defined('PP_DIR')) {
    define('PP_DIR', dirname(__FILE__));
}
if (!defined('PP_URL')) {
    define('PP_URL', plugin_dir_url(__FILE__));
}

if (!defined('PP_VERSION')) {
    define('PP_VERSION', '1.0.0');
}

add_action('plugins_loaded','popup_init');

function popup_init(){
    require_once PP_DIR . '/admin/admin.php';
    require_once PP_DIR . '/public/frontEnd.php';
    new \popupnotification\Admin();
    new \popupnotification\FrontEnd();
}

