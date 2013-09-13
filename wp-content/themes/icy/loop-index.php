<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!--
<div class="container_24">
    <div class="grid_24" id="main">
        <div class="grid_24 alpha omega">
            <div id="slide">
                <img src="<?php bloginfo('template_url') ?>/images/slide.jpg" />
                <img src="<?php bloginfo('template_url') ?>/images/slide2.jpg" />
                <img src="<?php bloginfo('template_url') ?>/images/slide3.jpg" />
            </div>
        </div>

        <div class="clear"></div>

        <div class="marginTop">
            <div class="grid_6 alpha main_cate">
                <a href="" class="cate_img"><img src="<?php bloginfo('template_url') ?>/images/home_cate_1.jpg" /></a>
                <h2 class="title">WEDDING CAKE</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                <p><a href="" class="readmore">View more</a></p>
            </div>
            <div class="grid_6 main_cate">
                <a href="" class="cate_img"><img src="<?php bloginfo('template_url') ?>/images/home_cate_2.jpg" /></a>
                <h2 class="title">WEDDING CAKE</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                <p><a href="" class="readmore">View more</a></p>
            </div>
            <div class="grid_6 main_cate">
                <a href="" class="cate_img"><img src="<?php bloginfo('template_url') ?>/images/home_cate_3.jpg" /></a>
                <h2 class="title">WEDDING CAKE</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                <p><a href="" class="readmore">View more</a></p>
            </div>
            <div class="grid_6 omega main_cate">
                <a href="" class="cate_img"><img src="<?php bloginfo('template_url') ?>/images/home_cate_4.jpg" /></a>
                <h2 class="title">WEDDING CAKE</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                <p><a href="" class="readmore">View more</a></p>
            </div>
        </div>

    </div>
</div>
-->
<div id="slide" style="margin: 60px auto 0 auto;">
    <?php $query = new WP_Query('cat=' . get_category_by_path('slide')->cat_ID); ?>
    <?php while ($query->have_posts()): $query->the_post() ?>
        <?php if (has_post_thumbnail(get_the_ID())): ?>
            <img src="<?php echo reset(wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full')) ?>" />
        <?php endif; ?>
    <?php endwhile; ?>
</div>
<div style="text-align: center; margin-top: 20px;">
    <?php $query = new WP_Query('name=slogan'); ?>
    <?php while ($query->have_posts()): $query->the_post() ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
</div>