$(window).load(function() {
    Shadowbox.init({
        overlayOpacity: 0.9
    });
    
    $('#header_left > ul').dropmenu({
        effect	: 'fade',
        nbsp	: true,
        speed       : 400
    });
    
    Cufon.replace('#title', {
        hover: 'true'
    },{
        fontFamily: 'Myriad Pro Cond'
    });
    
    /* make bg full screen */
    //    var theWindow    = $(window),
    //    $bg              = $("#bg"),
    //    aspectRatio      = $bg.width() / $bg.height();
    //    function resizeBg() {
    //        if ( (theWindow.width() / theWindow.height()) < aspectRatio ) {
    //            $bg
    //            .removeClass()
    //            .addClass('bgheight');
    //        } else {
    //            $bg
    //            .removeClass()
    //            .addClass('bgwidth');
    //        }
    //    }
    //    theWindow.resize(function() {
    //        resizeBg();
    //    }).trigger("resize");
    
    $('#title').show();
    $('#slide img').each(function(){
        $(this).attr('width',$(window).outerWidth());
    });
    
    $(window).resize(function(){
        setTimeout(function(){
            $('#slide').cycle('pause');
            var currentWidth = $('#slide').outerWidth();
            var currentHeight = $('#slide').outerHeight();
            var newWidth = $(window).outerWidth();
            var ratio = newWidth / currentWidth;
            $('#slide, #slide img').css({
                'width':newWidth,
                'height':currentHeight/ratio
            });
        
            $('#slide').cycle('resume');
        }, 500)
    });
    
    $('#slide').cycle();
	
});