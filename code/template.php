<?php
/**
 * @package     Tripod
 * @subpackage  Template File
 *
 * @copyright   Copyright (C) 2005 - 2016 Joomlashack. Meritage Assets.  All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Do not edit this file directly. You can copy it and create a new file called
 * 'custom.php' in the same folder, and it will override this file. That way
 * if you update the template ever, your changes will not be lost.
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

?>
<doctype>
<html>
<head>
    <w:head />
    <link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Titillium+Web:400,700' rel='stylesheet' type='text/css'>
</head>

<body class="<?php echo $responsive . $tripodFtBlogClass . $tripodToolbarDisplayedClass . $pixelClass?>">
    <?php
		if ($this->countModules('toolbar'))
			:
	?>
            <!-- toolbar -->
            <div class="toolbar <?php echo ($tripodToolbarDisplayed ? '' : 'collapse'); ?>">
                <w:nav containerClass="<?php echo $containerClass ?> tripod-toolbar-container <?php echo ($tripodToolbarDisplayed ? '' : ' collapsedToolbarInner'); ?>" rowClass="<?php echo $gridMode;?>" wrapClass="navbar-fixed-top" type="toolbar" name="toolbar" />
            </div>

            <?php
				if (!$tripodToolbarDisplayed)
					:
			?>
                <div class="visible-desktop top-menu-toggler" data-toggle="collapse" data-target=".toolbar">
                    <div class="btn btn-primary toolbar-collapse-btn">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </div>
                </div>
            <?php
				endif;
			?>
    <?php
		endif;
	?>
    <!-- header -->
    <header id="header" class="<?php echo (!$tripodSlideshow ? '' : 'tripodSlideshow');  ?>">
        <?php
			if ($bg && !$tripodSlideshow)
			:
		?>
            <div class="bg-wrapp">
                <div class="bg-wrapp-inner">
                    <img id="bg-header" src="<?php echo JURI::root(true) . $bg ?>" />
                </div>
            </div>
            <div class="bg-filter"></div>
        <?php
			endif;
		?>

        <?php
			if ($tripodSlideshow)
				:
		?>
            <!--Arrow Navigation-->
            <a id="prevslide" class="load-item"></a>
            <a id="nextslide" class="load-item"></a>
        <?php
			endif;
		?>

        <div class="header-inner">
            <w:logo />
            <?php
				if ($this->countModules('top'))
					:
			?>
                <div class="top-position">
                    <w:module type="none" name="top" />
                </div>
            <?php
				endif;
			?>

            <?php
				if ($tripodSlideshow)
					:
			?>
                <div class="tripod-slideshow-wrapper-icons">
                   <div class="row-fluid">

                        <?php if ($tripodFullWidthBg) : ?>
                            <?php if (($this->countModules('featured') || $this->countModules('grid-top') || $this->countModules('grid-top2')) && $blogs) : ?>
                                <a href="#" class="tripod-slideshow-icon span3" rel="singlepage_pagefirst">
                            <?php else : ?>
                                <div class="tripod-slideshow-icon span3">
                            <?php endif; ?>
                        <?php else : ?>
                            <div class="tripod-slideshow-icon span3">
                        <?php endif; ?>

                        <i class="<?php echo $iconOne; ?> icon-3x"></i>

                        <?php if ($tripodFullWidthBg) : ?>
                            <?php if (($this->countModules('featured') || $this->countModules('grid-top') || $this->countModules('grid-top2')) && $blogs) : ?>
                                </a>
                            <?php else : ?>
                                </div>
                            <?php endif; ?>
                        <?php else : ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($blogs && $tripodFullWidthBg) : ?>
                            <a href="#" class="tripod-slideshow-icon span3" rel="singlepage_post_0">
						<?php else : ?>
							<div class="tripod-slideshow-icon span3">
						<?php endif; ?>

                        <i class="<?php echo $iconTwo; ?> icon-3x"></i>

						<?php if ($blogs && $tripodFullWidthBg) : ?>
							</a>
						<?php else : ?>
							</div>
                        <?php endif; ?>

                        <?php if ($tripodFullWidthBg && $this->countModules('grid-bottom')) : ?>
                            <a href="#" class="tripod-slideshow-icon span3" rel="singlepage_pagebottom">
                        <?php else : ?>
                            <div class="tripod-slideshow-icon span3">
                        <?php endif; ?>

                        <i class="<?php echo $iconThree; ?> icon-3x"></i>

                        <?php if ($tripodFullWidthBg && $this->countModules('grid-bottom')) : ?>
                            </a>
                        <?php else : ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($tripodFullWidthBg && $this->countModules('grid-bottom2')) : ?>
                            <a href="#" class="tripod-slideshow-icon span3" rel="singlepage_pagelast">
                        <?php else : ?>
                            <div class="tripod-slideshow-icon span3">
                        <?php endif; ?>

                        <i class="<?php echo $iconFour; ?> icon-3x"></i>

                        <?php if ($tripodFullWidthBg && $this->countModules('grid-bottom2')) : ?>
                            </a>
                        <?php else : ?>
                            </div>
                        <?php endif; ?>

                   </div>
                </div>
            <?php
				endif;
			?>
        </div>
    </header>

    <?php
		if ($this->countModules('menu'))
			:
	?>
        <!-- menu -->
        <div class="menu-big-items">
            <w:nav name="menu" />
        </div>
    <?php
		endif;
	?>
        <div id="spanScrollingMenuWrapper" style="display:none">
        </div>
        <div id="spanRestScrollingMenuWrapper">

            <?php
				if ($this->countModules('featured') || $this->countModules('grid-top') || $this->countModules('grid-top2'))
					:
			?>
                <div id="singlepage_pagefirst">
                    <?php
						if ($this->countModules('featured'))
							:
					?>
                        <!-- featured -->
                        <div id="featured">
                            <w:module type="none" name="featured" />
                        </div>
                    <?php
						endif;
					?>
                    <?php
						if ($this->countModules('grid-top'))
							:
					?>
                        <!-- grid-top -->
                        <div id="grid-top" class="<?php echo $containerClass; ?>">
                            <w:module type="<?php echo $gridMode; ?>" name="grid-top" chrome="wrightflexgrid" />
                        </div>
                    <?php
						endif;
					?>
                    <?php
						if ($this->countModules('grid-top2'))
							:
					?>
                        <!-- grid-top2 -->
                        <div id="grid-top2" class="<?php echo $containerClass; ?>">
                            <w:module type="<?php echo $gridMode; ?>" name="grid-top2" chrome="wrightflexgrid" />
                        </div>
                    <?php
						endif;
					?>
                </div>
            <?php
				endif;
			?>

            <div class="<?php echo $mainContainer ?>">
                <div id="main-content" class="<?php echo $mainGridMode; ?>">
                    <!-- sidebar1 -->
                    <aside id="sidebar1">
                        <w:module name="sidebar1" />
                    </aside>
                    <!-- main -->
                    <section id="main">
                        <?php
							if ($this->countModules('above-content'))
								:
						?>
                        <!-- above-content -->
                        <div id="above-content">
                            <w:module type="none" name="above-content" />
                        </div>
                        <?php
							endif;
						?>
                        <?php
							if ($this->countModules('breadcrumbs'))
								:
						?>
                            <!-- breadcrumbs -->
                            <?php
								if ($blogs && !$sidebarExists)
								{
									$breadcrumbsClass = $containerClass;
								}
							?>
                            <div id="breadcrumbs" class="<?php echo $breadcrumbsClass;?>">
                                <w:module type="single" name="breadcrumbs" chrome="none" />
                            </div>
                        <?php
							endif;
						?>
                        <!-- component -->
                        <w:content />
                        <?php
							if ($this->countModules('below-content'))
								:
						?>
                        <!-- below-content -->
                        <div id="below-content">
                            <w:module type="none" name="below-content" />
                        </div>
                        <?php
							endif;
						?>
                    </section>
                    <!-- sidebar2 -->
                    <aside id="sidebar2">
                        <w:module name="sidebar2" />
                    </aside>
                </div>
            </div>


            <?php
				if ($this->countModules('grid-bottom'))
					:
			?>
                <div id="singlepage_pagebottom" class="bottom-page">
                        <!-- grid-bottom -->
                        <div id="grid-bottom" >
                            <div class="<?php echo $containerClass; ?>">
                                <w:module type="<?php echo $gridMode; ?>" name="grid-bottom" chrome="wrightflexgrid" />
                            </div>
                        </div>
                </div>
            <?php
				endif;
			?>

            <?php
				if ($this->countModules('grid-bottom2'))
					:
			?>
                <div id="singlepage_pagelast" class="last-page">
                    <!-- grid-bottom2 -->
                    <div id="grid-bottom2" >
                        <div class="<?php echo $containerClass; ?>">
                            <w:module type="<?php echo $gridMode; ?>" name="grid-bottom2" chrome="wrightflexgrid" />
                        </div>
                    </div>
                </div>
            <?php
				endif;
			?>
        </div>
    <w:module type="none" name="debug" chrome="none" />
    <!-- footer -->
    <div class="wrapper-footer">
        <footer id="footer"
				<?php
					if ($this->params->get('stickyFooter', 1))
						:
				?>
				class="sticky"
				<?php
					endif;
				?>
				>
            <?php
				if ($this->countModules('bottom-menu'))
					:
			?>
                <!-- bottom-menu -->
                <w:nav containerClass="bottom-menu" name="bottom-menu" />
            <?php
				endif;
			?>
            <div class="<?php echo $containerClass ?> footer-content">
                <?php
					if ($this->countModules('footer'))
						:
				?>
                    <w:module type="<?php echo $gridMode; ?>" name="footer" chrome="wrightflexgrid" />
                <?php
					endif;
				?>
                <w:footer />
            </div>
        </footer>
    </div>
    <?php
		if ($tripodSlideshow)
			:
	?>
		<?php
			$tripodSlidesString = "";

			foreach ($sliderImages as $sliderImage)
			{
				$tripodSlidesString .= '{"image":' . '"' . $sliderImage . '"},';
			}

			$tripodSlidesString = substr($tripodSlidesString, 0, -1);
		?>
        <script type="text/javascript" src="<?php echo JURI::root(true) ?>/templates/js_tripod/js/jquery.easing.min.js"></script>
        <script type="text/javascript" src="<?php echo JURI::root(true) ?>/templates/js_tripod/js/supersized.min.js"></script>
        <script type="text/javascript" src="<?php echo JURI::root(true) ?>/templates/js_tripod/js/supersized.shutter.min.js"></script>

        <script type="text/javascript">
            jQuery(function(){

                jQuery.supersized({
                    // Functionality
                    slideshow               :   1,          // Slideshow on/off
                    autoplay                :   1,          // Slideshow starts playing automatically
                    start_slide             :   1,          // Start slide (0 is random)
                    stop_loop               :   0,          // Pauses slideshow on last slide
                    random                  :   0,          // Randomize slide order (Ignores start slide)
                    slide_interval          :   12000,      // Length between transitions
                    transition              :   2,          // 0-None, 1-Fade, 2-Slide T, 3-Slide R, 4-Slide B, 5-Slide L, 6-Carousel R, 7-Carousel L
                    transition_speed        :   300,        // Speed of transition
                    new_window              :   1,          // Image links open in new window/tab
                    pause_hover             :   0,          // Pause slideshow on hover
                    keyboard_nav            :   1,          // Keyboard navigation on/off
                    performance             :   1,          // 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality,
															// 3-Optimizes transition speed
															// (Only works for Firefox/IE, not Webkit)
                    image_protect           :   1,          // Disables image dragging and right click with Javascript

                    // Size & Position
                    min_width               :   0,          // Min width allowed (in pixels)
                    min_height              :   0,          // Min height allowed (in pixels)
                    vertical_center         :   1,          // Vertically center background
                    horizontal_center       :   1,          // Horizontally center background
                    fit_always              :   0,          // Image will never exceed browser width or height (Ignores min. dimensions)
                    fit_portrait            :   1,          // Portrait images will not exceed browser height
                    fit_landscape           :   0,          // Landscape images will not exceed browser width

                    // Components
                    slide_links             :   'blank',    // Individual links for each slide (Options: false, 'num', 'name', 'blank')
                    thumb_links             :   0,          // Individual thumb links for each slide
                    thumbnail_navigation    :   0,          // Thumbnail navigation

                    slides                  :   [<?php echo $tripodSlidesString; ?>],
                    // Theme Options
                    progress_bar            :   0,          // Timer for each slide
                    mouse_scrub             :   0


                });
            });

        </script>
    <?php
		endif;
	?>

       <script type="text/javascript">
        var singlescrollingpage = <?php echo ($this->params->get("singleScrollingPage", "0") == "1" ? "true" : "false"); ?>;
        var singlepage_titles = new Array();
        singlepage_titles['top'] = '<?php echo $this->params->get('navmenu_top', ''); ?>';
        singlepage_titles['featured'] = '<?php echo $this->params->get('navmenu_featured', ''); ?>';
        singlepage_titles['category_description'] = '<?php echo $this->params->get('navmenu_category_description', ''); ?>';
        singlepage_titles['more_articles'] = '<?php echo $this->params->get('navmenu_more_articles', ''); ?>';
        singlepage_titles['subcategories'] = '<?php echo $this->params->get('navmenu_subcategories', ''); ?>';
        singlepage_titles['bottom'] = '<?php echo $this->params->get('navmenu_bottom', ''); ?>';
        singlepage_titles['last'] = '<?php echo $this->params->get('navmenu_last', ''); ?>';
        var singlepage_navmenu_scroll_speed = '<?php echo $this->params->get('navmenu_scroll_speed', '2000'); ?>';
    </script>

    <script type='text/javascript' src='<?php echo JURI::root(true) ?>/templates/js_tripod/js/tripod.js'></script>

</body>
</html>
