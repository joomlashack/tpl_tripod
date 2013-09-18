<?php
/**
 * @package     Parallax
 * @subpackage  Overrider
 *
 * @copyright   Copyright (C) 2005 - 2013 Joomlashack. Meritage Assets.  All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();

// disables spans in Wright post-override
global $wright_joomla_content_category_blog_nocols;
$wright_joomla_content_category_blog_nocols = false;

// get titles
$titles = Array();
$parallax_sp = Array();
$i = 0;


$arItems = Array();

if (sizeof($this->lead_items)) {
        foreach ($this->lead_items as &$item) {
                $titles[$i++] = $item->title;
        }
}

$keyc = 1;
if (sizeof($this->intro_items)) {
        foreach ($this->intro_items as $key => &$item) {
                $rowcount=(((int)$keyc-1) % (int) $this->columns) +1;
                if ($rowcount==1) {
                        $titles[$i++] = $item->title;
                }
                elseif ($rowcount <= 3) {
                        $titles[$i-1] .= " | " . $item->title;
                }
                $keyc++;
        }
}


?>
        <div id="parallax_blog_titles">
            <div class="navbar-inner menu-big-items">
                <ul class="scrolling hidden-phone nav">
                    <li id="nav_parallax_top">
                            <a href="#" rel="top">Top</a>
                    </li>
                    <li id="nav_parallax_pagefirst">
                            <a href="#" rel="parallax_pagefirst">Featured</a>
                    </li>
                    <li id="nav_parallax_catdesc">
                            <a href="#" rel="parallax_catdesc">Category description</a>
                    </li>
<?php
        $i = 0;
        foreach ($titles as $title) :
?>
                        <li>
                                <a rel="parallax_post_<?php echo $i ?>" href='#'>
                                        <?php echo $title ?>
                                </a>
                        </li>
<?php
                $i++;
        endforeach;
?>
                    <li id="nav_parallax_morearticles">
                            <a href="#" rel="parallax_morearticles">More articles</a>
                    </li>
                    <li id="nav_parallax_subcategories">
                            <a href="#" rel="parallax_subcategories">Subcategories</a>
                    </li>
                    <li id="nav_parallax_pagelast">
                            <a href="#" rel="parallax_pagelast">Bottom</a>
                    </li>
                </ul>
            </div>
        </div>
<?php

    $template = $app->getTemplate(true);

    $gridMode = $template->params->get('bs_rowmode','row');
    $containerClass = 'container';
    $containerClass = ($gridMode == 'row-fluid' ? 'container-fluid' : 'container');

    $sidebarExists = (JModuleHelper::getModules('sidebar1') || JModuleHelper::getModules('sidebar2'));  // check if there's a sidebar at all
    $tripodFullWidthBg = ($template->params->get('singleScrollingPage','1') == '1' ? true : false);


    $this->wrightLeadingExtraClass = 'full-leading';
    if ($tripodFullWidthBg && !$sidebarExists) {


        $this->wrightLeadingItemElementsStructure = Array(
                'div.' . $containerClass,
                    'div.' . $gridMode,
                        'div.span12',
                            'div.leading-content',
                                'title',
                                'icons',
                                'article-info',
                                'image',
                                'content',
                            '/div',
                        '/div',
                    '/div',
                '/div',
        );

        $this->wrightIntroItemsClass = $containerClass;  // Class added to the intro articles (adds an extra wrapper)
        $this->wrightIntroRowMode = $gridMode;  // row mode for each row of the intro articles

        $this->wrightComplementOuterClass = $containerClass; // Class added to the complements (links, subcategories and pagination) - adds an extra wrapper for all of them
        $this->wrightComplementExtraClass = $gridMode; // Class added to each complement (links, subcategories and pagination - as blocks).  Adds an extra wrapper before the "Inner" div
        $this->wrightComplementInnerClass = 'span12'; // Class added to each complement (links, subcategories and pagination - as blocks).  Adds an extra wrapper when needed, or uses the existing one if found
    }

require_once(JPATH_THEMES.'/'.$app->getTemplate().'/'.'wright'.'/'.'html'.'/'.'overrider.php');
include(Overrider::getOverride('com_content.featured'));
?>