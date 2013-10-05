
<?php
/**
 * @package     Tripod
 * @subpackage  Functions
 *
 * @copyright   Copyright (C) 2005 - 2013 Joomlashack. Meritage Assets.  All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// Restrict Access to within Joomla
defined('_JEXEC') or die('Restricted access');

// get the bootstrap row mode ( row / row-fluid )
$gridMode = $this->params->get('bs_rowmode','row-fluid');
$containerClass = 'container';
if ($gridMode == 'row-fluid') {
    $containerClass = 'container-fluid';
}

$responsivePage = $this->params->get('responsive','1');
$responsive = ' responsive';
if ($responsivePage == 0) {
    $responsive = ' no-responsive';
}


function checkImage($img, $default) {
        if ($img == "") {
                $img = $default;
        }
        elseif ($img != "-1") {
                $img = "images/" . $img;
        }

        if ($img != "-1") {
                $img = JPATH_BASE . '/' . $img;
                if (!file_exists($img)) {
                        $img = "-1";
                }
        }

        return $img;
}

$user = JFactory::getUser();

$bg = checkImage($this->params->get("backgroundImage", ""), "templates/js_tripod/images/default-bg.jpg");

if ($bg != "-1") $bg = str_replace(JPATH_BASE, '', $bg);

$tripodFullWidthBg = ($this->params->get('singleScrollingPage','1') == '1' ? true : false);
$tripodFtBlogClass = ($tripodFullWidthBg ? ' tripodFtBlog' : '');

$sidebarExists = (JModuleHelper::getModules('sidebar1') || JModuleHelper::getModules('sidebar2'));  // check if there's a sidebar at all

$blog = (JRequest::getVar('layout','') == 'blog' ? JRequest::getVar('layout','') : '');
$blogFtOption = (JRequest::getVar('option','') == 'com_content' ? JRequest::getVar('option','') : '');
$blogFt = false;
$viewFt = '';

if ($blogFtOption == "com_content"){
    $viewFt = (JRequest::getVar('view','') == 'featured' ? JRequest::getVar('view','') : '');
    if($viewFt == 'featured'){
        $blogFt = true;
    }
}

$blogs = false;
if ($blog == 'blog' || $blogFt){
    $blogs = true;
}


$mainContainer = $containerClass;
$mainGridMode = $gridMode;
$mainSpan = 'span12';

$mainComplementContainer = '';
$mainComplementGridMode = '';
$mainComplementSpan = '';
$wrightTemplate = WrightTemplate::getInstance();
if ($tripodFullWidthBg && $sidebarExists == '' && $blogs) {
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
$slideshowImageOne = checkImage($this->params->get("slideshowImageOne", ""), "templates/js_tripod/images/default-bg-one.jpg");
$slideshowImageTwo = checkImage($this->params->get("slideshowImageTwo", ""), "templates/js_tripod/images/default-bg-two.jpg");
$slideshowImageThree = checkImage($this->params->get("slideshowImageThree", ""), "templates/js_tripod/images/default-bg-three.jpg");
$slideshowImageFour = checkImage($this->params->get("slideshowImageFour", ""), "templates/js_tripod/images/default-bg-four.jpg");

function slideshowSetRutDefult($slideItem){
    $slideItemRute = str_replace(JPATH_BASE,'',$slideItem);
    return $slideItemRute;
}

$slideshowImageOneRute = slideshowSetRutDefult($slideshowImageOne);
$slideshowImageTwoRute = slideshowSetRutDefult($slideshowImageTwo);
$slideshowImageThreeRute = slideshowSetRutDefult($slideshowImageThree);
$slideshowImageFourRute = slideshowSetRutDefult($slideshowImageFour);
//Icons

$iconOne = checkImage($this->params->get("iconOne", ""), "templates/js_tripod/images/icon-default-one.png");
$iconTwo = checkImage($this->params->get("iconTwo", ""), "templates/js_tripod/images/icon-default-two.png");
$iconThree = checkImage($this->params->get("iconThree", ""), "templates/js_tripod/images/icon-default-three.png");
$iconFour = checkImage($this->params->get("iconFour", ""), "templates/js_tripod/images/icon-default-four.png");
$iconOne = slideshowSetRutDefult($iconOne);
$iconTwo = slideshowSetRutDefult($iconTwo);
$iconThree = slideshowSetRutDefult($iconThree);
$iconFour = slideshowSetRutDefult($iconFour);


$tripodToolbarDisplayed = ($this->params->get('tripod_toolbar_displayed','1') == '1' ? true : false);

$tripodToolbarDisplayedClass = "";
if (!$tripodToolbarDisplayed){
    $tripodToolbarDisplayedClass = " tollbarNoDisplayed";
}