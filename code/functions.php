
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

$mainContainer = $containerClass;
$mainGridMode = $gridMode;
$mainSpan = 'span12';

$mainComplementContainer = '';
$mainComplementGridMode = '';
$mainComplementSpan = '';
$wrightTemplate = WrightTemplate::getInstance();
if ($tripodFullWidthBg && $sidebarExists == '') {
    $mainContainer = '';
    $mainGridMode = '';
    $wrightTemplate->useMainSpans = false;
    $mainSpan = '';
    $mainComplementContainer = $containerClass;
    $mainComplementGridMode = $gridMode;
    $mainComplementSpan = 'span12';
}
