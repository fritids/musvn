<?php

/*
 * WordPress Plugin: WP-Print
 * Copyright (c) 2012 Lester "GaMerZ" Chan
 *
 * File Written By:
 * - Lester "GaMerZ" Chan
 * - http://lesterchan.net
 *
 */


### Variables
$links_text = '';

### Actions
add_action('init', 'print_content');

### Filters
add_filter('wp_title', 'print_pagetitle');
add_filter('comments_template', 'print_template_comments');

### Load Print Post/Page Template
if (file_exists(TEMPLATEPATH . '/print-posts.php')) {
    include(TEMPLATEPATH . '/print-posts.php');
} else {
    include(dirname(__FILE__) . '/print-posts.php');
}
?>