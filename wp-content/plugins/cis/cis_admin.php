<?php 

if( isset( $_POST[ 'ok' ] ) ) {
    //TODO: must make input data to be cleared first before update to database
    update_option( 'censored_string', $_POST[ 'censored_string' ] );
    update_option( 'illegal_words', $_POST[ 'illegal_words' ] );
    echo '<div class="updated"><p><strong>Save successfully</strong></p></div>';
}
$censored_string = get_option( 'censored_string' );
$illegal_words = get_option( 'illegal_words' );
?>

<!-- TODO: must separate this css part to a file -->
<style>
    .fl{float: left;}
    .clear{clear: both;}
    .block{display: block;}
    label{padding-top: 5px; width: 150px;}
    textarea{width: 600px; height:150px;}
    .height10{height: 10px}
    form{margin-top: 20px;}
</style>

<div class="wrap">  
    <h2>Censored illegal string</h2>
      
    <form name="censored_comment_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <label class="fl block"><strong><?php _e("Censored string: " ); ?></strong></label>
        <input class="fl regular-text" type="text" name="censored_string" value="<?php echo $censored_string ?>" />
        <p class="clear height10"></p>

        <label class="fl block"><strong><?php _e("illegal words: " ); ?></strong><br /><em>ex: shit,wtf (Separated by comma)</em></label>
        <textarea class="fl" name="illegal_words" id="illegal_words" rows="5" cols="30"><?php echo $illegal_words ?></textarea>
        <p class="clear height10"></p>

        <label class="fl block"><?php _e("&nbsp;" ); ?></label>
        <button class="button button-primary" name="ok"><?php _e( 'Update' ) ?></button>
    </form>  
</div>  