<?php
/**
 * @package     Tripod
 * @subpackage  Template File
 *
 * @copyright   Copyright (C) 2005 - 2013 Joomlashack. Meritage Assets.  All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Do not edit this file directly. You can copy it and create a new file called
 * 'custom.php' in the same folder, and it will override this file. That way
 * if you update the template ever, your changes will not be lost.
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

?>
<doctype>
<html>
<head>
    <w:head />
    <script type="text/javascript">
        var singlescrollingpage = <?php echo ($this->params->get("singleScrollingPage","1") == "1" ? "true" : "false"); ?>;
        var singlepage_titles = new Array();
        singlepage_titles['top'] = '<?php echo $this->params->get('navmenu_top','' ); ?>';
        singlepage_titles['featured'] = '<?php echo $this->params->get('navmenu_featured','' ); ?>';
        singlepage_titles['category_description'] = '<?php echo $this->params->get('navmenu_category_description','' ); ?>';
        singlepage_titles['more_articles'] = '<?php echo $this->params->get('navmenu_more_articles','' ); ?>';
        singlepage_titles['subcategories'] = '<?php echo $this->params->get('navmenu_subcategories','' ); ?>';
        singlepage_titles['bottom'] = '<?php echo $this->params->get('navmenu_bottom','' ); ?>';
        var singlepage_navmenu_scroll_speed = '<?php echo $this->params->get('navmenu_scroll_speed','2000' ); ?>';
    </script>

    <?php if ($tripodSlideshow) : ?>
        <script type="text/javascript" src="<?php echo JURI::root(true) ?>/templates/js_tripod/js/jquery.easing.min.js"></script>

        <script type="text/javascript" src="<?php echo JURI::root(true) ?>/templates/js_tripod/js/supersized.3.2.7.min.js"></script>
        <script type="text/javascript" src="<?php echo JURI::root(true) ?>/templates/js_tripod/js/supersized.shutter.min.js"></script>

        <script type="text/javascript">

            jQuery(function($){

                $.supersized({


                    // Functionality
                    slide_interval          :   3000,       // Length between transitions
                    transition              :   1,          // 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
                    transition_speed        :   700,        // Speed of transition

                    // Components
                    slide_links             :   'blank',    // Individual links for each slide (Options: false, 'num', 'name', 'blank')
                    slides                  :   [           // Slideshow Images
                                                        {image : '<?php echo $slideshowImageOneRute; ?>', title : 'Image Title', thumb : '', url : ''},
                                                        {image : '<?php echo $slideshowImageTwoRute; ?>', title : 'Image Title', thumb : '', url : ''},
                                                        {image : '<?php echo $slideshowImageThreeRute ?>', title : 'Image Title', thumb : '', url : ''},
                                                        {image : '<?php echo $slideshowImageFourRute ?>', title : 'Image Title', thumb : '', url : ''},
                                                ]


                });
            });

        </script>
    <?php endif; ?>
</head>
<body class="<?php echo $responsive . $tripodFtBlogClass?>" id="skrollr-body">
    <?php if ($this->countModules('toolbar')) : ?>
        <!-- menu -->
        <w:nav containerClass="<?php echo $containerClass ?>" rowClass="<?php echo $gridMode;?>" wrapClass="navbar-fixed-top" type="toolbar" name="toolbar" />
    <?php endif; ?>
    <!-- header -->
    <header id="header" class="clearfix">
        <?php if ($bg != '-1' && !$tripodSlideshow) : ?>
            <div class="bg-wrapp">
                <div class="bg-wrapp-inner">
                        <img id="bg-header" src="<?php echo JURI::root(true) . $bg ?>" />
                </div>
            </div>
            <div class="bg-filter"></div>
        <?php endif ?>

        <?php if ($tripodSlideshow) : ?>
            <!--Arrow Navigation-->
            <a id="prevslide" class="load-item"></a>
            <a id="nextslide" class="load-item"></a>
        <?php endif ?>

        <div class="header-inner">
            <w:logo />
            <?php if ($this->countModules('top')) : ?>
                <w:module type="none" name="top" chrome="xhtml" />
            <?php endif; ?>
            <?php if ($tripodSlideshow) : ?>
                <div class="tripod-slideshow-wrapper-icons">
                <?php if ($iconOne != "-1") : ?>
                    <div class="tripod-slideshow-icon">
                        <img src="<?php  echo $iconOne; ?>" alt="">
                    </div>
                <?php endif; ?>
                <?php if ($iconTwo != "-1") : ?>
                    <div class="tripod-slideshow-icon">
                        <img src="<?php  echo $iconTwo; ?>" alt="">
                    </div>
                <?php endif; ?>
                <?php if ($iconThree != "-1") : ?>
                    <div class="tripod-slideshow-icon">
                        <img src="<?php  echo $iconThree; ?>" alt="">
                    </div>
                <?php endif; ?>
                <?php if ($iconFour != "-1") : ?>
                    <div class="tripod-slideshow-icon">
                        <img src="<?php  echo $iconFour; ?>" alt="">
                    </div>
                <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>

    </header>

    <?php if ($this->countModules('menu')) : ?>
        <!-- menu -->
        <div class="menu-big-items">
            <w:nav name="menu" />
        </div>
    <?php endif; ?>

        <div id="spanScrollingMenuWrapper" style="display:none">
        </div>
        <div id="spanRestScrollingMenuWrapper">

            <?php if ($this->countModules('featured') || $this->countModules('grid-top') || $this->countModules('grid-top2')) : ?>
                <div id="singlepage_pagefirst">
                    <?php if ($this->countModules('featured')) : ?>
                        <!-- featured -->
                        <div id="featured" class="<?php echo $containerClass; ?>">
                            <div class="<?php echo $gridMode; ?>">
                                <div class="span12">
                                    <w:module type="none" name="featured" chrome="xhtml" />
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->countModules('grid-top')) : ?>
                        <!-- grid-top -->
                        <div id="grid-top" class="<?php echo $containerClass; ?>">
                            <w:module type="<?php echo $gridMode; ?>" name="grid-top" chrome="wrightflexgrid" />
                        </div>
                    <?php endif; ?>
                    <?php if ($this->countModules('grid-top2')) : ?>
                        <!-- grid-top2 -->
                        <div id="grid-top2" class="<?php echo $containerClass; ?>">
                            <w:module type="<?php echo $gridMode; ?>" name="grid-top2" chrome="wrightflexgrid" />
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="<?php echo $mainContainer ?>">
                <div id="main-content" class="<?php echo $mainGridMode; ?>">
                    <!-- sidebar1 -->
                    <aside id="sidebar1">
                        <w:module name="sidebar1" chrome="xhtml" />
                    </aside>
                    <!-- main -->
                    <section id="main">
                        <?php if ($this->countModules('above-content')) : ?>
                        <!-- above-content -->
                        <div id="above-content">
                            <w:module type="none" name="above-content" chrome="xhtml" />
                        </div>
                        <?php endif; ?>
                        <?php if ($this->countModules('breadcrumbs')) : ?>
                        <!-- breadcrumbs -->
                        <div id="breadcrumbs">
                                <w:module type="single" name="breadcrumbs" chrome="none" />
                        </div>
                        <?php endif; ?>
                        <!-- component -->
                        <w:content />
                        <?php if ($this->countModules('below-content')) : ?>
                        <!-- below-content -->
                        <div id="below-content">
                            <w:module type="none" name="below-content" chrome="xhtml" />
                        </div>
                        <?php endif; ?>
                    </section>
                    <!-- sidebar2 -->
                    <aside id="sidebar2">
                        <w:module name="sidebar2" chrome="xhtml" />
                    </aside>
                </div>
            </div>


            <?php if ($this->countModules('grid-bottom') || $this->countModules('grid-bottom2')) : ?>
                <div id="singlepage_pagelast">

                    <?php if ($this->countModules('grid-bottom')) : ?>
                        <!-- grid-bottom -->
                        <div id="grid-bottom" >
                            <div class="<?php echo $containerClass; ?>">
                                <w:module type="<?php echo $gridMode; ?>" name="grid-bottom" chrome="wrightflexgrid" />
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->countModules('grid-bottom2')) : ?>
                        <!-- grid-bottom2 -->
                        <div id="grid-bottom2" >
                            <div class="<?php echo $containerClass; ?>">
                                <w:module type="<?php echo $gridMode; ?>" name="grid-bottom2" chrome="wrightflexgrid" />
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

        </div>

    <?php if ($this->countModules('bottom-menu')) : ?>
        <!-- bottom-menu -->
        <w:nav containerClass="bottom-menu" name="bottom-menu" />
    <?php endif; ?>

    <script type='text/javascript' src='<?php echo JURI::root(true) ?>/templates/js_tripod/js/tripod.js'></script>

    <!-- footer -->
    <div class="wrapper-footer">
        <footer id="footer" <?php if ($this->params->get('stickyFooter',1)) : ?> class="sticky"<?php endif;?>>
             <div class="<?php echo $containerClass ?> footer-content">
                <?php if ($this->countModules('footer')) : ?>
                    <w:module type="<?php echo $gridMode; ?>" name="footer" chrome="wrightflexgrid" />
                <?php endif; ?>
                <w:footer />
            </div>
        </footer>
    </div>

</body>
</html>
