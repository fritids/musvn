<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 */
?>
<div id="footer">
    <div class="float_left" style="margin-right: 20px;">
        <a href=""><img src="<?php echo get_template_directory_uri() ?>/images/logo2.png" width="79" height="79" /></a>
    </div>
    <div class="float_left" style="margin-right: 20px;">
        <?php
        $option = get_option('wpmusvn_theme_options');
        echo $option['footer_text_one'];
        ?>
    </div>
    <div class="float_left">
        <?php
        $option = get_option('wpmusvn_theme_options');
        echo $option['footer_text_two'];
        ?>
    </div>
    <div class="clear"></div>
</div>
</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=143153062489569";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<?php
/* Always have wp_footer() just before the closing </body>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to reference JavaScript files.
 */

wp_footer();
?>
</body>
</html>
