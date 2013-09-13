$(document).ready(function () {
    $(".submitForm").submit(function () {
        if ($(this).valid()) {
            $('.submitButton').attr("disabled", "disabled");
        }
    });
    
    $(".close").click(function() {
        $(this).parent().fadeTo(200, 0, function() { // Links with the class "close" will close parent
            $(this).slideUp(300);
        });
        return false;
    });
});

var Haivl = {};

Haivl.Facebook = {
    appId: null
};

Haivl.Facebook.init = function (appId) {
    Haivl.Facebook.appId = appId;
    
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=" + appId;
        fjs.parentNode.insertBefore(js, fjs);
    } (document, 'script', 'facebook-jssdk'));
};

Haivl.ListPhoto = {
    isLoading: false,
    page: 1,
    hasNoMore: false,
    sort: null
};

Haivl.ListPhoto.init = function (sort) {
    Haivl.ListPhoto.sort = sort;
    
    $(document).ready(function () {
        $(window).scroll(function () {
            Haivl.ListPhoto.loadMore();
            Haivl.ListPhoto.fixInfoPanel();
        });
    });

    window.fbAsyncInit = function () {
        FB.init({
            appId: Haivl.Facebook.appId,
            status: true,
            cookie: true,
            xfbml: true
        });
        FB.Event.subscribe('edge.create', Haivl.ListPhoto.recount);
        FB.Event.subscribe('edge.remove ', Haivl.ListPhoto.recount);
    };
};

Haivl.ListPhoto.recount = function (response) {
    if (response.toString().indexOf('/photo/') > 0)
        $.post("/photos/countbyurl?url=" + response);
};

Haivl.ListPhoto.loadMore = function() {
    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 50) {
        if (Haivl.ListPhoto.isLoading || Haivl.ListPhoto.hasNoMore)
            return;

        Haivl.ListPhoto.isLoading = true;
        $(".loading").show();
        $.ajax({
            url: "/photos/more?sort=" + Haivl.ListPhoto.sort + "&page=" + (Haivl.ListPhoto.page + 1),
            dataType: "html",
            success: function(data) {
                if (data == "No more")
                    Haivl.ListPhoto.hasNoMore = true;
                else {
                    $("#listEnd").before(data);
                    Haivl.ListPhoto.page++;
                    FB.XFBML.parse();
                }
            },
            error: function() {
            },
            complete: function() {
                Haivl.ListPhoto.isLoading = false;
                $(".loading").hide();
            }
        });
    }
};

Haivl.ListPhoto.fixInfoPanel = function() {
    $(".photoListItem").each(function() {
        var s = $(window).scrollTop();
        var thiss = $(this);
        var info = $(".info", this);
        if (thiss.offset().top - 60 < s && s < thiss.offset().top - 60 + thiss.outerHeight()) {
            if (s + info.outerHeight() < thiss.offset().top + thiss.outerHeight() - 70) {
                info.css({ position: "fixed", top: "70px" });
            } else {
                info.css({ position: "relative", top: "" });
            }
        } else {
            info.css({ position: "relative", top: "" });
        }
    });
};

Haivl.PhotoDetails = {
    photoId: null
};

Haivl.PhotoDetails.init = function (photoId) {
    Haivl.PhotoDetails.photoId = photoId;
    
    window.fbAsyncInit = function () {
        FB.init({
            appId: Haivl.Facebook.appId,
            status: true,
            cookie: true,
            xfbml: true
        });
        FB.Event.subscribe('comment.create', Haivl.PhotoDetails.recount);
        FB.Event.subscribe('comment.remove', Haivl.PhotoDetails.recount);
        FB.Event.subscribe('edge.create', Haivl.PhotoDetails.recount);
        FB.Event.subscribe('edge.remove ', Haivl.PhotoDetails.recount);
    };
};

Haivl.PhotoDetails.recount = function () {
    $.post("/photos/count/" + Haivl.PhotoDetails.photoId);
};