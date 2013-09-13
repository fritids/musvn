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
                        <th scope="row"><?php _e('Please choose which page you want to show in Show Your Pages', 'show-your-pages'); ?></th>
                        <td>
                            <div style="overflow:auto; height: 150px; width:300px; padding:.5em .9em; border-style:solid; border-width: 1px; border-color: #DFDFDF; background-color:white; display: block; line-height: 1.4em; color:#333">
                                <ul>
                                    <?php
                                    $syp_walker_page_checklist = new Syp_Walker_Page_Checklist();
                                    wp_list_pages(array('walker' => $syp_walker_page_checklist, 'title_li' => null));
                                    ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    function syp_show_pages_with_excerpt() {
        $syp_page_list = get_option('syp-page-list');
        foreach ($syp_page_list as $page_id) {
            setup_postdata(get_page($page_id));
            echo '<h2>' . get_page($page_id)->post_title . '</h2>';
            echo '<p>' . get_the_excerpt() . '</p>';
        }
        wp_reset_postdata();
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

        $title = '<a href=' . get_permalink($instance['page_id']) . '>' . apply_filters('widget_title', get_page($instance['page_id'])->post_title) . '</a>';

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
            $indent = str_repeat("&nbsp", $depth);
        else
            $indent = '';

        extract($args, EXTR_SKIP);
        ?>
        <label for="syp_page_list-<?php echo $page->ID ?>"><input type="checkbox" id="syp_page_list-<?php echo $page->ID ?>" value="<?php echo $page->ID ?>" <?php if (@in_array($page->ID, get_option('syp-page-list'))) echo 'checked=checked' ?> name="syp-page-list[]"/>&nbsp;<?php echo $page->post_title; ?></label>
        <?php
    }

}
?>
