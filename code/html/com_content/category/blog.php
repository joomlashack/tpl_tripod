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
<?php


require_once(JPATH_THEMES.'/'.$app->getTemplate().'/'.'wright'.'/'.'html'.'/'.'overrider.php');
include(Overrider::getOverride('com_content.category','blog'));
?>