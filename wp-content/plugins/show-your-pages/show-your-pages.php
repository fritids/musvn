<?php
/*
  Plugin Name: Show Your Pages
  Description: Display pages at where you want
  Version: 0.1
  Author: Global Net One
  License: Modified BSD license
  Author URI: http://globalnet-1.com
 */

/* register widget */
add_action('widgets_init', array('Show_Your_Pages_Core', 'register_widget'));
/* call create menu function */
add_action('admin_menu', array('Show_Your_Pages_Core', 'syp_create_menu'));
/* call register settings function */
add_action('admin_init', array('Show_Your_Pages_Core', 'register_syp_settings'));
/* add support excerpt for page */
add_post_type_support('page', 'excerpt');
/* add action for showing pages */
add_action('syp_show_pages', array('Show_Your_Pages_Core', 'syp_show_pages_with_excerpt'));
add_action('syp_show_childen_pages', array('Show_Your_Pages_Core', 'syp_show_children_pages_with_excerpt'));

/* helper function */

function get_page_by_slug($page_slug, $output = OBJECT, $post_type = 'page') {
    global $wpdb;
    $page = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type= %s AND post_status = 'publish'", $page_slug, $post_type));
    if ($page)
        return get_post($page, $output);
    return null;
}

/*
 * Show Your Pages - Core
 */

class Show_Your_Pages_Core {

    static function register_widget() {
        /* register Show_Your_Pages widget */
        register_widget("show_your_pages");
    }

    function syp_create_menu() {
        /* create new top-level menu */
        add_pages_page('Show Your Pages - Settings', 'Show Your Pages', 'manage_options', 'syp_settings', array('Show_Your_Pages_Core', 'syp_settings_page'));
    }

    function register_syp_settings() {
        /* register our settings */
        register_setting('syp-settings-group', 'syp-page-list');
        register_setting('syp-settings-group', 'syp-show-childpage');
    }

    function syp_settings_page() {
        ?>
        <div class="wrap">
            <h2>Show Your Pages</h2>
            <?php if ($_GET['settings-updated'] == 'true'): ?>
                <div id="setting-error-settings_updated" class="updated settings-error"> 
                    <p><strong>Settings saved.</strong></p></div>
            <?php endif; ?>
            <form method="post" action="options.php">
                <?php settings_fields('syp-settings-group'); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th><?php _e('Please choose which page you want to show in Show Your Pages', 'show-your-pages'); ?></th>
                        <td>
                            <div class="posttypediv" style="overflow:auto; height: 150px; width:300px; padding:.5em .9em; border-style:solid; border-width: 1px; border-color: #DFDFDF; background-color:white; display: block; line-height: 1.4em; color:#333">
                                <ul id="syp-pages-selector" class="categorychecklist">
                                    <?php
                                    $syp_walker_page_checklist = new Syp_Walker_Page_Checklist();
                                    wp_list_pages(array('walker' => $syp_walker_page_checklist, 'title_li' => null, 'sort_column' => 'post_modified', 'sort_order' => 'DESC'));
                                    ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td colspan="2">
                            <label for="syp-show-childpage"><input type="checkbox" id="syp-show-childpage" name="syp-show-childpage" <?php if (get_option('syp-show-childpage') == 1) echo 'checked=checked' ?> value="1"/>&nbsp;<?php _e('Show all sub pages of checked page', 'show-your-pages') ?></label>
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
            <script type="text/javascript">
                jQuery(document).ready(function() {
                    if (jQuery('input#syp-show-childpage').prop('checked')) {
                        jQuery('ul#syp-pages-selector ul li input').prop('disabled', true);
                    }
                });

                jQuery('input#syp-show-childpage').change(function() {
                    if (jQuery(this).prop('checked')) {
                        jQuery('ul#syp-pages-selector ul li input').prop('disabled', true);
                    } else {
                        jQuery('ul#syp-pages-selector ul li input').prop('disabled', false);
                    }
                });
            </script>
        </div>
        <?php
    }

    function syp_show_children_pages_with_excerpt($slug) {
        $children_pages = get_pages(array('parent' => get_page_by_slug($slug)->ID, 'hierarchical' => 0));
        echo '<ul>';
        foreach ($children_pages as $child_page) {
            echo '<li><a href="' . get_page_link($child_page->ID) . '">' . $child_page->post_title . '</a></li>';
            echo '<p>' . $child_page->post_excerpt . '<a href="' . get_permalink($child_page->ID) . '">もっと読む</a></p>';
        }
        echo '</ul>';
    }

    function syp_show_pages_with_excerpt() {
        echo '<ul>';
        $syp_page_list = get_option('syp-page-list');
        $pages = get_pages(array('sort_column' => 'post_modified', 'sort_order' => 'DESC'));
        $showed_page = 0;
        foreach ($pages as $page) {
            if ($showed_page > 4)
                return;
            foreach ($syp_page_list as $syp_page_id) {
                if (@in_array($page->ID, $syp_page_list) ||
                        (get_option('syp-show-childpage') == 1 && @in_array($syp_page_id, get_ancestors($page->ID, 'page')))) {
                    ?>
                    <li><a href="<?php echo get_page_link($page->ID) ?>"><?php echo get_page($page->ID)->post_title ?></a></li>
                    <p><?php get_page($page->ID)->post_excerpt ?><a href="<?php echo get_permalink($page->ID) ?>">もっと読む</a></p>
                    <?php
                    $showed_page++;
                    break;
                }
            }
        }
        echo '</ul>';
    }

}

/*
 * Show Your Pages - Widget
 * Please enable it through Widget page settings
 */

class Show_Your_Pages extends WP_Widget {

    public function __construct() {
        parent::__construct('show_your_pages', __('Show Your Pages', 'show_your_pages'), array('classname' => 'Show_Your_Pages', 'description' => __('A Widget display your chosen page', 'show_your_pages'),));
    }

    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $page_id = isset($instance['page_id']) ? $instance['page_id'] : '';
        ?>

        <p>
            <input type="hidden" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" value="<?php echo $title ?>" />
            <label for="<?php echo $this->get_field_id('page_id'); ?>"><?php _e('Choose a page:'); ?></label>
            <?php
            wp_dropdown_pages(array('selected' => $page_id, 'name' => $this->get_field_name('page_id'), 'id' => $this->get_field_id('page_id')))
            ?>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['page_id'] = (int) $new_instance['page_id'];
        $instance['title'] = (string) get_page($new_instance['page_id'])->post_title;

        return $instance;
    }

    public function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', get_page($instance['page_id'])->post_title);

        echo $before_widget;
        if (!empty($title))
            echo $before_title . $title . $after_title;
        echo '<ul>' . wp_list_pages('child_of=' . $instance['page_id'] . '&title_li=&echo=0') . '</ul>';
        echo $after_widget;
    }

}

class Syp_Walker_Page_Checklist extends Walker_Page {

    function start_el(&$output, $page, $depth, $args, $current_page) {
        if ($depth)
            $indent = str_repeat("\t", $depth);
        else
            $indent = '';
        extract($args, EXTR_SKIP);
        $output .= $indent . '<li><label for="syp_page_list-' . $page->ID . '"><input type="checkbox" id="syp_page_list-' . $page->ID . '" value="' . $page->ID . '" ' . (@in_array($page->ID, get_option('syp-page-list')) ? 'checked=checked' : "") . ' name="syp-page-list[]"/>&nbsp;' . $page->post_title . '</label></li>';
    }

}
?>
