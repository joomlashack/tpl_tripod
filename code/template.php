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
        var parallaxeffect = <?php echo ($this->params->get("parallaxEffect","1") == "1" ? "true" : "false"); ?>;
        var singlescrollingpage = <?php echo ($this->params->get("singleScrollingPage","1") == "1" ? "true" : "false"); ?>;
        var parallax_titles = new Array();
        parallax_titles['top'] = '<?php echo $this->params->get('navmenu_top','' ); ?>';
        parallax_titles['featured'] = '<?php echo $this->params->get('navmenu_featured','' ); ?>';
        parallax_titles['category_description'] = '<?php echo $this->params->get('navmenu_category_description','' ); ?>';
        parallax_titles['more_articles'] = '<?php echo $this->params->get('navmenu_more_articles','' ); ?>';
        parallax_titles['subcategories'] = '<?php echo $this->params->get('navmenu_subcategories','' ); ?>';
        parallax_titles['bottom'] = '<?php echo $this->params->get('navmenu_bottom','' ); ?>';
        var parallax_navmenu_scroll_speed = '<?php echo $this->params->get('navmenu_scroll_speed','2000' ); ?>';
    </script>
</head>
<body class="<?php echo $responsive ?>" id="skrollr-body">
    <?php if ($this->countModules('toolbar')) : ?>
        <!-- menu -->
        <w:nav containerClass="<?php echo $containerClass ?>" rowClass="<?php echo $gridMode;?>" wrapClass="navbar-fixed-top" type="toolbar" name="toolbar" />
    <?php endif; ?>

    <!-- header -->
    <header id="header" class="clearfix">
        <w:logo />
        <?php if ($this->countModules('top')) : ?>
            <div class="clear"></div>
            <w:module type="none" name="top" chrome="xhtml" />
        <?php endif; ?>
    </header>

    <?php if ($this->countModules('menu')) : ?>
        <!-- menu -->
        <div class="menu-big-items">
            <w:nav name="menu" />
        </div>
    <?php endif; ?>

    <div class="<?php echo $gridMode; ?>">
        <div class="span12" id="spanRestScrollingMenuWrapper" rel="span<?php echo 12-$scrollingMenuWidth ?>">

            <?php if ($this->countModules('featured') || $this->countModules('grid-top') || $this->countModules('grid-top2')) : ?>
            <div id="parallax_pagefirst">
                <?php if ($this->countModules('featured')) : ?>
                    <!-- featured -->
                    <div id="featured" class="<?php echo $containerClass; ?>">
                        <div class="<?php echo $gridMode; ?>">
                            <w:module type="none" name="featured" chrome="xhtml" />
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($this->countModules('grid-top')) : ?>
                    <!-- grid-top -->
                    <div id="grid-top" class="<?php echo $containerClass; ?>">
                        <div class="<?php echo $gridMode; ?>">
                            <w:module type="<?php echo $gridMode; ?>" name="grid-top" chrome="wrightflexgrid" />
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($this->countModules('grid-top2')) : ?>
                    <!-- grid-top2 -->
                    <div id="grid-top2" class="<?php echo $containerClass; ?>">
                        <div class="<?php echo $gridMode; ?>">
                            <w:module type="<?php echo $gridMode; ?>" name="grid-top2" chrome="wrightflexgrid" />
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="<?php echo $containerClass ?>">
                <div id="main-content" class="<?php echo $gridMode; ?>">
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
                <div id="parallax_pagelast">

                    <?php if ($this->countModules('grid-bottom')) : ?>
                        <!-- grid-bottom -->
                        <div id="grid-bottom" >
                                <w:module type="<?php echo $gridMode; ?>" name="grid-bottom" chrome="wrightflexgrid" />
                        </div>
                    <?php endif; ?>
                    <?php if ($this->countModules('grid-bottom2')) : ?>
                        <!-- grid-bottom2 -->
                        <div id="grid-bottom2" >
                                <w:module type="<?php echo $gridMode; ?>" name="grid-bottom2" chrome="wrightflexgrid" />
                        </div>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

        </div>
        <div class="span<?php echo $scrollingMenuWidth ?>" id="spanScrollingMenuWrapper" style="display:none">
        </div>
    </div>

    <?php if ($this->countModules('bottom-menu')) : ?>
        <!-- bottom-menu -->
        <w:nav containerClass="<?php echo $containerClass ?>" rowClass="<?php echo $gridMode;?>" name="bottom-menu" />
    <?php endif; ?>

    <script type='text/javascript' src='<?php echo JURI::root(true) ?>/templates/js_tripod/js/skrollr.min.js'></script>
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
