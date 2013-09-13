<?php
/*
 * Template Name: Contact
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
setup_postdata(get_page(get_the_ID()));
?>
<?php get_header() ?>
<div class="container_24">
    <div class="grid_24" id="main_content">
        <div class="grid_24 alpha omega">
            <img src="<?php bloginfo('template_url') ?>/images/header_image.jpg" alt="" />
        </div>

        <div class="clear"></div>

        <div id="columns">
            <div class="grid_15 alpha prefix_1 suffix_1">
                <h1 class="big_title"><span><?php the_title() ?></span></h1>
                <?php the_content() ?>

                <iframe class="grid_15 alpha omega" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=2F+quang+trung+hoan+kiem+ha+noi&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=40.59616,79.013672&amp;ie=UTF8&amp;hq=&amp;hnear=2+Quang+Trung,+H%C3%A0ng+Tr%E1%BB%91ng,+Hoan+Kiem+District,+Hanoi,+Vietnam&amp;t=m&amp;z=14&amp;ll=21.026498,105.850225&amp;output=embed"></iframe>

                <h2 class="second_title">Send an email to us</h2>
                <div class="des">
                    <form action="contact.php" method="post">
                        <label>Your name</label>
                        <input type="text" name="name" class="input_text" />
                        <p class="height10 clear"></p>

                        <label>Email</label>
                        <input type="text" name="email" class="input_text" />
                        <p class="height10 clear"></p>

                        <label>Phone</label>
                        <input type="text" name="phone" class="input_text" />
                        <p class="height10 clear"></p>

                        <label>Title</label>
                        <input type="text" name="title" class="input_text" />
                        <p class="height10 clear"></p>

                        <label>Content</label>
                        <textarea class="input_area" name="content"></textarea>
                        <p class="height10 clear"></p>

                        <label>&nbsp;</label>
                        <button type="submit">Send</button>
                        <p class="height10 clear"></p>
                    </form>
                </div>
            </div>
            <?php get_sidebar() ?>
        </div>

    </div>
</div>
<?php get_footer() ?>