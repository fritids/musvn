<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 */
get_header();
$wpmusvn_options = get_option('wpmusvn_theme_options');
?>

<div id="top_news">
    <div id="scrollingText">
        <?php $query = new WP_Query('post_type=post&post_status=publish&posts_per_page=' . ($wpmusvn_options['posts_in_scroll_category'] ? $wpmusvn_options['posts_in_scroll_category'] : 10) . '&paged=1&cat=' . $wpmusvn_options['scroll_category']); ?>
        <?php while ($query->have_posts()) : $query->the_post() ?>
            <p><span style="font-size:10px;">>> </span><a href="<?php the_permalink() ?>"><?php the_title() ?></a></p>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</div>

<div class="float_left" id="left">
    <div id="slide">
        <div id="slide_wrapper" class="float_left">
            <div id="slide_container">
                <?php $query->query('post_type=post&post_status=publish&posts_per_page=' . ($wpmusvn_options['posts_in_big_image_category'] ? $wpmusvn_options['posts_in_big_image_category'] : 5) . '&paged=1&cat=' . $wpmusvn_options['big_image_category']) ?>
                <?php while ($query->have_posts()) : $query->the_post() ?>
                    <div class="slide_content">
                        <img src="<?php echo @reset(wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')) ?>" width="472" height="300" />
                        <div class="slide_description">
                            <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                            <p><?php the_excerpt() ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            <div id="slide_paging"></div>
        </div>

        <div class="float_left">
            <ul class="idTabs" id="tab1"> 
                <li><a href="#tab_newest_news">Tin mới nhất</a></li> 
                <li class="last_child"><a href="#tab_most_view_news">Tin đọc nhiều</a></li> 
            </ul> 
            <div class="clear"></div>
            <div id="tab_newest_news" class="tab1">
                <ul class="red_list">
                    <?php $query->query('post_type=post&post_status=publish&orderby=date&order=DESC&posts_per_page=' . ($wpmusvn_options['top_x_newest_post'] ? $wpmusvn_options['top_x_newest_post'] : 10) . '&paged=1') ?>
                    <?php while ($query->have_posts()) : $query->the_post() ?>
                        <li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </ul>
            </div> 
            <div id="tab_most_view_news" class="tab1">
                <ul class="red_list">
                    <?php $query->query('post_type=post&post_status=publish&meta_key=post_views_count&orderby=meta_value_num&order=DESC&posts_per_page=' . ($wpmusvn_options['top_x_most_read_post'] ? $wpmusvn_options['top_x_most_read_post'] : 10) . '&paged=1') ?>
                    <?php while ($query->have_posts()) : $query->the_post() ?>
                        <li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </ul>
            </div>
        </div>

        <div class="clear"></div>
    </div>

    <div class="red_title_block">
        <div class="title" style="position: relative;">
            <h3><a href="<?php echo get_category_link($wpmusvn_options['feature_category']) ?>">TIN TIÊU ĐIỂM</a></h3>
            <div id="hot_news_navigation">
                <div id="hot_news_left" class="float_left"></div>
                <div id="hot_news_paging" class="float_left"></div>
                <div id="hot_news_right" class="float_left"></div>
            </div>
        </div>
        <div id="hot_news_slide">
            <?php $query->query('post_type=post&post_status=publish&orderby=date&order=DESC&posts_per_page=' . ($wpmusvn_options['posts_in_feature_category'] ? $wpmusvn_options['posts_in_feature_category'] : 10) . '&paged=1&cat=' . $wpmusvn_options['feature_category']) ?>
            <?php while ($query->have_posts()) : $query->the_post() ?>
                <?php if ($query->current_post % 5 == 0): ?>
                    <div class="description">
                    <?php endif; ?>
                    <div class="list_article <?php echo (($query->current_post + 1) % 5 == 0) ? 'last_child' : '' ?>">
                        <p><a href="<?php the_permalink() ?>"><img src="<?php echo @reset(wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')) ?>" width="126" height="87" /></a></p>
                        <p><a href="<?php the_permalink() ?>"><?php the_title() ?></a></p>
                    </div>
                    <?php if (($query->current_post + 1) % 5 == 0): ?>
                        <div class="clear"></div>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>

    <?php dynamic_sidebar('middle-sidebar-1') ?>

    <div class="main_category_article">
        <?php foreach ($wpmusvn_options['area_one_categories'] as $cat_id): ?>
            <?php $i++ ?>
            <?php $query->query('post_type=post&post_status=publish&cat=' . $cat_id . '&posts_per_page=' . (($wpmusvn_options['small_posts_per_category_at_home_page'] ? $wpmusvn_options['small_posts_per_category_at_home_page'] : 3) + 1) . '&paged=1') ?>        
            <div class="category <?php echo ($i % 2 == 0) ? "right" : "left" ?>">
                <div class="category_label float_left"></div>
                <div class="big_title float_left">
                    <h4><a href="<?php echo get_category_link($cat_id) ?>"><?php echo get_category($cat_id)->name ?></a></h4>
                </div>
                <div class="clear"></div>
                <div class="article">
                    <?php while ($query->have_posts()) : $query->the_post() ?>
                        <?php if ($query->current_post == 0): ?>
                            <a href="<?php the_permalink() ?>" class="article_img float_left"><img src="<?php echo @reset(wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail')) ?>" width="107" height="91" /></a>
                            <div class="article_content float_left">
                                <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                                <p><?php echo wp_trim_words(get_the_excerpt(), 24) ?></p>
                                <p class="article_date"><?php the_time('F j, Y') ?></p>
                            </div>
                            <div class="clear"></div>
                            <hr />
                            <ul class="older_article red_list">
                            <?php else: ?>
                                <li><a href="<?php the_permalink() ?>"><?php echo wp_trim_words(get_the_title(), 9) ?></a></li>
                            <?php endif; ?>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </ul>
                </div>
            </div>
            <?php if ($i % 2 == 0 || $i == count($wpmusvn_options['area_one_categories'])): ?>
                <div class="clear"></div>
                <div class="height10"></div>
            <?php endif; ?>
        <?php endforeach; ?>            

        <?php dynamic_sidebar('middle-sidebar-2') ?>

        <div class="height10"></div>

        <?php foreach ($wpmusvn_options['area_two_categories'] as $cat_id): ?>
            <?php $j++ ?>
            <?php $query->query('post_type=post&post_status=publish&cat=' . $cat_id . '&posts_per_page=' . (($wpmusvn_options['small_posts_per_category_at_home_page'] ? $wpmusvn_options['small_posts_per_category_at_home_page'] : 3) + 1) . '&paged=1') ?>        
            <div class="category <?php echo ($j % 2 == 0) ? "right" : "left" ?>">
                <div class="category_label float_left"></div>
                <div class="big_title float_left">
                    <h4><a href="<?php echo get_category_link($cat_id) ?>"><?php echo get_category($cat_id)->name ?></a></h4>
                </div>
                <div class="clear"></div>
                <div class="article">
                    <?php while ($query->have_posts()) : $query->the_post() ?>
                        <?php if ($query->current_post == 0): ?>
                            <a href="<?php the_permalink() ?>" class="article_img float_left"><img src="<?php echo @reset(wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail')) ?>" width="107" height="91" /></a>
                            <div class="article_content float_left">
                                <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                                <p><?php echo wp_trim_words(get_the_excerpt(), 24) ?></p>
                                <p class="article_date"><?php the_time('F j, Y') ?></p>
                            </div>
                            <div class="clear"></div>
                            <hr />
                            <ul class="older_article red_list">
                            <?php else: ?>
                                <li><a href="<?php the_permalink() ?>"><?php echo wp_trim_words(get_the_title(), 9) ?></a></li>
                            <?php endif; ?>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </ul>
                </div>
            </div>
            <?php if ($j % 2 == 0 || $j == count($wpmusvn_options['area_two_categories'])): ?>
                <div class="clear"></div>
                <div class="height10"></div>
            <?php endif; ?>
        <?php endforeach; ?>   
    </div>
</div>

<div class="float_left">
    <div id="right">
        <?php dynamic_sidebar('home-right-sidebar') ?>
    </div>
</div>

<div class="clear"></div>

<div class="height10"></div>

<div class="black_title_block">
    <div class="title">
        <h3><a href="<?php get_category_link($wpmusvn_options['image_category']) ?>"><?php echo get_category($wpmusvn_options['image_category'])->name ?></a></h3>
    </div>
    <div class="description">
        <?php $query->query('post_type=post&post_status=publish&cat=' . $wpmusvn_options['image_category'] . '&posts_per_page=7&paged=1') ?>
        <?php while ($query->have_posts()) : $query->the_post() ?>
            <div class="list_article">
                <p><a href="<?php the_permalink() ?>"><img src="<?php echo @reset(wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail')) ?>" width="118" height="87" /></a></p>
                <p><a href="<?php the_permalink() ?>"><?php echo wp_trim_words(get_the_title(), 10) ?></a></p>
            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
        <div class="clear"></div>
    </div>
</div>

<?php get_footer(); ?>
