<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
<div class="grid_6 omega suffix_1" id="right_column">
    <!-- Contact Us -->
	<?php $query = new WP_Query('pagename=contact') ?>
	<?php while ($query->have_posts()): $query->the_post() ?>
		<?php global $more ?>
		<?php $more = 0 ?>
		<?php the_content('') ?>
	<?php endwhile; ?>
	<?php wp_reset_postdata() ?>

    <!-- Icy in the Media -->
    <?php $query = new WP_Query('cat=' . get_category_by_path('media')->cat_ID . '&posts_per_page=1&paged=1') ?>
    <h2><?php echo get_category_by_path('media')->cat_name ?></h2>
    <div class="des">
        <?php while ($query->have_posts()): $query->the_post() ?>
			<?php global $more ?>
			<?php $more = 0 ?>
            <?php the_content('') ?>
            <p><a href="<?php echo get_permalink(get_the_ID()) ?>" class="readmore">View more</a></p>
        <?php endwhile; ?>
        <?php wp_reset_postdata() ?>
        <div class="clear"></div>
    </div>

    <!-- Testimonials -->
    <?php global $more; ?>
    <?php $page = get_page_by_path('testimonials') ?>
    <?php $morestring = '<!--more-->'; ?>
    <?php $testimonials_content = explode($morestring, $page->post_content); ?>
    <h2><?php echo $page->post_title; ?></h2>
    <div class="des" id="testimonials">
        <?php $more = 0 ?>
        <?php echo $testimonials_content[0]; ?>
        <p><a href="<?php echo get_permalink($page->ID); ?>" class="readmore">View more</a></p>
    </div>
</div>