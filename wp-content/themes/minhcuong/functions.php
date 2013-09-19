<?php

/**
 * Register and enqueue javascript and stylesheet files
 */
function mc_load_javascript_files() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery.slides', get_template_directory_uri() . '/js/jquery.slides.js', array('jquery'));
    wp_enqueue_script('lightbox', get_template_directory_uri() . '/js/lightbox-2.6.min.js', array('jquery'));
    wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js', array('jquery'));
}

function mc_load_stylesheet_files() {
    wp_register_style('core', get_template_directory_uri() . '/style.css');
    wp_register_style('reset', get_template_directory_uri() . '/css/reset.css');
    wp_register_style('lightbox', get_template_directory_uri() . '/css/lightbox.css');

    wp_enqueue_style('reset');
    wp_enqueue_style('core');
    wp_enqueue_style('lightbox');
}

// Let's hook in our function with the javascript files with the wp_enqueue_scripts hook
add_action('wp_enqueue_scripts', 'mc_load_javascript_files');

// Let's hook in our function with the stylesheet files with the wp_enqueue_scripts hook 
add_action('wp_enqueue_scripts', 'mc_load_stylesheet_files');
?>