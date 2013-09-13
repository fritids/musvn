function randomString() {
    var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
    var string_length = 8;
    var randomstring = '';
    for (var i=0; i<string_length; i++) {
        var rnum = Math.floor(Math.random() * chars.length);
        randomstring += chars.substring(rnum,rnum+1);
    }
    return randomstring;
}

(function ($) {
    
    $.fn.submitNormalForm = function(params) {
        
        var submitBtn = $(this);
        submitBtn.attr('disabled', true);
        params.preloader.show();
        
        $.ajax({
            url: params.formId.attr('action'),
            type: 'POST',
            data: params.formId.getPostData(),
            success: function(data) {
                submitBtn.attr('disabled', false);
                params.preloader.hide();
                var dataObj = $.parseJSON(data);
                $(params.messageHandle).empty();
                if(dataObj.errors) {
                    $(params.messageHandle).removeClass('success_message').addClass('error_message');
                    $.each(dataObj.errors, function(k,v) {
                        $(params.messageHandle).append('<p>'+v+'</p>');
                    });
                    $(params.messageHandle).fadeOut();
                    $(params.messageHandle).fadeIn();
                    window.location = params.messageHandle;
                } else if(dataObj.success) {
                    $(params.messageHandle).removeClass('error_message').addClass('success_message');
                    $(params.messageHandle).append('<p>'+dataObj.success+'</p>');
                    $(params.messageHandle).fadeOut();
                    $(params.messageHandle).fadeIn();
                    window.location = params.messageHandle;
                } else if(dataObj.url) {
                    window.location = dataObj.url;
                }
            }
        });
    };
    
    $.fn.getPostData = function() {
        var o = {};
        var data = $(this).serializeArray();
        $.each(data, function() {
            if (o.hasOwnProperty(this.name)) {
                o[this.name] = $.makeArray(o[this.name]);
                o[this.name].push(this.value);
            } else {
                o[this.name] = this.value;
            }
        });
        return o;
    };
    
    $.fn.countDown = function(settings,to) {
        settings = jQuery.extend({
            startFontSize: "36px",
            endFontSize: "36px",
            duration: 1000,
            startNumber: 10,
            endNumber: 0,
            callBack: function() { }
        }, settings);
        return this.each(function() {
    
            //where do we start?
            if(!to && to != settings.endNumber) {
                to = settings.startNumber;
            }
    
            //set the countdown to the starting number
            jQuery(this).text(to).css("fontSize",settings.startFontSize);
    
            //loopage
            jQuery(this).animate({
                fontSize: settings.endFontSize
            }, settings.duration, "", function() {
                if(to > settings.endNumber + 1) {
                    jQuery(this).css("fontSize", settings.startFontSize).text(to - 1).countDown(settings, to - 1);
                }
                else {
                    settings.callBack(this);
                }
            });
        
        });
    };
                
    $(".count_down").countDown({
        startNumber: 6,
        callBack: function(me) {
            window.location = $(me).attr('rel');
        }
    });
                
    $.fn.ss_modal = function(params) {
                    
        params = $.extend({
            modalElement:$('#ss_modal'),
            overlayElement:$('#ss_overlay'),
            preloaderElement:$('#ss_modal_preloader'),
            ajaxSelectorClass: 'ss_modal',
            submitModalForm: 'submit_modal',
            submitPreloader: 'sspreloader'
        } , params);
                    
        var p = params;
        $('.'+p.ajaxSelectorClass).live('click',function() {
            var href = $(this).attr('href');
            p.preloaderElement.css({
                'margin-left': -(p.preloaderElement.width() / 2) + "px"
            });
            if(p.modalElement.is(":visible")) {
                p.modalElement.fadeOut();
                p.modalElement.html('');
            } else {
                p.overlayElement.fadeTo(200, 0.9);
            }
                            
            p.preloaderElement.show();
                            
            $.ajax({
                async: false,
                url: href,
                success: function(data){
                    p.modalElement.html(data);
                    p.modalElement.css({
                        "margin-left": -($('#ss_modal').width() / 2) + "px"
                    });
                    p.preloaderElement.hide();
                    p.modalElement.fadeIn();
                                
                    $('#'+p.submitModalForm).click(function() {
                        var actionUrl = $('#modal_form').attr('action');
                        $('#'+p.submitPreloader).css('visibility','visible');
                        var postData = {};
                        $('#modal_form input').each(function(){
                            postData[$(this).attr('name')] = $(this).val();
                        });
                        $.ajax({
                            type: 'POST',
                            url: actionUrl,
                            data: postData,
                            success: function(data) {
                                var dataObj = $.parseJSON(data);
                                $('#modal_message').empty();
                                if(dataObj.errors) {
                                    $('#modal_message').removeClass('success_message');
                                    $('#modal_message').addClass('error_message');
                                    $.each(dataObj.errors, function(k,v){
                                        $('#modal_message').append('<p>'+v+'</p>');
                                    });
                                } else if(dataObj.success) {
                                    $('#modal_message').removeClass('error_message');
                                    $('#modal_message').addClass('success_message');
                                    $('#modal_message').append('<p>'+dataObj.success+'</p>');
                                }
                                $('#modal_message').fadeOut();
                                $('#modal_message').fadeIn();
                                $('#'+p.submitPreloader).css('visibility','hidden');
                                if(dataObj.waitToClose) {
                                    setTimeout(function(){
                                        p.overlayElement.trigger('click')
                                    }, 5000);
                                } else if(dataObj.noWaitToClose) {
                                    p.overlayElement.trigger('click');
                                    if(dataObj.login) {
                                        $('#welcome_text').html(dataObj.login);
                                        if($('#normal_form_message').is(':visible')) {
                                            $('#normal_form_message').fadeOut();
                                        }
                                    }
                                }
                            }
                        });
                    });
                }
            });
            return false;
        });
                        
        p.overlayElement.click(function(){
            p.modalElement.fadeOut(function(){
                p.overlayElement.fadeOut(function(){
                    p.modalElement.html('');
                });
            });
        });
    };
})(jQuery);


