<?php
/*
Plugin Name: its-logout
Description: Logout from WP
Version: 1.0
Author: IT Seniorene AS
Author URI: https://itseniorene.no
*/
if (!function_exists('wp_enqueue_scripts')) die('xxxxxxxxxxxx');
class ITS_logout
{

    public function __construct() {
        add_filter('wp_nav_menu_items', [$this, 'filterMenuItems'], 10, 2);
    }

    public function filterMenuItems($items, $args) {
        if (strpos($items, '_wpnonce=missing')) {
            $logoff_url = wp_logout_url();
            $nonce_pos = strpos($logoff_url, '_wpnonce=');
            $nonce = substr($logoff_url, $nonce_pos+9, 10);
            $items = str_replace('_wpnonce=missing', '_wpnonce='.$nonce, $items);
        }
        return $items;
    }    


}
new ITS_logout();
