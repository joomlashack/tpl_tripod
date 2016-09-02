<?php
/**
 * @package     Tripod
 * @subpackage  Functions
 *
 * @copyright   Copyright (C) 2005 - 2016 Joomlashack. Meritage Assets.  All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// Restrict Access to within Joomla
defined('_JEXEC') or die('Restricted access');

require_once('preg_find.php');

// Get the bootstrap row mode ( row / row-fluid )
$gridMode = $this->params->get('bs_rowmode', 'row-fluid');
$containerClass = 'container';
$pixelClass = ' pixelMode';

if ($gridMode == 'row-fluid')
{
	$containerClass = 'container-fluid';
	$pixelClass = ' fluidMode';
}

$responsivePage = $this->params->get('responsive', '1');
$responsive = ' responsive';

if ($responsivePage == 0)
{
	$responsive = ' no-responsive';
}

/**
 * Check Image
 *
 * @param   string  $img      New image path
 * @param   string  $default  Default image path
 *
 * @return  void
 */
function checkImage($img, $default)
{
	if ($img == "")
	{
		$img = $default;
	}
	elseif ($img != "-1")
	{
		$img = "images/" . $img;
	}

	if ($img != "-1")
	{
		$img = JPATH_BASE . '/' . $img;

		if (!file_exists($img))
		{
			$img = "-1";
		}
	}

	return $img;
}

$user = JFactory::getUser();

$bg = checkImage($this->params->get("backgroundImage", ""), "templates/js_tripod/images/default-bg.jpg");

if ($bg != "-1")
{
	$bg = str_replace(JPATH_BASE, '', $bg);
}

// Check if there's a sidebar at all
$sidebarExists = (JModuleHelper::getModules('sidebar1') || JModuleHelper::getModules('sidebar2'));

$blog = (JRequest::getVar('layout', '') == 'blog' ? JRequest::getVar('layout', '') : '');
$blogFtOption = (JRequest::getVar('option', '') == 'com_content' ? JRequest::getVar('option', '') : '');
$blogFt = false;
$viewFt = '';

if ($blogFtOption == "com_content")
{
	$viewFt = (JRequest::getVar('view', '') == 'featured' ? JRequest::getVar('view', '') : '');

	if ($viewFt == 'featured')
	{
		$blogFt = true;
	}
}

$blogs = false;

if ($blog == 'blog' || $blogFt)
{
	$blogs = true;
}

$tripodFullWidthBg = ($this->params->get('singleScrollingPage', '1') == '1' ? true : false);
$tripodFtBlogClass = '';

if ($blogs && $tripodFullWidthBg)
{
	$tripodFtBlogClass = ' tripodFtBlog';
}

$mainContainer = $containerClass;
$mainGridMode = $gridMode;
$mainSpan = 'span12';

$mainComplementContainer = '';
$mainComplementGridMode = '';
$mainComplementSpan = '';
$wrightTemplate = WrightTemplate::getInstance();

if ($tripodFullWidthBg && $sidebarExists == '' && $blogs)
{
	$mainContainer = '';
	$mainGridMode = '';
	$wrightTemplate->useMainSpans = false;
	$mainSpan = '';
	$mainComplementContainer = $containerClass;
	$mainComplementGridMode = $gridMode;
	$mainComplementSpan = 'span12';
}

// Slideshow
$tripodSlideshow = ($this->params->get('enableSlideshow', '0') == '1' ? true : false);

/**
 * Slide show set rut default
 *
 * @param   obj  $slideItem  slide item
 *
 * @return  void
 */
function slideshowSetRutDefult($slideItem)
{
	$slideItemRute = str_replace(JPATH_BASE, '', $slideItem);

	return $slideItemRute;
}

$slideshowImageOneRute = slideshowSetRutDefult($slideshowImageOne);
$slideshowImageTwoRute = slideshowSetRutDefult($slideshowImageTwo);
$slideshowImageThreeRute = slideshowSetRutDefult($slideshowImageThree);
$slideshowImageFourRute = slideshowSetRutDefult($slideshowImageFour);

$tripodSlides = false;

