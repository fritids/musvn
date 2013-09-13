<?php
/**
 * The loop that displays a single post.
 *
 * The loop displays the posts and the post content. See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-single.php.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.2
 */
?>
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
get_header();
?>
<div class="container_24">
    <div class="grid_24" id="main_content">
        <div class="grid_24 alpha omega">
            <img src="<?php bloginfo('template_url') ?>/images/header_image.jpg" alt="" />
        </div>

        <div class="clear"></div>

        <div id="columns">
            <div class="grid_15 alpha prefix_1 suffix_1">
                <h1 class="big_title"><span>PRODUCTS &amp; GALLERY</span></h1>

                <h2 class="second_title"><?php the_title() ?></h2>
                <div class="des">
                    <?php global $more; ?>
                    <?php $more = 1 ?>
                    <?php the_content('') ?>
                </div>
                <?php echo do_shortcode('[gallery link="file" perpage="15" columns="5"]') ?>
            </div>
            <div class="grid_6 omega suffix_1" id="right_column">
                <?php $cat = get_the_category($post->ID); ?>
                <h2 class="second_title"><?php echo $cat[0]->name; ?></h2>
                <ul id="vertical_menu">
                    <?php $query = new WP_Query('cat=' . $cat[0]->cat_ID . '&'); ?>
                    <?php while ($query->have_posts()): $query->the_post() ?>
                        <li><a href="<?php echo get_permalink(get_the_ID()) ?>" class="<?php echo (get_the_ID() == get_query_var('p')) ? 'current' : '' ?>"><?php the_title() ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>

    </div>
</div>
<?php
get_footer();
?>