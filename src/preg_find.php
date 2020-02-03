<?php
/**
 * @package     Tripod
 * @subpackage  preg_find
 *
 * @copyright   Copyright (C) 2005 - 2020 Joomlashack. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// Restrict Access to within Joomla
defined('_JEXEC') or die('Restricted access');

/**
 * Custom function to get images from a given folder
 *
 * @param   string  $wDirectory Folder that contain images
 *
 * @return  string
 */
function wGetImages($wDirectory) {

    $wImages = array();
    $wHandle = opendir($wDirectory);

    while ($wFile = readdir($wHandle)) {

        // Exclude some file extensions
        if($wFile!= "." && $wFile!= ".." && $wFile!="Thumbs.db"){

            // Be sure to get only png and jpg images
            $wValidate = explode('.',$wFile);
            if($wValidate[1] == 'jpg' || $wValidate[1] == 'JPG' || $wValidate[1] == 'png' || $wValidate[1] == 'PNG'){
                $wImages[] = $wFile;
            }
        }
    }

    // Order values in alphabetical order
    sort($wImages, SORT_NATURAL);

    return $wImages;
}