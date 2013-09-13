<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
</div>

<div id="footer_line"></div>

<div class="container_24">
    <div class="grid_24" id="footer">
        <ul class="menu grid_19 alpha" id="footer_menu">
            <?php wp_nav_menu('menu=main-menu&items_wrap=%3$s&container=') ?>
        </ul>
        <div class="float_right" id="designBy">Design by <a href="http://silentsword.net" target="_blank">Silent Sword</a></div>
    </div>
</div>

<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/shadowbox.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/cycle.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/cufon-yui.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/Myriad_Pro_Cond_700.font.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery.dropdown.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/custom.js"></script>
</body>
</html>

<?php
/* Always have wp_footer() just before the closing </body>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to reference JavaScript files.
 */

wp_footer();
?>
