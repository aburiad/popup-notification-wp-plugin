<?php

namespace popupnotification;
class Admin
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'load_admin_assets'));
        add_action("wp_ajax_my_action", array($this, 'test_func'));
        add_action("wp_ajax_nopriv_my_action", array($this, 'test_func'));
    }

    public function test_func()
    {
        echo "ajax working from test_func";
        die();
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

    public function pp_setting()
    {
        require_once PP_DIR . "/admin/admin-ui.php";
    }

    public function load_admin_assets()
    {
        wp_enqueue_style('admin-css', PP_URL . '/assets/css/admin.css', array(), PP_VERSION, 'all');
        wp_enqueue_style('select2', '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', array(), PP_VERSION, 'all');
        wp_enqueue_script('admin-js', PP_URL . '/assets/js/admin.js', array(), PP_VERSION, true);
        wp_enqueue_script('select2-js', '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array(), PP_VERSION, true);
    }


}