<?php
/**
 * Include wp-print for printing functionality
 */
include_once(get_template_directory() . '/inc/wp-print/wp-print.php');

/**
 * Register and enqueue javascript and stylesheet files
 */
function wpmusvn_load_javascript_files() {

    wp_enqueue_script('cufon-yui', get_template_directory_uri() . '/js/cufon-yui.js');
    wp_enqueue_script('Bebas_Neue_400', get_template_directory_uri() . '/js/Bebas_Neue_400.font.js');
    wp_enqueue_script('UTM_Cafeta_400', get_template_directory_uri() . '/js/UTM_Cafeta_400.font.js');
    wp_enqueue_script('UTM_Bebas_400', get_template_directory_uri() . '/js/UTM_Bebas_400.font.js');
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery.smoothdivscroll', get_template_directory_uri() . '/js/smooth_div_scroll/jquery.smoothdivscroll-1.3-min.js', array('jquery', 'jquery-ui-core', 'jquery-ui-widget'));
    wp_enqueue_script('cycle', get_template_directory_uri() . '/js/cycle.js');
    wp_enqueue_script('jquery.dropdown', get_template_directory_uri() . '/js/jquery.dropdown.js', array('jquery'));

    // Adds JavaScript to home pages only
    if (is_home()) {
        wp_enqueue_script('jquery.mousewheel', get_template_directory_uri() . '/js/smooth_div_scroll/jquery.mousewheel.min.js', array('jquery', 'jquery-ui-core'));
        wp_enqueue_script('jquery.kinetic', get_template_directory_uri() . '/js/smooth_div_scroll/jquery.kinetic.js', array('jquery', 'jquery-ui-core'));
        wp_enqueue_script('jquery.mwheelitent', get_template_directory_uri() . '/js/jquery.mwheelitent.min.js', array('jquery'));
        wp_enqueue_script('jquery.jscrollpane', get_template_directory_uri() . '/js/jquery.jscrollpane.min.js', array('jquery'));
        //wp_enqueue_script('jquery.idTabs', get_template_directory_uri() . '/js/jquery.idTabs.min.js', array('jquery'));

        wp_enqueue_script('jquery.easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'));

        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-widget');
    }

    // Adds JavaScript to pages with the comment form to support sites with
    // threaded comments (when in use).
    if (is_singular() && comments_open() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');
}

function wpmusvn_load_stylesheet_files() {
    wp_register_style('core', get_template_directory_uri() . '/style.css');
    wp_register_style('reset', get_template_directory_uri() . '/css/reset.css');
    wp_register_style('smoothDivScroll', get_template_directory_uri() . '/css/smoothDivScroll.css');
    wp_register_style('jscrollpane', get_template_directory_uri() . '/css/jquery.jscrollpane.css');

    wp_enqueue_style('reset');
    wp_enqueue_style('core');
    wp_enqueue_style('smoothDivScroll');
    wp_enqueue_style('jscrollpane');
}

// Let's hook in our function with the javascript files with the wp_enqueue_scripts hook
add_action('wp_enqueue_scripts', 'wpmusvn_load_javascript_files');

// Let's hook in our function with the stylesheet files with the wp_enqueue_scripts hook 
add_action('wp_enqueue_scripts', 'wpmusvn_load_stylesheet_files');

/*
 * Add locations for menus
 */
register_nav_menu('top-menu', 'First menu at the top of the front page');
register_nav_menu('main-menu', 'Second menu at the top of the front page');

/*
 * Register sidebar
 */
register_sidebar(array(
    'name' => __('Home Right Hand Sidebar'),
    'id' => 'home-right-sidebar',
    'description' => __('Widgets in this area will be shown on the right-hand sidebar of home page.'),
    'before_widget' => '<div style="margin-top:5px;">',
    'after_widget' => '</div>'
));
register_sidebar(array(
    'name' => __('News Right Hand Sidebar'),
    'id' => 'news-right-sidebar',
    'description' => __('Widgets in this area will be shown on the right-hand side of post and category page.'),
    'before_widget' => '<div style="padding: 0px 5px;">',
    'after_widget' => '</div>'
));
register_sidebar(array(
    'name' => __('News Float Right Hand Sidebar'),
    'id' => 'news-float-right-sidebar',
    'description' => __('Widgets in this area will be shown on the right-hand side of post and category page.'),
    'before_widget' => '<div style="margin-bottom:5px;">',
    'after_widget' => '</div>'
));
register_sidebar(array(
    'name' => __('Middle Sidebar One'),
    'id' => 'middle-sidebar-1',
    'description' => __('Widgets in this area will be shown on the middle sidebar one.'),
    'before_widget' => '<div class="main_adv1">',
    'after_widget' => '</div>'
));
register_sidebar(array(
    'name' => __('Middle Sidebar Two'),
    'id' => 'middle-sidebar-2',
    'description' => __('Widgets in this area will be shown on the middle sidebar two.'),
    'before_widget' => '<div class="main_adv2">',
    'after_widget' => '</div>'
));

