<?php


namespace popupnotification;


class Admin
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'load_admin_assets'));
    }

    public function admin_menu()
    {
        add_menu_page(
            __('notification Popup', 'PP-NOTIFY'),
            'Video Popup',
            'manage_options',
            'notification_Popup',
            array($this, 'pp_setting'),
            'dashicons-format-video'
        );
    }

    public function pp_setting(){
        require_once PP_DIR . "/admin/admin-ui.php";
    }
    public function load_admin_assets(){
        wp_enqueue_style('admin-css', PP_URL . '/assets/css/admin.css', array(), PP_VERSION, 'all');
        wp_enqueue_script('admin-js', PP_URL . '/assets/js/admin.js', array(), PP_VERSION, true);

    }

}