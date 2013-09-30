<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
get_header();
$wpmusvn_options = get_option('wpmusvn_theme_options');
?>

<div class="main">
    <div class="float_left" id="left">
        <div class="white_box">
            <?php while (have_posts()) : the_post() ?>
                <?php wpmusvn_set_post_views(get_the_ID()) ?>
                <h2 class="UTM_Bebas article_title"><?php the_title() ?></h2>
                <div class="toolbox">
                    <span class="float_left">Ngày đăng: <b><?php the_time('G:i - d/m/Y') ?></b></span>
                    <span class="float_left"> | </span>
                    <script>
                        function popupWindow(url, title, w, h) {
                            var left = (screen.width / 2) - (w / 2);
                            var top = (screen.height / 2) - (h / 2);
                            return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
                        }
                    </script>
                    <a href="javascript:popupWindow('<?php echo print_link() ?>', 'Printing', 900, 500)" class="print_icon icon float_left" title="In bài viết">Nút in</a>
                    <span class="float_left">&nbsp;In bài viết</span>
                    <span class="float_left"> | </span>
                    <span class="float_left">Lượt xem: <b><?php echo @reset(get_post_meta(get_the_ID(), 'post_views_count')) ?></b></span>
                    <!-- AddThis Button BEGIN -->
                    <ul class="group_social_icon float_right">
                        <li><a class="addthis_button_facebook"></a></li>
                        <li><a class="addthis_button_twitter"></a></li>
                        <li><a class="addthis_button_email"></a></li>
                        <li><a class="addthis_button_compact"></a></li>
                    </ul>
                    <script type="text/javascript">var addthis_config = {"data_track_addressbar": true};</script>
                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=<?php echo $wpmusvn_options['addthis_profile_id'] ?>"></script>
                    <!-- AddThis Button END -->
                    <div class="clear"></div>
                </div>

                <ul class="brown_list" id="older_article">
                    <?php $tag_ids = wp_get_post_tags(get_the_ID(), array('fields' => 'ids')); ?>
                    <?php
                    $query = new WP_Query(array(
                        'tag__in' => $tag_ids,
                        'post__not_in' => array(get_the_ID()),
                        'posts_per_page' => $wpmusvn_options['related_posts_to_show'] ? $wpmusvn_options['related_posts_to_show'] : 4,
                        'paged' => 1,
                        'caller_get_posts' => 1
                    ));
                    ?>
                    <?php while ($query->have_posts()) : $query->the_post() ?>
                        <li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </ul>

                <div class="news_description">
                    <?php the_content() ?>
                </div>
            <?php endwhile; ?>
            <hr />

            <?php comments_template(); ?>

            <div class="other_news">
                <h5 class="other_news_header"><a href="<?php echo get_category_link(@reset(get_post_ancestors(get_the_ID()))) ?>">Các tin khác</a></h5>
                <?php $query = new WP_Query('cat=' . @reset(get_post_ancestors(get_the_ID())) . '&posts_per_page=' . ($wpmusvn_options['other_posts_per_post'] ? $wpmusvn_options['other_posts_per_post'] : 6) . '&paged=1') ?>
                <?php while ($query->have_posts()) : $query->the_post() ?>
                    <?php if ($query->current_post % 2 == 0): ?>
                        <ul class="red_list">
                            <li class="first_red_list"><a href="<?php the_permalink() ?>"><?php the_title() ?>&nbsp;(<?php the_time('G:i - d/m/Y') ?>)</a></li>
                            <li class="sep"></li>
                        <?php elseif ($query->current_post % 2 == 1): ?>
                            <li class="last_red_list"><a href="<?php the_permalink() ?>"><?php the_title() ?>&nbsp;(<?php the_time('G:i - d/m/Y') ?>)</a></li>
                        <?php endif; ?>
                        <?php if ($query->current_post % 2 == 1 || $query->current_post == ($query->post_count - 1)): ?>
                            <li class="clearfix clear clear_list"></li>
                        </ul>
                    <?php endif; ?>
                <?php endwhile; ?>
                <?php wp_reset_postdata() ?>
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
