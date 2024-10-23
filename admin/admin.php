<?php

namespace popupnotification;
class Admin
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'load_admin_assets'));
        add_action("wp_ajax_my_action", array($this, 'search_func'));
        add_action("wp_ajax_nopriv_my_action", array($this, 'search_func'));
    }

    public function search_func()
    {
        if ( isset($_POST['search_query']) ) {
            $search_query = sanitize_text_field( $_POST['search_query'] );

            $args = array(
                's' => $search_query,
                'post_type' => 'page',
                'posts_per_page' => 5,
            );

            $search_results = new \WP_Query($args);

            if ( $search_results->have_posts() ) {
                $results = array();
                while ( $search_results->have_posts() ) {
                    $search_results->the_post();
                    $results[] = array(
                        'title' => get_the_title(),
                        'link' => get_the_title(),
                    );
                }

                // Send JSON response
                wp_send_json_success( $results );
            } else {
                wp_send_json_error( 'No results found' );
            }
        } else {
            wp_send_json_error( 'Invalid request' );
        }

        wp_die();
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
        wp_localize_script( 'admin-js', 'myAjax',
            array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
    }


}