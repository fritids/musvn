<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$cat = get_category(get_query_var('cat'));
get_header();
$query = new WP_Query('cat=' . $cat->cat_ID . '&');
?>
<div class="container_24">
    <div class="grid_24" id="main_content">
        <div class="grid_24 alpha omega">
            <img src="<?php bloginfo('template_url') ?>/images/header_image.jpg" alt="" />
        </div>

        <div class="clear"></div>

        <div id="columns">
            <div class="grid_15 alpha prefix_1 suffix_1">
                <h1 class="big_title"><span><?php echo $cat->name ?></span></h1>
                <?php while ($query->have_posts()): $query->the_post() ?>
                    <h2 class="second_title"><?php the_title(); ?></h2>
                    <div class="des">
                        <?php global $more ?>
                        <?php $more = 0 ?>
                        <p><?php the_content('') ?></p>
                    </div>
                    <?php $photos = get_posts('post_parent=' . get_the_ID() . '&post_type=attachment&post_mime_type=image&numberposts=5') ?>
                    <?php foreach ($photos as $photo): ?>
                        <div class="grid_3 alpha">
                            <a title="<?php echo $cat->name ?>" href="<?php echo reset(wp_get_attachment_image_src($photo->ID, 'full')) ?>" rel="shadowbox[home_project]"><img src="<?php echo reset(wp_get_attachment_image_src($photo->ID, 'thumb')) ?>" alt="" /></a>
                        </div>
                    <?php endforeach; ?>
                    <p><a href="<?php echo get_permalink(get_the_ID()) ?>" class="readmore">View more</a></p>

                    <p class="clear height10"></p>
                <?php endwhile; ?>
            </div>
            <div class="grid_6 omega suffix_1" id="right_column">
                <h2 class="second_title"><?php echo $cat->name ?></h2>
                <ul id="vertical_menu">
                    <?php $query = new WP_Query('cat=' . $cat->cat_ID . '&'); ?>
                    <?php while ($query->have_posts()): $query->the_post() ?>
                        <li><a href="<?php echo get_permalink(get_the_ID()) ?>"><?php the_title() ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>

    </div>
</div>
<?php
get_footer();
?>