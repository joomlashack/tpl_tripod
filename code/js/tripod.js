(function($) {
        $(window).load(function() {
                if (singlescrollingpage) {

                        var resizeClass = "div.blog > div.category-desc";
                        var resizeClass2 = "div.blog > div.items-leading > [class^=leading-]";
                        var resizeClass3 = "div.blog > *:not(.clearfix)*:not(.pagination)*:not(h1)*:not(h2)*:not(.items-leading)*:not(.category-desc)*:not(.page-header)*:not(.items-more)*:not(.cat-children)";

                        if (!$('div.blog').length) {
                                resizeClass = "div.blog-featured > div.category-desc";
                                resizeClass2 = "div.blog-featured > div.items-leading > [class^=leading-]";
                                resizeClass3 = "div.blog-featured > *:not(.clearfix)*:not(.pagination)*:not(h1)*:not(h2)*:not(.items-leading)*:not(.category-desc)*:not(.page-header)*:not(.items-more)*:not(.cat-children)";
                        }

                        function setParallaxTitles() {

                                var htoolbar = $('div.wrapper-toolbar').height();
                                var htop = $('#header').height() + $('div.wrapper-toolbar').height();

                                var c = $(resizeClass).length + $(resizeClass2).length + $(resizeClass3).length;

                                if (c > 0) {
                                        var elems = [];
                                        var j = 0;

                                        jQuery('<div/>', {
                                                id: 'parallax_blog_titles_wrapper',
                                                html: $('div#parallax_blog_titles').html(),
                                                width: $('#spanScrollingMenuWrapper').width()
                                        })
                                                .appendTo('#spanScrollingMenuWrapper');

                                        $('div#parallax_blog_titles').html('');

                                        $('ul li#nav_parallax_top a').html(parallax_titles['top']);
                                        $('ul li#nav_parallax_pagefirst a').html(parallax_titles['featured']);
                                        $('ul li#nav_parallax_catdesc a').html(parallax_titles['category_description']);
                                        $('ul li#nav_parallax_morearticles a').html(parallax_titles['more_articles']);
                                        $('ul li#nav_parallax_subcategories a').html(parallax_titles['subcategories']);
                                        $('ul li#nav_parallax_pagelast a').html(parallax_titles['bottom']);

                                        $('#parallax_blog_titles_wrapper').affix({
                                                offset: htop - (htoolbar == null ? 30 : 20)
                                        });

                                        if ($('#parallax_pagefirst').length) {
                                                $('#nav_parallax_pagefirst').css('display','block');
                                                $('#parallax_pagefirst').addClass('parallax_singlepage');
                                        }
                                        if ($('#parallax_pagelast').length) {
                                                $('#nav_parallax_pagelast').css('display','block');
                                                $('#parallax_pagelast').addClass('parallax_singlepage');
                                        }
                                        if ($('.category-desc').length) {
                                                $('#nav_parallax_catdesc').css('display','block');
                                                $('.category-desc').addClass('parallax_singlepage')
                                                        .attr('id','parallax_catdesc');
                                        }
                                        if ($('.items-more').length) {
                                                $('#nav_parallax_morearticles').css('display','block');
                                                $('.items-more').addClass('parallax_singlepage')
                                                        .attr('id','parallax_morearticles');
                                        }
                                        if ($('.cat-children').length) {
                                                $('#nav_parallax_subcategories').css('display','block');
                                                $('.cat-children').addClass('parallax_singlepage')
                                                        .attr('id','parallax_subcategories');
                                        }

                                        var ppost = 0;
                                        $(resizeClass2).each(function (post) {
                                                $(this).attr('id','parallax_post_' + ppost)
                                                        .addClass('parallax_singlepage');
                                                ppost++;
                                        });

                                        $(resizeClass3).each(function (post) {
                                                $(this).attr('id','parallax_post_' + ppost)
                                                        .addClass('parallax_singlepage');
                                                ppost++;
                                        });

                                        parallax_navmenu_scroll_speed = parseInt(parallax_navmenu_scroll_speed);
                                        $('#parallax_blog_titles_wrapper ul li a').click(function () {
                                                if ($(this).attr('rel') != '')
                                                        $('html, body').animate({
                                                                scrollTop: ($(this).attr('rel') == 'top' ? 0 : $('#' + $(this).attr('rel')).offset().top) - htoolbar
                                                        }, parallax_navmenu_scroll_speed);
                                                return false;
                                        });

                                        $('#spanRestScrollingMenuWrapper').removeClass('span12').addClass($('#spanRestScrollingMenuWrapper').attr('rel'));
                                        $('#spanScrollingMenuWrapper').css('display','block');
                                }
                        }

                        function doParallaxResize() {
                                var htoolbar = $('div.wrapper-toolbar').height();
                                var hbottommenu = $('div.wrapper-bottom-menu').height();
                                var hfooter = $('div.wrapper-footer').height();

                                var ho = $(window).height() - htoolbar;
                                var c = $('.parallax_singlepage').length;
                                if (c > 0) {
                                        $('.parallax_singlepage').each(function (i) {
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

                        setParallaxTitles();
                        doParallaxResize();

                        jQuery(window).resize(function() {
                                doParallaxResize();
                                setParallax(false);
                        }).trigger("resize");

                }

                if (parallaxeffect) {
                        var h = jQuery('body').height();

                        setParallax(false);
                }

        });

        function setParallax(init) {
                if (parallaxeffect) {
                        var h = jQuery('body').height();
                        if (jQuery('#parallaxbg1')) {
                                jQuery('#parallaxbg1').attr('data-0','background-position:0px 0px')
                                                                                .attr('data-end','background-position:-500px ' + (h*2) + 'px');
                        }
                        if (jQuery('#parallaxbg2')) {
                                jQuery('#parallaxbg2').attr('data-0','background-position:0px 0px')
                                                                                .attr('data-end','background-position:-500px ' + (h) + 'px');
                        }
                        if (jQuery('#parallaxbg3')) {
                                jQuery('#parallaxbg3').attr('data-0','background-position:0px 0px')
                                                                                .attr('data-end','background-position:-500px ' + (h/3) + 'px');
                        }

                        if (init) {
                                skrollr.init({
                            smoothScrolling: true,
                            forceHeight: false
                                });
                        }
                        else {
                                skrollr.get().refresh();
                        }
                }
        }

        setParallax(true);

})(jQuery);