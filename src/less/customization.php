<?php
/**
 * @package     Wright
 * @subpackage  Template File
 *
 * @copyright   Copyright (C) 2005 - 2019 Joomlashack.   All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

// Access template parameters
$document = JFactory::getDocument();

// Don't modify this file!
// Set your variables overrides for variables-something.less.
// These variables overrides are defined on templateDetails.xml below 'style' field
$lessCustomizationVars = array (
    '@color_two'    => $document->params->get('color_two', '#FFBF00')
);

// Check the selected variation style to choose between 'yellow-black' (default style) or 'white-gray'
if($document->params->get('styleVariation', 'black') == 'black') {
    $baseStyle = 'yellow-black';
}
else
{
    $baseStyle = 'white-gray';
}

// Run the compiler
require_once dirname(__FILE__) . '/../wright/build/less/compiler.php';
$build = new WrightLessCompiler;
$build->start($baseStyle, $lessCustomizationVars);