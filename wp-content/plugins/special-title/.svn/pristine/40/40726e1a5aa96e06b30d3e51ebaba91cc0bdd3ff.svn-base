/*
  Plugin Name: Special Title
  Description: Add an image next to the title of the post
  Version: 0.1.2
  Contributors: globalnet-1
  Stable tag: trunk
  Author: Global Net One
  License: Modified BSD license
  Author URI: http://globalnet-1.com
 */

jQuery(document).ready(function() {
 
    jQuery('#special-title-uploader').click(function() {
        formfield = jQuery('#special-title-img-src').attr('name');
        tb_show('Special Title Image Chooser', 'media-upload.php?type=image&amp;TB_iframe=true');
        
        // Save old send_to_editor function
        old_send_to_editor = window.send_to_editor;
        
        window.send_to_editor = function(html) {
            imgurl = jQuery('img',html).attr('src');
            jQuery('#special-title-img-src').val(imgurl);
            jQuery('#special-title-image').attr('src',imgurl);
            jQuery('#special-title-image').show();
            tb_remove();
            // Restore old send_to_editor function
            window.send_to_editor = old_send_to_editor;
        }
        
        return false;
    });
});