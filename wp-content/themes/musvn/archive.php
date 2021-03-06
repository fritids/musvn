<?php
get_header();
$wpmusvn_options = get_option('wpmusvn_theme_options');
?>
<div class="main">
    <div class="float_left" id="left">
        <div class="white_box">
            <div class="main_category_article">
                <div class="category_label float_left"></div>
                <div class="big_title float_left full_width_title">
                    <h4><?php single_cat_title('', true) ?></h4>
                </div>
                <div class="clear"></div>

                <?php $query = new WP_Query('post_type=post&post_status=publish&cat=' . get_query_var('cat') . '&posts_per_page=1&paged=1') ?>
                <?php $post_ids = array(); ?>
                <?php while ($query->have_posts()) : $query->the_post() ?>
                    <?php $post_ids[] = get_the_ID(); ?>
                    <div class="big_news">
                        <a href="<?php the_permalink() ?>" class="big_news_img float_left"><img src="<?php echo @reset(wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')) ?>" width="260" height="170" /></a>
                        <div class="big_news_desc">
                            <p><a href="<?php the_permalink() ?>" class="big_news_title"><?php the_title() ?></a></p>
                            <p class="big_news_date">Ngày cập nhật: <?php the_time('d/m/Y') ?></p>
                            <p><?php the_excerpt() ?></p>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>

                <?php $paged = get_query_var('paged') ? (int) get_query_var('paged') : 1 ?>
                <?php $posts_per_page = $wpmusvn_options['small_posts_per_category'] ? (int) $wpmusvn_options['small_posts_per_category'] : 6 ?>
                <?php $query->query(array('posts_per_page' => $posts_per_page, 'post__not_in' => $post_ids, 'post_type' => 'post', 'post_status' => 'publish', 'cat' => get_query_var('cat'), 'paged' => $paged)) ?>
                <?php while ($query->have_posts()) : $query->the_post() ?>
                    <div class="normal_news">
                        <a href="" class="normal_news_img float_left"><img src="<?php echo @reset(wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail')) ?>" width="120" height="90" /></a>
                        <div class="normal_news_desc">
                            <p><a href="<?php the_permalink() ?>" class="normal_news_title"><?php the_title() ?></a></p>
                            <p class="normal_news_date">Ngày cập nhật: <?php the_time('d/m/Y') ?></p>
                            <p><?php the_excerpt() ?></p>
                            <p class="readmore"><a href="<?php the_permalink() ?>">Xem tiếp</a></p>
                            <p class="clear"></p>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>

                <script type="text/javascript">
                    jQuery(document).ready(function() {
                        jQuery("#goToPage").change(function() {
                            if (jQuery(this).val() !== '') {
                                window.location.href = jQuery(this).val();
                            }
                        });
                        <?php if ($paged > 1): ?>
                            jQuery("#goPrevious").click(function() {
                                window.location.href = '<?php echo add_query_arg('paged', $paged - 1) ?>';
                            });
                        <?php endif; ?>
                        <?php if ($paged < $query->max_num_pages): ?>
                            jQuery("#goNext").click(function() {
                                window.location.href = '<?php echo add_query_arg('paged', $paged + 1) ?>';
                            });
                        <?php endif; ?>
                    });
                </script>
                <div class="news_paging">
                    <a href="<?php echo get_category_feed_link(get_query_var('cat')) ?>" class="float_left rss"><img src="<?php echo get_template_directory_uri() ?>/images/rss.jpg" width="20" height="20" /></a>
                    <div class="paging float_right">
                        <span class="float_left">Trang</span>
                        <select id="goToPage" class="float_left">
                            <?php for ($i = 1; $i <= $query->max_num_pages; $i++):
                                ?>
                                <option value="<?php echo add_query_arg('paged', $i) ?>" <?php echo ($i == $paged) ? 'selected = selected' : '' ?>><?php echo $i ?></option>
                            <?php endfor; ?>
                        </select>
                        <?php if ($paged > 1): ?>
                            <button id="goPrevious" class="float_left">Trang trước</button>
                        <?php endif; ?>
                        <?php if ($paged < $query->max_num_pages): ?>
                            <button id="goNext" class="float_right">Trang sau</button>
                        <?php endif; ?>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- end #left -->

    <div class="float_left">
        <div id="sidebar">
            <?php dynamic_sidebar('news-right-sidebar'); ?>
            <div style="margin-top: 0px;padding: 5px; width: 242px;background: #000; position: relative; top: 0" id="banneradv1">
                <?php dynamic_sidebar('news-float-right-sidebar') ?>
            </div>
        </div>
    </div>

    <div class="clear"></div>

    <!-- end #right -->
</div>
<?php get_footer(); ?>
