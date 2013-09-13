<?php

/* Run the loop for the category page to output the posts.
 * If you want to overload this in a child theme then include a file
 * called loop-category.php and that will be used instead.
 */
$cat_id = get_query_var('cat');
$cat_slug = get_category($cat_id)->slug;
$tpl_suffix = explode('-', $cat_slug);
if (is_array($tpl_suffix) && count($tpl_suffix) > 1):
    get_template_part('category', end($tpl_suffix));
else:
    get_template_part('category', 'default');
endif;
?>

