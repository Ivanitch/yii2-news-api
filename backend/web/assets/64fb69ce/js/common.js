$(document).ready(function(){

    /**==========================
     prettyPrint
     ============================**/
    !function ($) {
        $(function(){
            window.prettyPrint && prettyPrint()
        })
    }(window.jQuery);


    /**==========================
     prettyPrint
     ============================**/
    $('.content_links > li').find('a').addClass('scroll');
    $(function(){
        $("a.scroll").on('click', function(){
            var _href = $(this).attr("href");
            $("html, body").animate({scrollTop: $(_href).offset().top-50+"px"}, 600);
        });
    });


    /**==========================
            Button up
    ============================**/
    var button_up = $('#button-up');
    $(window).scroll (function () {
        if ($(this).scrollTop () > 300) {
            button_up.fadeIn();
        } else {
            button_up.fadeOut();
        }
    });
    button_up.on('click', function(){
        $('body, html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

    /**==========================
            Fixed Nav TODO: Fixed widget
    ============================**/
    var bottomOffset = $("#footer").innerHeight();
    var bottomWidget = $("#widget_fixed").innerHeight() + 70;
    var bottomWidgetRight = $("#widget_fixed_right").innerHeight() + 70;

    $("#widget_fixed").sticky({
        topSpacing: 10,
        bottomSpacing: bottomOffset
    });

    $("#widget_fixed_right").sticky({
        topSpacing: 10,
        bottomSpacing: bottomOffset
    });

    $("#widget_fixed1").sticky({
        topSpacing: bottomWidget,
        bottomSpacing: 0
    });

    /**==========================
     Убираем placeholder из input
     ============================**/
    $('input,textarea').focus(function(){
        $(this).data('placeholder',$(this).attr('placeholder'));
        $(this).attr('placeholder','');
    });
    $('input,textarea').blur(function(){
        $(this).attr('placeholder',$(this).data('placeholder'));
    });

    /**==========================
        Previews
     ============================**/
    $(".article_preview").each(function () {
        $(this).hover(function () {
            $(this).find("a.link").css({
                "color":"#FF9900",
                "border-bottom-color":"rgba(255,165,0,0.5)",
                "transition":".1s"
            });
        }, function () {
            $(this).find("a.link").css({
                "color":"#006cca",
                "border-bottom-color":"rgba(0, 108, 202,0.4)",
                "transition":".2s"
            });
        });
    });
    $(".book_preview").each(function () {
        $(this).hover(function () {
            $(this).find("a.link").css({
                "color":"#FF9900",
                "border-bottom-color":"rgba(255,165,0,0.5)",
                "transition":".2s"
            });
        }, function () {
            $(this).find("a.link").css({
                "color":"#006cca",
                "border-bottom-color":"rgba(0, 108, 202,0.4)",
                "transition":".2s"
            });
        });
    });
    $(".video_preview").each(function () {
        $(this).hover(function () {
            $(this).find("a.link").css({
                "color":"#FF9900",
                "border-bottom-color":"rgba(255,165,0,0.5)",
                "transition":".2s"
            });
            $(this).find("i.fa-youtube-play").css({
                "color":"#FF9900",
                "transition":".2s",
                "opacity":".9"
            });
        }, function () {
            $(this).find("a.link").css({
                "color":"#006cca",
                "border-bottom-color":"rgba(0, 108, 202,0.4)",
                "transition":".2s"
            });
            $(this).find("i.fa-youtube-play").css({
                "color":"#000",
                "transition":".2s",
                "opacity":".3"
            });
        });
    });
    /**==========================
     Button up
     ============================**/
    if ($(window).scrollTop() >= 150) {
        $("#ToTop").fadeIn(400);
        $("#arrows_site").css({
            "background":"rgba(0,0,0,.5)",
            "transition":".5s"
        });
        $(".go-up").css({
            "opacity":"1",
            "transition":".2s"
        });
        $(".go-down").css({
            "opacity":"1",
            "transition":".2s"
        });
    }
    $(window).scroll(function(){
        if ($(window).scrollTop() <= 150) {
            $("#ToTop").fadeOut(400);
            $("#arrows_site").css({
                "background":"#24292e",
                "transition":".3s"
            });
            $(".go-up").css({
                "opacity":".5",
                "transition":".2s"
            });
            $(".go-down").css({
                "opacity":".5",
                "transition":".2s"
            });
        }
        else {
            $("#ToTop").fadeIn(400);
            $("#arrows_site").css({
                "background":"rgba(0,0,0,.5)",
                "transition":".5s"
            });
            $(".go-up").css({
                "opacity":"1",
                "transition":".2s"
            });
            $(".go-down").css({
                "opacity":"1",
                "transition":".2s"
            });
        }
    });

    if ($(window).scrollTop() <= $(document).height()) $("#OnBottom").fadeIn(800);
    $(window).scroll(function(){
        if ($(window).scrollTop() >= $(document).height()) $("#OnBottom").fadeOut(800);
        else $("#OnBottom").fadeIn(800);
    });

    $("#ToTop").click(function(){$("html,body").animate({scrollTop:0}, 800)});
    $("#OnBottom").click(function(){$("html,body").animate({scrollTop:$(document).height()}, 800)});


    /**
     * Показать - скрыть содержание
     */
    function toggleSubjectArticle() {
        var flag = false,
            toggle = $("span#open-close"),
            links = $('#content_links');

        toggle.on('click', function () {
            if (flag === false) {
                links.fadeIn('fast');
                toggle.html('[ свернуть ]');
                flag = true;
            }else {
                links.fadeOut('fast');
                toggle.html('[ развернуть ]');
                flag = false;
            }
        });
    }
    toggleSubjectArticle();


    /**
     * Подсветка пунктов меню в хедере
     */
    var articles = $('li#link-articles-page a'),
        books = $('li#link-books-page a'),
        videos = $('li#link-videos-page a');
    var context = $('ul.breadcrumb').find('li:eq(1)');


    if (context.text() === 'Статьи') {
        articles.css({"color":"#FF9900"});
    }

    if (context.text() === 'Книги') {
        books.css({"color":"#FF9900"});
    }

    if (context.text() === 'Видео') {
        videos.css({"color":"#FF9900"});
    }
    

});// End Ready