$(window).load(function() {
            
    Shadowbox.init({
        overlayOpacity: 0.9
    });
            
    $('.ss_modal').ss_modal();
                
    $('textarea.tinymce').tinymce({
        // Location of TinyMCE script
        script_url : '/interfaces/admin/templates/default/js/tinymce/jscripts/tiny_mce/tiny_mce.js',

        // General options
        theme : "advanced",
        plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect,bullist,numlist,link,unlink,anchor,image,forecolor",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : "",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,
        
        //width: "880",
        
        file_browser_callback: 'openKCFinder'
                
    });
                
    $('#submit_product_form').click(function() {
        $(this).submitNormalForm({
            'preloader': $('#product_form_preloader'),
            'formId': $('#productFrm'),
            'messageHandle': '#normal_form_message'
        });
    });
    
    $('#change_info').click(function(){
        $(this).submitNormalForm({
            'preloader': $('#change_info_preloader'),
            'formId': $('#change_info_form'),
            'messageHandle': '#normal_form_message'
        });
    });
                
    $('.file_manager').click(function() {
        var textBoxObj = $(this).prev();
        window.KCFinder = {
            callBack: function(url) {
                window.KCFinder = null;
                textBoxObj.val(url);
            }
        };
        window.open('/interfaces/admin/templates/default/js/kcfinder-2.51/browse.php?type=files&p=5ceab53d456bb928e6b790d163d52a6f', 'kcfinder_textbox','status=0, toolbar=0, location=0, menubar=0, directories=0, resizable=1, scrollbars=0, width=800, height=600');
    });
                
    var mouse_is_inside = false;
    $('#list_categories').hover(function(){ 
        mouse_is_inside=true; 
    }, function(){ 
        mouse_is_inside=false; 
    });
    $('#load_all_categories span').click(function() {
                    
        if($('#list_categories').is(':visible')) {
            $('#list_categories').fadeOut();
            return false;
        }
                    
        $('#load_all_categories_preloader').show();
        if($('#list_categories').is(':empty') == false) {
            $('#list_categories ul').hide();
            $('#list_categories').fadeIn();
            $('#list_categories>li:first ul').fadeIn();
            $('#list_categories>li:first>a').addClass('hover');
            $('#load_all_categories_preloader').hide();
            return false;
        }
        $.ajax({
            url: '/ajax.php?rt=products/loadAllCategories',
            success: function(data){
                $('#list_categories').html(data);
                $('#list_categories').fadeIn();
                $('#list_categories>li:first ul').fadeIn();
                $('#list_categories>li:first>a').addClass('hover');
                $('#load_all_categories_preloader').hide();
                            
                $("body").mouseup(function() { 
                    if(! mouse_is_inside) {
                        $('#list_categories').hide();
                        $('#list_categories ul').hide();
                        $('#list_categories>li>a').removeClass('hover');
                    }
                });
                var zIndex = 0;
                $('#list_categories>li>a').mouseover(function() {
                    $('#list_categories>li>a').removeClass('hover');
                    $(this).addClass('hover');
                    if($(this).next().length>0) {
                        zIndex++;
                        $(this).next().stop().show();
                        $(this).next().css('z-index',zIndex);
                    } else {
                        $('#list_categories ul').stop().hide();
                    }
                }).mouseout(function() {
                    //$(this).next().stop().hide();
                    });
            }
        });
        var zIndex = 0;
        $('#list_categories>li>a').mouseover(function() {
            if($(this).next().length>0) {
                zIndex++;
                $(this).next().stop().show();
                $(this).next().css('z-index',zIndex);
            }
        }).mouseout(function(){
            //$(this).next().stop().hide();
            //$('#list_categories ul').stop().hide();
            });
    });
    
                
    /* scrolling paging */
    if($('#list_product').length > 0) {
        var itemRef = $('#list_product').attr('itemref');
        var process_paging = 0;
        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() == $(document).height()) {
                var sum_product = $('#list_product .list_product').length;
                if(process_paging == 1) {
                    return;
                }
                process_paging = 1;
                $('#scrolling_paging_preloader').show();
                var url = '/ajax.php?rt=products/get_more_products/'+sum_product+'/' + itemRef;
                if($('#list_product').hasClass('search_result')) {
                    url = '/ajax.php?rt=search/get_more_products/'+sum_product+'/' + itemRef;
                }
                $.ajax({
                    type: 'GET',
                    async: false,
                    dataType: "html",
                    url:url,
                    success: function(data) {
                        if(data == '0' || data == '') {
                            $('#scrolling_paging_preloader').hide();
                            process_paging = 1;
                        } else {
                            var randomStr = randomString();
                            $('#list_product .clear').before('<div id="'+randomStr+'"></div>');
                            $('#'+randomStr).hide();
                            $('#'+randomStr).html(data);
                            setTimeout(function(){
                                $('#scrolling_paging_preloader').hide();
                                $('#'+randomStr).fadeIn();
                            }, 1000);
                            //sum_product = $('#list_products .list_product').length;
                            process_paging = 0;
                        }
                    },
                    complete: function() {
                                    
                    }
                });
            }
        });
    }
                
    document.getElementById('search').onkeydown = function(e){
        e = e || window.event;
        if('13' == (e.which || e.keyCode)) $('#search_btn').trigger('click');
    }
                
    $('#search_btn').click(function() {
        var search_val = $('#search').val();
                    
        if(search_val.replace(/ /g,'') != '') {
            window.location = '/search/'+search_val+'.htm';
        } else {
            alert('Vui lòng điền từ khóa tìm kiếm');
        }
    });
                
    $('#newsletterBtn').click(function() {
        var preloader = $(this).next();
        preloader.show();
        var post_data = {};
        post_data['email'] = $('#newsletter input').val();
        $.ajax({
            type: 'POST',
            data: post_data,
            url: '/ajax.php?rt=common/newsletter',
            success: function(data){
                alert(data);
                preloader.hide();
            }
        });
    });
                
    $('#list_suggest_products').cycle();

    $('#list_suggest_products').fadeIn();
});
            
function openKCFinder(field_name, url, type, win) {
    tinyMCE.activeEditor.windowManager.open({
        file: '/interfaces/admin/templates/default/js/kcfinder-2.51/browse.php?opener=tinymce&type=files&p=5ceab53d456bb928e6b790d163d52a6f',
        title: 'KCFinder',
        width: 700,
        height: 500,
        resizable: "yes",
        inline: true,
        close_previous: "no",
        popup_css: false
    }, {
        window: win,
        input: field_name
    });
    return false;
}
