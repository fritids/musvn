<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if (post_password_required())
    return;
?>
<div id="comment">
    <?php if (have_comments()) : ?>
        <div id="comment_header">NỘI DUNG PHẢN HỒI</div>
        <?php wpmusvn_list_comments(get_comments('post_id=' . $post->ID), get_option('thread_comments') ? get_option('thread_comments_depth') : '0', 0) ?>
    <?php endif; ?>
    <?php wpmusvn_comment_form() ?>
</div>