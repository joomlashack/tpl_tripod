jQuery(function() {

    if (singlescrollingpage) {
        var resizeClass = "div.blog > div.category-desc";
        var resizeClass2 = "div.blog > div.items-leading > [class^=leading-]";
        var resizeClass3 = "div.blog > *:not(.clearfix)*:not(.pagination)*:not(h1)*:not(h2)*:not(.items-leading)*:not(.category-desc)*:not(.page-header)*:not(.items-more)*:not(.cat-children)";

        if (!jQuery('div.blog').length) {
            resizeClass = "div.blog-featured > div.category-desc";
            resizeClass2 = "div.blog-featured > div.items-leading > [class^=leading-]";
            resizeClass3 = "div.blog-featured > *:not(.clearfix)*:not(.pagination)*:not(h1)*:not(h2)*:not(.items-leading)*:not(.category-desc)*:not(.page-header)*:not(.items-more)*:not(.cat-children)";
        }
    }

    function setSinglePageTitles() {
        var htoolbar = jQuery('div.wrapper-toolbar').height();
        var htop = jQuery('#header').height() + jQuery('div.wrapper-toolbar').height();

        var c = jQuery(resizeClass).length + jQuery(resizeClass2).length + jQuery(resizeClass3).length;

        console.log(jQuery(resizeClass));
        console.log(jQuery(resizeClass2));
        console.log(jQuery(resizeClass3));

        if (c > 0) {
            var elems = [];
            var j = 0;

            jQuery('<div/>', {
                    id: 'singlepage_blog_titles_wrapper',
                    class: 'navbar',
                    html: jQuery('div#singlepage_blog_titles').html(),
            })
                    .appendTo('#spanScrollingMenuWrapper');

            jQuery('div#singlepage_blog_titles').html('');

            jQuery('ul li#nav_singlepage_top a').html(singlepage_titles['top']);
            jQuery('ul li#nav_singlepage_pagefirst a').html(singlepage_titles['featured']);
            jQuery('ul li#nav_singlepage_catdesc a').html(singlepage_titles['category_description']);
            jQuery('ul li#nav_singlepage_morearticles a').html(singlepage_titles['more_articles']);
            jQuery('ul li#nav_singlepage_subcategories a').html(singlepage_titles['subcategories']);
            jQuery('ul li#nav_singlepage_pagelast a').html(singlepage_titles['bottom']);

            if (jQuery('#singlepage_pagefirst').length) {
                jQuery('#nav_singlepage_pagefirst').css('display','block');
                jQuery('#singlepage_pagefirst').addClass('singlepage_section');
            }
            if (jQuery('#singlepage_pagelast').length) {
                jQuery('#nav_singlepage_pagelast').css('display','block');
                jQuery('#singlepage_pagelast').addClass('singlepage_section');
            }
            if (jQuery('.category-desc').length) {
                jQuery('#nav_singlepage_catdesc').css('display','block');
                jQuery('.category-desc').addClass('singlepage_section')
                        .attr('id','singlepage_catdesc');
            }
            if (jQuery('.items-more').length) {
                jQuery('#nav_singlepage_morearticles').css('display','block');
                jQuery('.items-more').addClass('singlepage_section')
                        .attr('id','singlepage_morearticles');
            }
            if (jQuery('.cat-children').length) {
                jQuery('#nav_singlepage_subcategories').css('display','block');
                jQuery('.cat-children').addClass('singlepage_section')
                        .attr('id','singlepage_subcategories');
            }

            var ppost = 0;
            jQuery(resizeClass2).each(function (post) {
                jQuery(this).attr('id','singlepage_post_' + ppost)
                        .addClass('singlepage_section');
                ppost++;
            });

            jQuery(resizeClass3).each(function (post) {
                jQuery(this).attr('id','singlepage_post_' + ppost)
                        .addClass('singlepage_section');
                ppost++;
            });

            singlepage_navmenu_scroll_speed = parseInt(singlepage_navmenu_scroll_speed);
            jQuery('#singlepage_blog_titles_wrapper ul li a').click(function () {
                if (jQuery(this).attr('rel') != '')
                    jQuery('html, body').animate({
                        scrollTop: (jQuery(this).attr('rel') == 'top' ? 0 : jQuery('#' + jQuery(this).attr('rel')).offset().top) - htoolbar
                    }, singlepage_navmenu_scroll_speed);
                return false;
            });

            jQuery('#spanRestScrollingMenuWrapper').removeClass('span12').addClass(jQuery('#spanRestScrollingMenuWrapper').attr('rel'));
            jQuery('#spanScrollingMenuWrapper').css('display','block');
        }
    }

    function doSinglePageResize() {
        var htoolbar = jQuery('div.wrapper-toolbar').height();
        var hbottommenu = jQuery('div.wrapper-bottom-menu').height();
        var hfooter = jQuery('div.wrapper-footer').height();

        var ho = jQuery(window).height() - htoolbar;
        var c = jQuery('.singlepage_section').length;
        if (c > 0) {
            jQuery('.singlepage_section').each(function (i) {
                if (i == c-1) {
                    jQuery(this).css('min-height');
                    jQuery(this).css('padding-top');
                    var hf = ho - hbottommenu - hfooter;
                    if (hf > 0 && jQuery(this).height() < ho) {
                        var divp = (hf - jQuery(this).height()) / 2;
                        var divh = hf - divp;
                        jQuery(this).css('min-height',divh).css('padding-top',divp);
                    }
                }
                else {
                    jQuery(this).css('min-height');
                    var s = ho-jQuery(this).height();
                    if (jQuery(this).height() < ho) {
                        var divp = s / 2;
                        var divh = ho - divp;
                        jQuery(this).css('min-height',divh).css('padding-top',divp);
                    }
                }
            });
        }
    }

    jQuery(window).resize(function() {
        doSinglePageResize();
    }).trigger("resize");

    jQuery(document).load(function() {
        doSinglePageResize();
    });

    setSinglePageTitles();
    doSinglePageResize();
});
