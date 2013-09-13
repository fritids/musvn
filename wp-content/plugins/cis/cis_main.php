<?php   
    /* 
    Plugin Name: Censored Illegal String
    Plugin URI:  
    Description: Plugin for censoring illegal words from the comment content 
    Author: Chin Lee
    Version: 1.0 
    Author URI:
    */
   
function cis_admin() {  
    $dir = plugin_dir_path( __FILE__ );
    if( is_file( $dir . 'cis_admin.php' ) && file_exists( $dir . 'cis_admin.php' ) ) {
        include( $dir . 'cis_admin.php' );
    } else {
        echo '<p style="margin-top: 20px;">There are something wrong with the layout file in the plugin, please contact your administrator!</p>';
    }
    
}  
  
function cis_admin_actions() {  
    add_options_page("Censored illegal string", "Censored illegal string", 1, "Censored_illegal_string", "cis_admin");  
}

add_action('admin_menu', 'cis_admin_actions');  

add_action( 'add_meta_boxes', 'censored_meta_box' );

function censored_meta_box()
{
    //TODO: dont need to create a meta box, may be just a simple paragraph or something like this :|
    add_meta_box( 'censored-comment', 'Censored comment', 'show_censored_comment_admin', 'comment', 'normal', 'high' );
}

function show_censored_comment_admin( $comment )  
{  
    $illegalWords       = get_option( 'illegal_words' );
    $censored_string    = get_option( 'censored_string' );
    $illegalWordsArr    = explode( ',', $illegalWords );
    
    //TODO: must optimize later, what if there are alot of illegal words in array? 
    echo str_ireplace( $illegalWordsArr, $censored_string, esc_attr( $comment->comment_content ) );
}

function show_censored_comment( $content ) {
    $illegalWords       = get_option( 'illegal_words' );
    $censored_string    = get_option( 'censored_string' );
    $illegalWordsArr    = explode( ',', $illegalWords );
    
    //TODO: must optimize later, what if there are alot of illegal words in array? 
    return str_ireplace( $illegalWordsArr, $censored_string, $content );
}

add_filter( 'comment_text', 'show_censored_comment', 1000 );