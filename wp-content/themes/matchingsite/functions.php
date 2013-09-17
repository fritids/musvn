<?php

add_action('admin_init', 'handle_projectpage_route');

function handle_projectpage_route() {
    add_rewrite_rule('project/([^/]+)/?', 'index.php?project=$matches[1]', 'top');
    flush_rewrite_rules();
}

add_filter('init', 'declare_projectpage_vars');

function declare_projectpage_vars() {
    add_rewrite_tag('%project%', '([0-9]+)');
}

add_filter('template_include', 'my_template', 1, 1);

function my_template($template) {
    global $wp_query;

    if (isset($wp_query->query_vars['project'])) {
        return get_template_directory() . '/project.php';
    }
    return $template;
}
?>