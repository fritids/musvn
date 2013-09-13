<?php
/*
 * Template Name: About us
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
setup_postdata(get_page(get_the_ID()));
get_header();
?>
<div class="container_24">
    <div class="grid_24" id="main_content">
        <div class="grid_24 alpha omega">
            <img src="<?php bloginfo('template_url') ?>/images/header_image.jpg" alt="" />
        </div>

        <div class="clear"></div>

        <div id="columns">
            <div class="grid_16 alpha prefix_1">
                <h1 class="big_title"><span><?php the_title() ?></span></h1>
                <?php the_content() ?>
            </div>
            <?php get_sidebar() ?>
        </div>

    </div>
</div>
<?php
get_footer();
wp_footer();
?>