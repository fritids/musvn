<?php

ini_set('display_errors', 1);

if (php_sapi_name() != 'cli')
    die('Died in the website');

require_once( dirname(__FILE__) . '/wp-load.php' );
require_once( dirname(__FILE__) . '/wp-admin/includes/media.php' );
require_once( dirname(__FILE__) . '/wp-admin/includes/file.php' );
require_once( dirname(__FILE__) . '/wp-admin/includes/image.php' );
require_once( dirname(__FILE__) . '/wp-admin/includes/taxonomy.php' );

/* Get Attachment ID From Image Source */

function get_attachment_id_from_src($image_src) {
    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
    $id = $wpdb->get_var($query);
    return $id;
}

/* Get Image Source from Img Tag */

function get_image_src_from_img_tag($img_tag) {
    $dom = new DOMDocument();
    $dom->loadHTML($img_tag);
    return $dom->getElementsByTagName('img')->item(0)->getAttribute('src');
}

/* Recursive Insert Category and Articles into Database	 */

function recursive_insert($categories, $parent_id) {
    foreach ($categories as $parent) {
        $category_id = wp_create_category($parent['CategoryName'], $parent_id);
        If (is_array($parent['Articles']) && $category_id != 0) {
            echo 'Inserted category ' . $parent['CategoryName'] . PHP_EOL;
            foreach ($parent['Articles'] as $article) {
                $post_id = wp_insert_post(array(
                    'post_title' => $article['Title'],
                    'post_content' => html_entity_decode($article['Content']),
                    'post_excerpt' => $article['Summary'],
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_date' => date('Y-m-d H:i:s', strtotime($article['Createdate']))
                ));
                If ($post_id != 0) {
                    add_post_meta($post_id, 'post_views_count', $article['Solandoc'], true) || update_post_meta($post_id, 'post_views_count', $article['Solandoc']);
                    wp_set_post_terms($post_id, array($category_id), 'category');
                    $thumbnail_tag = media_sideload_image('http://manutd.com.vn/Portals/0/news/' . $article['ImagePath'], $post_id);
                    If (!is_wp_error($thumbnail_tag)) {
                        $attachment_src = get_image_src_from_img_tag($thumbnail_tag);
                        If (set_post_thumbnail($post_id, get_attachment_id_from_src($attachment_src))) {
                            echo 'Inserted image ' . $attachment_src . PHP_EOL;
                        }
                    }
                    echo 'Inserted post ' . $post_id . PHP_EOL;
                }
            }
        }
        If (is_array($parent['Children']))
            recursive_insert($parent['Children'], $category_id);
    }
}

//Establish SQLSERVER connection
$connectionInfo = array(
    'Database' => 'MUSVN_HomeV2',
    'UID' => 'sa',
    'PWD' => 'musvn@2010',
    'CharacterSet' => 'utf-8',
    'ReturnDatesAsStrings' => true
);
$conn = sqlsrv_connect('MUSVN\SQLEXPRESS', $connectionInfo);

if ($conn === false) {
    echo 'Connection could not be established' . PHP_EOL;
    die(print_r(sqlsrv_errors(), true));
}

//Fetch all categories and place them into a tree
$node_list = array();
$article_list = array();
$category_tree = array();
$sql = "SELECT ALL CategoryID, CategoryName, ParentId FROM NV_NewsCategories ORDER BY ParentId";
$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    echo 'Error in query preparation/execution.' . PHP_EOL;
    die(print_r(sqlsrv_errors(), true));
}

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $node_list[$row['CategoryID']] = array_merge($row, array('Children' => array()));
    $node_list[$row['CategoryID']] = array_merge($row, array('Articles' => array()));
}
sqlsrv_free_stmt($stmt);

$sql = "SELECT ALL CategoryId, Title, ImagePath, Summary, Content, Solandoc, Createdate FROM NV_News";
$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    echo 'Error in query preparation/execution.' . PHP_EOL;
    die(print_r(sqlsrv_errors(), true));
}
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $article_list[] = $row;
}
sqlsrv_free_stmt($stmt);

foreach ($node_list as $nodeId => &$node) {
    foreach ($article_list as &$article) {
        if ($article['CategoryId'] == $nodeId) {
            $node_list[$nodeId]['Articles'][] = &$article;
        }
    }
    if (!$node['ParentId'] || !array_key_exists($node['ParentId'], $node_list)) {
        $category_tree[] = &$node;
    } else {
        $node_list[$node['ParentId']]['Children'][] = &$node;
    }
}

unset($node);
unset($node_list);
unset($article_list);

/* Insert and output progress to screen */
recursive_insert($category_tree, 0);

// Tidy up
sqlsrv_close($conn);
?>