if ($slideshowImageOneRute != -1)
{
	if ($slideshowImageTwoRute != -1 || $slideshowImageThreeRute != -1 || $slideshowImageFourRute != -1)
	{
		$tripodSlides = true;
	}
}

// Icons
$style = JRequest::getVar('templateTheme', $user->getParam('theme', $this->params->get('style', 'diagonals-hot')));

$iconOne = checkImage($this->params->get("iconOne", ""), "templates/js_tripod/images/$style/icon-default-one.png");
$iconTwo = checkImage($this->params->get("iconTwo", ""), "templates/js_tripod/images/$style/icon-default-two.png");
$iconThree = checkImage($this->params->get("iconThree", ""), "templates/js_tripod/images/$style/icon-default-three.png");
$iconFour = checkImage($this->params->get("iconFour", ""), "templates/js_tripod/images/$style/icon-default-four.png");

if ($iconOne == "-1")
{
	$iconOne = "/templates/js_tripod/images/icon-default-one.png";
}

if ($iconTwo == "-1")
{
	$iconTwo = "/templates/js_tripod/images/icon-default-two.png";
}

if ($iconThree == "-1")
{
	$iconThree = "/templates/js_tripod/images/icon-default-three.png";
}

if ($iconFour == "-1")
{
	$iconFour = "/templates/js_tripod/images/icon-default-four.png";
}

if ($iconOne != "-1")
{
	$iconOne = str_replace(JPATH_BASE, '', $iconOne);
}

if ($iconTwo != "-1")
{
	$iconTwo = str_replace(JPATH_BASE, '', $iconTwo);
}

if ($iconThree != "-1")
{
	$iconThree = str_replace(JPATH_BASE, '', $iconThree);
}

if ($iconFour != "-1")
{
	$iconFour = str_replace(JPATH_BASE, '', $iconFour);
}


$tripodToolbarDisplayed = ($this->params->get('tripod_toolbar_displayed', '1') == '1' ? true : false);
$tripodToolbarDisplayedClass = "";

if (!$tripodToolbarDisplayed)
{
	$tripodToolbarDisplayedClass = " tollbarNoDisplayed";
}

$useSlider = ($this->params->get('useSlider', '1') == '1');
$imagesFolder = $this->params->get('imagesFolder', 'banners');

if ($imagesFolder == '' || $imagesFolder == '-1')
{
	$useSlider = false;
}
else
{
	$imagesFolder = JPATH_BASE . '/images/' . $imagesFolder;
}

$sliderImages = Array();

if ($useSlider)
{
	$rimagesjpg = preg_find('/\.jpg$/D', $imagesFolder, PREG_FIND_SORTKEYS);
	$rimagesJPG = preg_find('/\.JPG$/D', $imagesFolder, PREG_FIND_SORTKEYS);
	$rimagespng = preg_find('/\.png$/D', $imagesFolder, PREG_FIND_SORTKEYS);
	$rimagesPNG = preg_find('/\.PNG$/D', $imagesFolder, PREG_FIND_SORTKEYS);

	$rimages = array_unique(array_merge($rimagesjpg, $rimagesJPG, $rimagespng, $rimagesPNG));

	if ($rimages)
	{
		foreach ($rimages as $rimage)
		{
			$pinfo = pathinfo($rimage);
			$bname = $pinfo['filename'];
			$image = $imagesFolder . '/' . $bname . '.jpg';

			if (!file_exists($image))
			{
				$image = $imagesFolder . '/' . $bname . '.JPG';

				if (!file_exists($image))
				{
					$image = '';
				}
			}

			if (!file_exists($image))
			{
				$image = $imagesFolder . '/' . $bname . '.PNG';

				if (!file_exists($image))
				{
					$image = '';
				}
			}

			if (!file_exists($image))
			{
				$image = $imagesFolder . '/' . $bname . '.png';

				if (!file_exists($image))
				{
					$image = '';
				}
			}

			if ($image != '')
			{
				$sliderImages[] = JURI::root(true) . substr($image, strlen(JPATH_BASE));
			}
		}
	}
}

if (empty($sliderImages))
{
	$useSlider = false;
}

if ($this->countModules('featured') || $useSlider)
{
	$featuredSpace = true;
}
else
{
	$featuredSpace = false;
}
