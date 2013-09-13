<?php
/*
  Plugin Name: Special Title
  Description: Add an image next to the title of the post
  Version: 0.1.3
  Contributors: globalnet-1
  Stable tag: trunk
  Author: Global Net One
  License: Modified BSD license
  Author URI: http://globalnet-1.com
 */

global $wp_version;

add_action('plugins_loaded', 'special_title_init');

function special_title_init() {
    load_plugin_textdomain('special_title', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}

/* Do something with the data entered */
add_action('save_post', 'special_title_save_postdata');

function special_title_save_postdata($post_id) {
    // verify if this is an auto save routine. 
    // If it is our form has not been submitted, so we dont want to do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times

    if (!wp_verify_nonce($_POST['special_title_noncename'], plugin_basename(__FILE__)))
        return;


    // Check permissions
    if (!current_user_can('edit_post', $post_id))
        return;

    $special_title_data = array('enable' => $_POST['special_title_enable'], 'img_src' => $_POST['special_title_img_src'], 'expiration' => $_POST['special_title_expiration'], 'effective_page' => $_POST['special_title_effective_page']);

    // OK, we're authenticated: we need to find and save the data
    update_post_meta($post_id, 'special_title_data', $special_title_data);
}

/* Prepare for the upload dialog */
add_action('admin_enqueue_scripts', 'special_title_scripts', 100);

function special_title_scripts() {
    wp_enqueue_script('special-title-upload', plugin_dir_url(__FILE__) . 'js/special-title.js', array('jquery', 'media-upload', 'thickbox'));
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style('jquery-datepicker', plugin_dir_url(__FILE__) . 'css/style.css');
}

add_action('admin_footer', 'special_title_footer', 100);

function special_title_footer() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('#special-title-expiration').datepicker({dateFormat: "yy-mm-d"});
        });
    </script>
    <?php
}

/* Define the custom box */
add_action('add_meta_boxes', 'add_special_title_box', 1);

if ($wp_version < 3.0) {
    /* backwards compatible (before WP 3.0) */
    add_action('admin_init', 'add_special_title_box', 1);
}

function add_special_title_box() {
    add_meta_box('special_title_sectionid', __('Special Title', 'special_title'), 'special_title_box', 'post', 'normal', 'default');
}

function special_title_box($post) {
    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'special_title_noncename');

    //Prepare data for display the Special Title Meta Box
    $special_title_data = get_post_meta($post->ID, 'special_title_data', true);

    if (empty($special_title_data)) {
        $special_title_data = array('enable' => '0', 'img_src' => '', 'expiration' => '', 'effective_page' => array());
    }
    // The actual fields for data entry
    ?>
    <table class="form-table">
        <tr valign="top">
            <th scope="row"><?php _e('Enable Special Title for this post', 'special_title') ?></th>
            <td><input type="checkbox" name="special_title_enable" <?php if ((bool) $special_title_data['enable']) echo 'checked=checked'; ?> value="1"/></td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e('Choose the image', 'special_title') ?></th>
            <td>
                <img id="special-title-image" 
                <?php if ($special_title_data['img_src'] == NULL): ?>
                         style="display:none" 
                     <?php else: ?>
                         src="<?php echo $special_title_data['img_src']; ?>"
                     <?php endif; ?>
                     />
                <input type="hidden" id="special-title-img-src" name="special_title_img_src" value="<?php echo $special_title_data['img_src']; ?>"/>
                <input type="button" id="special-title-uploader" value="Browse"/>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php echo __('Expiration date', 'special_title') ?></th>
            <td>
                <input type="text" name="special_title_expiration" id="special-title-expiration" size="20" value="<?php echo $special_title_data['expiration']; ?>"/>
                (<?php _e('Blank mean forever', 'special_title'); ?>)
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php echo __('Effective page', 'special_title'); ?></th>
            <td>
                <div style="overflow:auto; height: 150px; width:300px; padding:.5em .9em; border-style:solid; border-width: 1px; border-color: #DFDFDF; background-color:white; display: block; line-height: 1.4em; color:#333">
                    <ul>
                        <?php $pages = get_pages() ?>
                        <?php foreach ($pages as $page): ?>
                            <li>
                                <label for="special_title_effective_page-<?php echo $page->ID ?>"><input type="checkbox" id="special_title_effective_page-<?php echo $page->ID ?>" value="<?php echo $page->ID ?>" <?php if (@in_array($page->ID, $special_title_data['effective_page'])) echo 'checked=checked' ?> name="special_title_effective_page[]"/>&nbsp;<?php echo $page->post_title; ?> (<?php echo $page->post_name; ?>)</label>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </td>
        </tr>
    </table>
    <?php
}

/* Show special title */
add_filter('the_title', 'special_title_filter', 10, 2);

// Fix for Wordpress 2.9.2 (WP 2.9.2 does not pass argument 2 if type of post is page
function special_title_filter($title, $post_id = 0) {
    if ($post_id === 0)
        return $title;

    //global $wpdb;
    //$special_title_data = maybe_unserialize($wpdb->get_var($wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = %s;", (int)$post_id, 'special_title_data')));
    $special_title_data = get_post_meta((int) $post_id, 'special_title_data', true);

    if (empty($special_title_data))
        return $title;

    if (!$special_title_data['enable'])
        return $title;

    // Only customize title at the main template, not the sidebar
    $backtraces = debug_backtrace();
    foreach ($backtraces as $backtrace) {
        $called_functions[] = $backtrace['function'];
    }
    if (@in_array('get_sidebar', $called_functions)) {
        return $title;
    }

    if (!empty($special_title_data['expiration']) && time() > strtotime($special_title_data['expiration']))
        return $title;

    if (@in_array(get_query_var('page_id'), $special_title_data['effective_page'])) {
        $title .= '<img src="' . $special_title_data['img_src'] . '" title="' . $title . '" style="display:inline!important"/>';
        return $title;
    }

    if (is_home() || is_front_page()) {
        $title .= '<img src="' . $special_title_data['img_src'] . '" title="' . $title . '" style="display:inline!important"/>';
        return $title;
    }

    return $title;
}
?>