/*
 * Add theme option page
 */
add_action('admin_menu', 'wpmusvn_theme_menu');

function wpmusvn_theme_menu() {
    add_theme_page('Theme Option', 'Theme Options', 'manage_options', 'wpmusvn_theme_options.php', 'wpmusvn_theme_page');
}

/**
 * Callback function to the add_theme_page
 * Will display the theme options page
 */
function wpmusvn_theme_page() {
    ?>            
    <style>
        div.categorydiv{
            min-height: 42px;
            max-height: 200px;
            min-width: 100px;
            max-width: 300px;
            overflow: auto;
            padding: 0 .9em;
            border-style: solid;
            border-width: 1px;
            border-color: #dfdfdf;
            background-color: #fff;
            line-height: 1.4em;
        }
    </style>
    <div class="section panel">
        <h1>MUSVN Theme Options</h1>
        <form method="post" enctype="multipart/form-data" action="options.php">
            <?php
            settings_fields('wpmusvn_theme_options');
            do_settings_sections('wpmusvn_theme_options.php');
            ?>
            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </form>
    </div>
    <?php
}

/**
 * Register the settings to use on the theme options page
 */
add_action('admin_init', 'wpmusvn_register_settings');

/**
 * Function to register the settings
 */
function wpmusvn_register_settings() {
    // Register the settings with Validation callback
    register_setting('wpmusvn_theme_options', 'wpmusvn_theme_options', 'wpmusvn_validate_settings');



    /* ------------- Add settings section for General --------------------- */
    add_settings_section('wpmusvn_general_section', 'General', 'wpmusvn_display_section', 'wpmusvn_theme_options.php');

    // Menu Items per Columns
    $field_args = array(
        'type' => 'text',
        'id' => 'menu_items_per_column',
        'name' => 'menu_items_per_column',
        'desc' => 'The amount of menu items per column',
        'label_for' => 'menu_items_per_column',
        'class' => ''
    );
    add_settings_field('menu_items_per_column', 'Number of menu items per columns', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_general_section', $field_args);

    // Small posts per area category
    $field_args = array(
        'type' => 'text',
        'id' => 'small_posts_per_category',
        'name' => 'small_posts_per_category',
        'desc' => 'The number of small posts per area category',
        'label_for' => 'small_posts_per_category',
        'class' => ''
    );
    add_settings_field('small_posts_per_category', 'Number of small posts per category', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_general_section', $field_args);

    // AddThis Profile ID
    $field_args = array(
        'type' => 'text',
        'id' => 'addthis_profile_id',
        'name' => 'addthis_profile_id',
        'desc' => 'The profile ID of your AddThis',
        'label_for' => 'addthis_profile_id',
        'class' => ''
    );
    add_settings_field('addthis_profile_id', 'AddThis Profile ID', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_general_section', $field_args);

    // Related posts to show
    $field_args = array(
        'type' => 'text',
        'id' => 'related_posts_to_show',
        'name' => 'related_posts_to_show',
        'desc' => 'The number of related posts to show when viewing a post',
        'label_for' => 'related_posts_to_show',
        'class' => ''
    );
    add_settings_field('related_posts_to_show', 'Number of  related posts to show on a post', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_general_section', $field_args);

    // Other posts per post
    $field_args = array(
        'type' => 'text',
        'id' => 'other_posts_per_post',
        'name' => 'other_posts_per_post',
        'desc' => 'The number of other posts in a post',
        'label_for' => 'other_posts_per_post',
        'class' => ''
    );
    add_settings_field('other_posts_per_post', 'Number of other posts display in a post', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_general_section', $field_args);

    // Footer text one
    $field_args = array(
        'type' => 'textarea',
        'id' => 'footer_text_one',
        'name' => 'footer_text_one',
        'desc' => 'The text at the footer one',
        'label_for' => 'footer_text_one',
        'class' => ''
    );
    add_settings_field('footer_text_one', 'Footer text One', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_general_section', $field_args);

    // Footer text two
    $field_args = array(
        'type' => 'textarea',
        'id' => 'footer_text_two',
        'name' => 'footer_text_two',
        'desc' => 'The text at the footer two',
        'label_for' => 'footer_text_two',
        'class' => ''
    );
    add_settings_field('footer_text_two', 'Footer text Two', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_general_section', $field_args);



    /* ------------- Add settings section for Home Page --------------------- */
    add_settings_section('wpmusvn_home_page_section', 'Home Page', 'wpmusvn_display_section', 'wpmusvn_theme_options.php');

    // Scroll category field
    $field_args = array(
        'type' => 'dropdown_categories',
        'id' => 'scroll_category',
        'name' => 'scroll_category',
        'desc' => 'Category of scrolling posts at the top of home page',
        'label_for' => 'scroll_category',
        'class' => ''
    );
    add_settings_field('scroll_category', 'Scroling Category', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_home_page_section', $field_args);

    // Number of post to show in scroll category
    $field_args = array(
        'type' => 'text',
        'id' => 'posts_in_scroll_category',
        'name' => 'posts_in_scroll_category',
        'desc' => 'The number of posts to show in scroll category',
        'label_for' => 'posts_in_scroll_category',
        'class' => ''
    );
    add_settings_field('posts_in_scroll_category', 'Number of posts to show in scroll category', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_home_page_section', $field_args);

    // Big Image category field
    $field_args = array(
        'type' => 'dropdown_categories',
        'id' => 'big_image_category',
        'name' => 'big_image_category',
        'desc' => 'Category of big image posts at the top of home page',
        'label_for' => 'big_image_category',
        'class' => ''
    );
    add_settings_field('big_image_category', 'Big Image Category', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_home_page_section', $field_args);

    // Number of post to show in big image category
    $field_args = array(
        'type' => 'text',
        'id' => 'posts_in_big_image_category',
        'name' => 'posts_in_big_image_category',
        'desc' => 'The number of posts to show in big image category',
        'label_for' => 'posts_in_big_image_category',
        'class' => ''
    );
    add_settings_field('posts_in_big_image_category', 'Number of posts to show in big image category', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_home_page_section', $field_args);

    // Feature category
    $field_args = array(
        'type' => 'dropdown_categories',
        'id' => 'feature_category',
        'name' => 'feature_category',
        'desc' => 'Category for feature posts',
        'label_for' => 'feature_category',
        'class' => ''
    );
    add_settings_field('feature_category', 'Feature Category', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_home_page_section', $field_args);

    // Number of post to show in feature category
    $field_args = array(
        'type' => 'text',
        'id' => 'posts_in_feature_category',
        'name' => 'posts_in_feature_category',
        'desc' => 'The number of posts to show in feature category',
        'label_for' => 'posts_in_feature_category',
        'class' => ''
    );
    add_settings_field('posts_in_feature_category', 'Number of posts to show in feature category', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_home_page_section', $field_args);

    // Number of newest posts to display
    $field_args = array(
        'type' => 'text',
        'id' => 'top_x_newest_post',
        'name' => 'top_x_newest_post',
        'desc' => 'The amount of newest posts to display at the home page',
        'label_for' => 'top_x_newest_post',
        'class' => ''
    );
    add_settings_field('top_x_newest_post', 'Number of newest posts to display', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_home_page_section', $field_args);

    // Number of most read posts to display
    $field_args = array(
        'type' => 'text',
        'id' => 'top_x_most_read_post',
        'name' => 'top_x_most_read_post',
        'desc' => 'The amount of most read posts to display at the home page',
        'label_for' => 'top_x_most_read_post',
        'class' => ''
    );
    add_settings_field('top_x_most_read_post', 'Number of most read posts to display', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_home_page_section', $field_args);

    // Small posts per area category at the home page
    $field_args = array(
        'type' => 'text',
        'id' => 'small_posts_per_category_at_home_page',
        'name' => 'small_posts_per_category_at_home_page',
        'desc' => 'The number of small posts per area category at home page',
        'label_for' => 'small_posts_per_category_at_home_page',
        'class' => ''
    );
    add_settings_field('small_posts_per_category_at_home_page', 'Number of small posts per category at home page', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_home_page_section', $field_args);

    // Area One categories
    $field_args = array(
        'type' => 'categories_checklist',
        'id' => 'area_one_categories',
        'name' => 'area_one_categories',
        'desc' => 'Categories to display in Area One',
        'label_for' => 'area_one_categories',
        'class' => ''
    );
    add_settings_field('area_one_categories', 'Area One Categories', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_home_page_section', $field_args);

    // Area Two categories
    $field_args = array(
        'type' => 'categories_checklist',
        'id' => 'area_two_categories',
        'name' => 'area_two_categories',
        'desc' => 'Categories to display in Area Two',
        'label_for' => 'area_two_categories',
        'class' => ''
    );
    add_settings_field('area_two_categories', 'Area Two Categories', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_home_page_section', $field_args);

    // Image category
    $field_args = array(
        'type' => 'dropdown_categories',
        'id' => 'image_category',
        'name' => 'image_category',
        'desc' => 'Categories to contain image news',
        'label_for' => 'image_category',
        'class' => ''
    );
    add_settings_field('image_category', 'Image Category', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_home_page_section', $field_args);



    /* ------------- Add settings section for Printing Page --------------------- */
    add_settings_section('wpmusvn_print_page_section', 'Printing Page', 'wpmusvn_display_section', 'wpmusvn_theme_options.php');


    // Printing Comments?
    $field_args = array(
        'type' => 'check',
        'id' => 'print_options_comments',
        'name' => 'print_options_comments',
        'value' => 1,
        'desc' => 'Print comments on print page or not',
        'label_for' => 'print_options_comments',
        'class' => ''
    );
    add_settings_field('print_options_comments', 'Print Comments', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_print_page_section', $field_args);

    // Printing Links?
    $field_args = array(
        'type' => 'check',
        'id' => 'print_options_links',
        'name' => 'print_options_links',
        'value' => 1,
        'desc' => 'Print links on print page or not',
        'label_for' => 'print_options_links',
        'class' => ''
    );
    add_settings_field('print_options_links', 'Print Links', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_print_page_section', $field_args);


    // Printing Images?
    $field_args = array(
        'type' => 'check',
        'id' => 'print_options_images',
        'name' => 'print_options_images',
        'value' => 1,
        'desc' => 'Print images on print page or not',
        'label_for' => 'print_options_images',
        'class' => ''
    );
    add_settings_field('print_options_images', 'Print Images', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_print_page_section', $field_args);


    // Printing Videos?
    $field_args = array(
        'type' => 'check',
        'id' => 'print_options_videos',
        'name' => 'print_options_videos',
        'value' => 1,
        'desc' => 'Print videos on print page or not',
        'label_for' => 'print_options_videos',
        'class' => ''
    );
    add_settings_field('print_options_videos', 'Print Videos', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_print_page_section', $field_args);

    // Disclaimer/Copyright Text?
    $field_args = array(
        'type' => 'text',
        'id' => 'print_options_disclaimer_copyright',
        'name' => 'print_options_disclaimer_copyright',
        'value' => js_escape(sprintf('Copyright &copy; %s %s. All rights reserved.', date('Y'), get_option('blogname'))),
        'desc' => 'Disclaimer/Copyright Text in print page',
        'label_for' => 'print_options_disclaimer_copyright',
        'class' => ''
    );
    add_settings_field('print_options_disclaimer_copyright', 'Disclaimer/Copyright Text', 'wpmusvn_display_setting', 'wpmusvn_theme_options.php', 'wpmusvn_print_page_section', $field_args);
}

/**
 * Function to add extra text to display on each section
 */
function wpmusvn_display_section($section) {
    
}

/**
 * Function to display the settings on the page
 * This is setup to be expandable by using a switch on the type variable.
 * In future you can add multiple types to be display from this function,
 * Such as checkboxes, select boxes, file upload boxes etc.
 */
function wpmusvn_display_setting($args) {
    extract($args);
    $option_name = 'wpmusvn_theme_options';
    $options = get_option($option_name);
    switch ($type) {
        case 'check':
            echo "<label for='$label_for'><input type='checkbox' id='$id' name='" . $option_name . "[$name]' value='$value' " . checked($value, $options[$name], false) . " />&nbsp;$desc</label>";
            break;
        case 'text':
            echo "<input class='regular-text$class' type='text' id='$id' name='" . $option_name . "[$name]' value='" . ($options[$name] ? $options[$name] : $value) . "' />";
            echo ($desc != '') ? "<p class='description'>$desc</p>" : "";
            break;
        case 'textarea':
            echo "<textarea style='width:300px; height:150px;' id=$id name='" . $option_name . "[$name]'>" . $options[$name] . "</textarea>";
            echo ($desc != '') ? "<p class='description'>$desc</p>" : "";
            break;
        case 'dropdown_categories':
            wp_dropdown_categories(array('selected' => $options[$name], 'name' => $option_name . "[$name]", 'id' => $id, 'class' => $class));
            echo ($desc != '') ? "<p class='description'>$desc</p>" : "";
            break;
        case 'dropdown_pages':
            wp_dropdown_pages(array('selected' => $options[$name], 'name' => $option_name . "[$name]", 'id' => $id, 'class' => $class));
            echo ($desc != '') ? "<p class='description'>$desc</p>" : "";
            break;
        case 'categories_checklist':
            ?>
            <div class="categorydiv">
                <ul class="categorychecklist">
                    <?php
                    $walker = new Musvn_Walker_Category_Checklist($option_name . "[$name]");
                    wp_category_checklist(0, 0, $options[$name], false, $walker);
                    ?>
                </ul>
            </div>
            <?php
            echo ($desc != '') ? "<p class='description'>$desc</p>" : "";
            break;
    }
}

/**
 * Callback function to the register_settings function will pass through an input variable
 * You can then validate the values and the return variable will be the values stored in the database.
 */
function wpmusvn_validate_settings($input) {
    return $input;
}

/**
 * Custom Walker_Category_Checklist class 
 */
class Musvn_Walker_Category_Checklist extends Walker {

    var $tree_type = 'category';
    var $db_fields = array('parent' => 'parent', 'id' => 'term_id'); //TODO: decouple this
    var $field_name;

    function __construct($input_name) {
        $this->field_name = $input_name;
    }

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent<ul class='children'>\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el(&$output, $category, $depth, $args, $id = 0) {
        extract($args);
        $output .= "\n<li>" . '<label class="selectit"><input value="' . $category->term_id . '" type="checkbox" name="' . $this->field_name . '[]" id="in-' . $taxonomy . '-' . $category->term_id . '"' . checked(in_array($category->term_id, $selected_cats), true, false) . disabled(empty($args['disabled']), false, false) . ' /> ' . esc_html(apply_filters('the_category', $category->name)) . '</label>';
    }

    function end_el(&$output, $category, $depth = 0, $args = array()) {
        $output .= "</li>\n";
    }

}

/*
 * Post view count feature
 */

function wpmusvn_set_post_views($post_id) {
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}

//To keep the count accurate, lets get rid of prefetching
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/*
 * Excerpt length custom filter
 */

function wpmusvn_excerpt_length($length) {
    return 24;
}

add_filter('excerpt_length', 'wpmusvn_excerpt_length', 999);

/**
 * WPMUSVN custom comment form
 */
function wpmusvn_comment_form($args = array(), $post_id = null) {
    if (null === $post_id)
        $post_id = get_the_ID();
    else
        $id = $post_id;

    $commenter = wp_get_current_commenter();
    $user = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';

    if (!isset($args['format']))
        $args['format'] = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';

    $req = get_option('require_name_email');
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5 = 'html5' === $args['format'];
    $fields = array(
        'author' => '<p class="comment-form-author">' . '<label for="author">' . __('Name') . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
        '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>',
        'email' => '<p class="comment-form-email"><label for="email">' . __('Email') . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
        '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>',
        'url' => '<p class="comment-form-url"><label for="url">' . __('Website') . '</label> ' .
        '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>',
    );

    $required_text = sprintf(' ' . __('Required fields are marked %s'), '<span class="required">*</span>');
    $defaults = array(
        'fields' => apply_filters('comment_form_default_fields', $fields),
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x('Comment', 'noun') . '</label> <textarea name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
        'must_log_in' => '<p class="must-log-in">' . sprintf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
        'logged_in_as' => '<p class="logged-in-as">' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'), get_edit_user_link(), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
        'comment_notes_before' => '<p class="comment-notes">' . __('Your email address will not be published.') . ( $req ? $required_text : '' ) . '</p>',
        'comment_notes_after' => '<p class="form-allowed-tags float_left">' . sprintf(__('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s'), ' <code>' . allowed_tags() . '</code>') . '</p>',
        'id_form' => 'commentform',
        'id_submit' => 'submit',
        'title_reply' => __('Leave a Reply'),
        'title_reply_to' => __('Leave a Reply to %s'),
        'cancel_reply_link' => __('Cancel reply'),
        'label_submit' => __('Post Comment'),
        'format' => 'xhtml',
    );

    $args = wp_parse_args($args, apply_filters('comment_form_defaults', $defaults));
    ?>
    <?php if (comments_open($post_id)) : ?>
        <?php do_action('comment_form_before'); ?>
        <div id="respond">
            <h3 id="reply-title"><?php comment_form_title($args['title_reply'], $args['title_reply_to']); ?> <small><?php cancel_comment_reply_link($args['cancel_reply_link']); ?></small></h3>
            <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
                <?php echo $args['must_log_in']; ?>
                <?php do_action('comment_form_must_log_in_after'); ?>
            <?php else : ?>
                <form action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post" id="<?php echo esc_attr($args['id_form']); ?>" class="comment-form"<?php echo $html5 ? ' novalidate' : ''; ?>>
                    <?php do_action('comment_form_top'); ?>
                    <?php if (is_user_logged_in()) : ?>
                        <?php echo apply_filters('comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity); ?>
                        <?php do_action('comment_form_logged_in_after', $commenter, $user_identity); ?>
                    <?php else : ?>
                        <?php echo $args['comment_notes_before']; ?>
                        <?php
                        do_action('comment_form_before_fields');
                        foreach ((array) $args['fields'] as $name => $field) {
                            echo apply_filters("comment_form_field_{$name}", $field) . "\n";
                            echo '<div class="clear height5"></div>' . "\n";
                        }
                        do_action('comment_form_after_fields');
                        ?>
                    <?php endif; ?>
                    <?php echo apply_filters('comment_form_field_comment', $args['comment_field']); ?>
                    <div class="clear height5"></div>
                    <label for="submit">&nbsp;</label>
                    <?php echo $args['comment_notes_after']; ?>
                    <div class="clear height5"></div>
                    <p class="form-submit">
                        <label for="submit">&nbsp;</label>
                        <input name="submit" type="submit" id="<?php echo esc_attr($args['id_submit']); ?>" value="<?php echo esc_attr($args['label_submit']); ?>" />
                        <?php comment_id_fields($post_id); ?>
                    </p>
                    <div class="clear height5"></div>
                    <?php do_action('comment_form', $post_id); ?>
                </form>
            <?php endif; ?>
        </div><!-- #respond -->
        <?php do_action('comment_form_after'); ?>
    <?php else : ?>
        <?php do_action('comment_form_comments_closed'); ?>
    <?php endif; ?>
    <?php
}

/**
 * WPMUSVN theme comments print function
 */
function wpmusvn_list_comments($comments, $depth, $parent) {
    foreach ($comments as $comment) {
        if ($comment->comment_parent == $parent) {
            ?>
            <div id="div-comment-<?php echo $comment->comment_ID ?>" class="list_comment">
                <div class="comment_info">
                    <div class="comment_author">
                        <span>Người gửi: <b><a class="authorUrl" href="<?php echo get_comment_author_url($comment->comment_ID) ?>"><?php echo get_comment_author($comment->comment_ID) ?></a></b></span>
                    </div>
                    <div class="comment_date">
                        <span>Ngày gửi: <b><?php echo get_comment_date('G:i - d/m/Y', $comment->comment_ID) ?></b></span>
                    </div>
                    <div class="comment_rating">
                        <div class="rating_info">
                            <span>(<strong>0</strong>)</span>
                            <a href=""><img src="<?php echo get_template_directory_uri() ?>/images/like.png" width="18" height="22" /></a>
                            <span>(<strong>0</strong>)</span>
                            <a href=""><img src="<?php echo get_template_directory_uri() ?>/images/unlike.png" width="18" height="22" /></a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="comment_desc">
                    <?php comment_text($comment->comment_ID) ?>
                    <?php $reply_link = get_comment_reply_link(array('add_below' => 'div-comment', 'depth' => $depth - 1, 'max_depth' => $depth), $comment) ?>
                    <?php $edit_link = '<a href="' . get_edit_comment_link($comment->comment_ID) . '">' . __('Edit') . '</a>' ?>
                    <?php if (trim($reply_link) && trim($edit_link)): ?>
                        <p><strong><?php echo implode('&nbsp;|&nbsp;', array($reply_link, $edit_link)) ?></strong></p>
                    <?php elseif (trim($reply_link) || trim($edit_link)): ?>
                        <p><strong><?php echo implode('', array($reply_link, $edit_link)) ?></strong></p>
                    <?php endif; ?>
                    <?php wpmusvn_list_comments($comments, $depth - 1, $comment->comment_ID) ?>
                </div>
            </div>
            <?php
        }
    }
}

