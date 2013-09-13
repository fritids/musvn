<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
get_header();
$cat = get_category(get_query_var('cat'));
?>
<div class="container_24">
    <div class="grid_24" id="main_content">
        <div class="grid_24 alpha omega">
            <img src="<?php bloginfo('template_url') ?>/images/header_image.jpg" alt="" />
        </div>

        <div class="clear"></div>

        <div id="columns">
            <div class="grid_15 alpha prefix_1 suffix_1">
                <h1 class="big_title"><span><?php echo $cat->cat_name ?></span></h1>
                <?php $query = new WP_Query('posts_per_page=5&paged=' . get_query_var('page') . '&cat=' . $cat->cat_ID) ?>
                <div class="des">
                    <?php while ($query->have_posts()): $query->the_post() ?>
                        <div class="list_link">
                            <a href="<?php echo get_permalink(get_the_ID()) ?>" class="grid_4 alpha">
                                <?php if (has_post_thumbnail(get_the_ID())): ?>
                                    <img src="<?php echo reset(wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full')) ?>" alt="" />
                                <?php endif; ?>
                            </a>
                            <div>
                                <h2><a href="<?php echo get_permalink(get_the_ID()) ?>"><?php the_title() ?></a></h2>
                                <p><?php the_content() ?></p>
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php endwhile; ?>
                    <?php
                    global $wp_rewrite;
                    $query->query_vars['paged'] > 1 ? $current = $query->query_vars['paged'] : $current = 1;

                    $pagination = array(
                        'base' => @add_query_arg('page', '%#%'),
                        'format' => '',
                        'total' => $query->max_num_pages,
                        'current' => $current,
                        'show_all' => false,
                        'prev_next' => false,
                        'type' => 'list'
                    );

                    if ($wp_rewrite->using_permalinks()) {
                        $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');
                    }

                    if (!empty($query->query_vars['s'])) {
                        $pagination['add_args'] = array('s' => get_query_var('s'));
                    }
                    $pages = paginate_links($pagination);
                    if (count($pages) > 0):
                        ?>
                        
                        <div class="paging">
                            <span id="paging_text">Trang</span>
                            <ul>
                                <!--
                                <li><span class="page-numbers current">1</span></li>
                                <li><a class="page-numbers" href="">2</a></li>
                                <li><a class="page-numbers" href="">3</a></li>
                                <li><a class="page-numbers" href="">4</a></li>
                                -->
                                <?php echo $pages ?>
                            </ul>
                        </div>
                    <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php get_sidebar() ?>
        </div>

    </div>
</div>
<?php get_footer(); ?>