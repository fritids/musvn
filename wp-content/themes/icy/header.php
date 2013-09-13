<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xmlns:fb="https://www.facebook.com/2008/fbml">
    <head>
        <title><?php bloginfo('name') ?></title>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="<?php bloginfo('template_url') ?>/images/favicon.ico" />
        <link href="<?php bloginfo('template_url') ?>/css/reset.css" rel="stylesheet" type="text/css" />
        <link href="<?php bloginfo('template_url') ?>/css/960_24_col.css" rel="stylesheet" type="text/css" />
        <link href="<?php bloginfo('template_url') ?>/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php bloginfo('template_url') ?>/css/shadowbox.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="header_wrapper">
            <div class="container_24">
                <div class="grid_24" id="header">
                    <div class="grid_8 alpha" id="header_left">
                        <ul id="logo_wrapper">
                            <li>
                                <img id="logo" src="<?php bloginfo('template_url') ?>/images/logo.png" alt="Logo Icy" onclick="window.location='/';"/>
                                <ul id="dropmenu">
                                    <li class="dropmenu_border"></li>
                                    <?php $query = new WP_Query('category_name=product-gallery') ?>
                                    <?php while ($query->have_posts()): $query->the_post() ?>
                                        <li><a href="<?php echo get_permalink(get_the_ID()) ?>" class="<?php echo (get_the_ID() == get_query_var('p')) ? "current" : "" ?>"><?php the_title() ?></a></li>
                                    <?php endwhile; ?>
                                    <?php wp_reset_postdata(); ?>
                                    <li class="dropmenu_border"></li>
                                </ul>
                                <div id="dropmenu_bottom"></div>
                            </li>
                        </ul>

                    </div>

                    <div class="grid_16 omega" id="header_right">
                        <div class="grid_13 alpha">
                            <h1 id="title"><span>ICY - CAKE &amp; ICE CREAM</span></h1>
                        </div>

                        <div class="grid_3 omega" id="social_network">
                            <a href="" class="social_network grid_1 alpha" id="fb">Facebook</a>
                            <a href="" class="social_network grid_1" id="tw">Twitter</a>
                            <a href="" class="social_network grid_1 omega" id="rss">Rss</a>
                        </div>

                        <div class="grid_16 alpha omega">
                            <ul class="menu" id="top_menu">
                                <?php wp_nav_menu('menu=main-menu&items_wrap=%3$s&container=') ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>