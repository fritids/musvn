function initMenu() {
    jQuery('#menu ul').hide();
    jQuery('#menu li a').click(
            function() {
                jQuery(this).next().slideToggle('normal');
            }
    );
}
jQuery(document).ready(function() {
    initMenu();
});