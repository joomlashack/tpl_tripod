(function($) {

    if (singlescrollingpage) {
        var resizeClass = "div.blog > div.category-desc";
        var resizeClass2 = "div.blog > div.items-leading > [class^=leading-]";
        var resizeClass3 = "div.blog > *:not(.clearfix)*:not(.pagination)*:not(h1)*:not(h2)*:not(.items-leading)*:not(.category-desc)*:not(.page-header)*:not(.items-more)*:not(.cat-children)";

        if (!$('div.blog').length) {
            resizeClass = "div.blog-featured > div.category-desc";
            resizeClass2 = "div.blog-featured > div.items-leading > [class^=leading-]";
            resizeClass3 = "div.blog-featured > *:not(.clearfix)*:not(.pagination)*:not(h1)*:not(h2)*:not(.items-leading)*:not(.category-desc)*:not(.page-header)*:not(.items-more)*:not(.cat-children)";
        }
    }


    function setSinglePageTitles() {
        var htoolbar = $('div.wrapper-toolbar').height();
        var htop = $('#header').height() + $('div.wrapper-toolbar').height();

        var c = $(resizeClass).length + $(resizeClass2).length + $(resizeClass3).length;

        if (c > 0) {
            var elems = [];
            var j = 0;

            jQuery('<div/>', {
                    id: 'singlepage_blog_titles_wrapper',
                    class: 'navbar',
                    html: $('div#singlepage_blog_titles').html(),
            })
                    .appendTo('#spanScrollingMenuWrapper');

            $('div#singlepage_blog_titles').html('');

            $('ul li#nav_singlepage_top a').html(singlepage_titles['top']);
            $('ul li#nav_singlepage_pagefirst a').html(singlepage_titles['featured']);
            $('ul li#nav_singlepage_catdesc a').html(singlepage_titles['category_description']);
            $('ul li#nav_singlepage_morearticles a').html(singlepage_titles['more_articles']);
            $('ul li#nav_singlepage_subcategories a').html(singlepage_titles['subcategories']);
            $('ul li#nav_singlepage_pagelast a').html(singlepage_titles['bottom']);

            if ($('#singlepage_pagefirst').length) {
                $('#nav_singlepage_pagefirst').css('display','block');
                $('#singlepage_pagefirst').addClass('singlepage_section');
            }
            if ($('#singlepage_pagelast').length) {
                $('#nav_singlepage_pagelast').css('display','block');
                $('#singlepage_pagelast').addClass('singlepage_section');
            }
            if ($('.category-desc').length) {
                $('#nav_singlepage_catdesc').css('display','block');
                $('.category-desc').addClass('singlepage_section')
                        .attr('id','singlepage_catdesc');
            }
            if ($('.items-more').length) {
                $('#nav_singlepage_morearticles').css('display','block');
                $('.items-more').addClass('singlepage_section')
                        .attr('id','singlepage_morearticles');
            }
            if ($('.cat-children').length) {
                $('#nav_singlepage_subcategories').css('display','block');
                $('.cat-children').addClass('singlepage_section')
                        .attr('id','singlepage_subcategories');
            }

            var ppost = 0;
            $(resizeClass2).each(function (post) {
                $(this).attr('id','singlepage_post_' + ppost)
                        .addClass('singlepage_section');
                ppost++;
            });

            $(resizeClass3).each(function (post) {
                $(this).attr('id','singlepage_post_' + ppost)
                        .addClass('singlepage_section');
                ppost++;
            });

            singlepage_navmenu_scroll_speed = parseInt(singlepage_navmenu_scroll_speed);
            $('#singlepage_blog_titles_wrapper ul li a').click(function () {
                if ($(this).attr('rel') != '')
                    $('html, body').animate({
                        scrollTop: ($(this).attr('rel') == 'top' ? 0 : $('#' + $(this).attr('rel')).offset().top) - htoolbar
                    }, singlepage_navmenu_scroll_speed);
                return false;
            });

            $('#spanRestScrollingMenuWrapper').removeClass('span12').addClass($('#spanRestScrollingMenuWrapper').attr('rel'));
            $('#spanScrollingMenuWrapper').css('display','block');
        }
    }

    function doSinglePageResize() {
        var htoolbar = $('div.wrapper-toolbar').height();
        var hbottommenu = $('div.wrapper-bottom-menu').height();
        var hfooter = $('div.wrapper-footer').height();

        var ho = $(window).height() - htoolbar;
        var c = $('.singlepage_section').length;
        if (c > 0) {
            $('.singlepage_section').each(function (i) {
                if (i == c-1) {
                    $(this).css('min-height');
                    $(this).css('padding-top');
                    var hf = ho - hbottommenu - hfooter;
                    if (hf > 0 && $(this).height() < ho) {
                        var divp = (hf - $(this).height()) / 2;
                        var divh = hf - divp;
                        $(this).css('min-height',divh).css('padding-top',divp);
                    }
                }
                else {
                    $(this).css('min-height');
                    var s = ho-$(this).height();
                    if ($(this).height() < ho) {
                        var divp = s / 2;
                        var divh = ho - divp;
                        $(this).css('min-height',divh).css('padding-top',divp);
                    }
                }
            });
        }
    }

    jQuery(window).resize(function() {
        doSinglePageResize();
    }).trigger("resize");

    $(window).load(function() {
        doSinglePageResize();
    });

    setSinglePageTitles();
    doSinglePageResize();


})(jQuery);
