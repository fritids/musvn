<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 */
$wpmusvn_options = get_option('wpmusvn_theme_options');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" <?php language_attributes(); ?> xmlns:fb="https://www.facebook.com/2008/fbml">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width" />
        <title><?php bloginfo('name') ?></title>
        <?php wp_head(); ?>
        <script type="text/javascript">
            Cufon.replace('.BebasNeue', {
                fontFamily: 'Bebas Neue'
            });
            Cufon.replace('#main_menu a', {
                color: '#fff',
                fontFamily: 'UTM Cafeta',
                hover: {
                    color: '#000'
                }
            });
            Cufon.replace('.UTM_Bebas', {
                fontFamily: 'UTM Bebas'
            });

            jQuery(document).ready(function() {
                
                <?php if(!is_home()): ?>
                // Not home - BEGIN
                jQuery('.other_news ul').each(function() {
                    if (jQuery(this).find('.first_red_list').height() >= jQuery(this).find('.last_red_list').height()) {
                        h = jQuery(this).find('.first_red_list').outerHeight();
                    } else {
                        h = jQuery(this).find('.last_red_list').outerHeight();
                    }
                    jQuery(this).find('.sep').css('height', h + 'px');
                });

                jQuery(window).scroll(function() {
                    if (jQuery(window).scrollTop() > 600) {
                        jQuery('#banneradv1').css({
                            'top': '0px',
                            'position': 'fixed'
                        });
                    } else {
                        jQuery('#banneradv1').css({
                            'top': '0px',
                            'position': 'relative'
                        });
                    }
                });
                // Not home - END
                <?php endif; ?>
                
                <?php if(is_home()): ?>
                // Home - BEGIN
                jQuery("#scrollingText").smoothDivScroll({
                    scrollingHotSpotLeftClass: "top_news_left",
                    scrollingHotSpotRightClass: "top_news_right",
                    autoScrollDirection: "endlessLoopRight",
                    autoScrollInterval: 10,
                    autoScrollStep: 2,
                    mousewheelScrolling: "allDirections",
                    manualContinuousScrolling: true,
                    autoScrollingMode: "onStart"
                });

                jQuery("#scrollingText").bind("mouseover", function() {
                    jQuery(this).smoothDivScroll("stopAutoScrolling");
                }).bind("mouseout", function() {
                    jQuery(this).smoothDivScroll("startAutoScrolling");
                });

                jQuery('#slide_container').cycle({
                    pager: '#slide_paging',
                    pagerAnchorBuilder: function(idx, slide) {
                        return '<a href="#"></a>';
                    }
                });

                jQuery('.black_title_block .list_article').last().addClass('last_child');

                jQuery('#hot_news_slide').cycle({
                    fx: 'scrollHorz',
                    next: '#hot_news_right',
                    prev: '#hot_news_left',
                    pager: '#hot_news_paging'
                });
                // Home - END
                <?php endif; ?>
                
                jQuery('#nav > ul').dropmenu({
                    effect: 'slide',
                    nbsp: true,
                    speed: 200,
                    timeout: 50
                });

                jQuery('#nav  ul  li').first().addClass('first');
                jQuery('#nav  ul  li').last().addClass('last_child');

            });
        </script>
    </head>
    <body>
        <div id="top_menu">
            <div class="container">
                <?php wp_nav_menu(array('theme_location' => 'top-menu', 'container' => '', 'items_wrap' => '<ul class="float_left">%3$s</ul>')) ?>

                <div class="float_right">
                    <form method="get" id="searchform" action="">
                        <input type="text" class="field" name="s" id="s" placeholder="Search" onclick="this.placeholder = ''" onblur="if (this.placeholder == '')
                    this.placeholder = 'Search';" />
                        <input type="submit" class="submit" name="submit" id="searchsubmit" value="Search" />
                    </form>
                </div>

                <div class="clear"></div>
            </div>
        </div>

        <!-- end #top_menu -->

        <div id="header">
            <div class="container">
                <div>
                    <h1 id="manchester_united" class="BebasNeue">
                        <span id="manchester">MANCHESTER</span>
                        <img src="<?php echo get_template_directory_uri() ?>/images/logo.png" alt="Logo Manchester United"/>
                        <span id="united">UNITED</span>
                    </h1>
                    <div class="clear"></div>
                </div>
            </div>
        </div>

        <!-- end #header -->

        <div id="main_menu">
            <div class="container">
                <div id="nav">
                    <?php wp_nav_menu(array('theme_location' => 'main-menu', 'container' => '', 'items_wrap' => '<ul>%3$s</ul>')); ?>
                </div>
            </div> 
        </div>

        <!-- end #main_menu -->

        <div class="container">