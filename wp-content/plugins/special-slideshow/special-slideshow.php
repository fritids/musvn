<?php

/*
  Plugin Name: Special Slideshow
  Description: This plugin provides a shortcode and a action for you to insert slideshow at your desired location
  Version: 0.1
  Author: SilentSword
  License: Modified BSD license
  Author URI: http://silentsword.net
 */

class Special_Slideshow {

    private static $instance;

    public function instance() {
        if (!isset(self::$instance)) {
            self::$instance = new Special_Slideshow();
        }
        return self::$instance;
    }

    public function __construct() {
        $capability = 'manage_options';
        add_menu_page(__('WP Slideshow', 'special-slideshow'), __('WP Slideshow', 'special-slideshow'), $capability, 'special-slideshow', array($this, 'slideshow_manage'), '', 26);
        add_submenu_page('special-slideshow', __('Manage', 'special-slideshow'), __('Manage Slide Show', 'special-slideshow'), $capability, 'special-slideshow', array($this, 'slideshow_manage'));
        add_submenu_page('special-slideshow', __('Add/Edit', 'special-slideshow'), __('Add Banner', 'special-slideshow'), $capability, 'image-manage', array($this, 'image_manage'));
    }
    
    public function activate(){
        
    }
    
    public function deactivate(){
        
    }

    public function slideshow_manage() {
        require_once(plugin_dir_path(__FILE__) . 'slideshow-manage.php');
    }

    public function image_manage() {
        require_once(plugin_dir_path(__FILE__) . 'image-manage.php');
    }

}

function Special_Slideshow() {
    return Special_Slideshow::instance();
}

add_action('admin_menu', 'Special_Slideshow');
?>