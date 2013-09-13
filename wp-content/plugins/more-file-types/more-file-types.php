<?php
/*
  Plugin Name: More File Types
  Description: Allow more file types to be uploaded
  Version: 0.1.2
  Contributors: globalnet-1
  Stable tag: trunk
  Author: Global Net One
  License: Modified BSD license
  Author URI: http://globalnet-1.com
 */


/* call register settings menu  */
add_action('admin_menu', 'mft_create_menu');
/* call register settings function */
add_action('admin_init', 'register_mtf_settings');

function mft_create_menu() {
    /* bind settings menu with settings page for our plugin */
    add_options_page('More File Types - Settings', 'More File Types', 'manage_options', 'mft_settings', 'mft_settings_page');
}

function register_mtf_settings() {
    register_setting('mft-settings-group', 'mft-file-list');
}

function mft_settings_page() {
    ?>
    <div class="wrap">
        <h2>More File Types</h2>
        <form method="post" action="options.php">
            <?php settings_fields('mft-settings-group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('File types that is valid to be uploaded by this plugin (separated by spaces):', 'more-file-type'); ?></th>
                </tr>
                <tr valign="top">
                    <th scope="row"><input type="textbox" size="80" name="mft-file-list" value="<?php echo get_option('mft-file-list') ?>"/></th>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Current valid file types to be uploaded by system:', 'more-file-type'); ?></th>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <code>
                            <?php
                            $allowed_mime_types = get_allowed_mime_types();
                            $allowed_exts = array_keys($allowed_mime_types);
                            echo implode(' ', $allowed_exts);
                            ?>
                        </code>
                    </th>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

add_filter('wp_check_filetype_and_ext', our_custom_check_filetype_and_ext, 10, 4);

function our_custom_check_filetype_and_ext($wp_filetype, $file, $filename, $mimes) {
    $exts_original = get_allowed_mime_types();
    $mft_file_list = explode(' ', get_option('mft-file-list'));
    foreach($mft_file_list as $file_ext){
        $exts_modified[$file_ext] = 'application/octet-stream';
    }
    $exts = array_merge($exts_original, $exts_modified);
    $proper_filename = $filename;
    foreach ($exts as $ext_preg => $ext_type) {
        $ext_preg = '!\.(' . $ext_preg . ')$!i';
        if (preg_match($ext_preg, $filename, $ext_matches)) {
            $type = $ext_type;
            $ext = $ext_matches[1];
            break;
        }
    }
    return compact('ext', 'type', 'proper_filename');
}
?>
