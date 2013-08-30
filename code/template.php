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
</head>
<body class="<?php echo $responsive ?>">
    <?php if ($this->countModules('toolbar')) : ?>
    <!-- menu -->
	<w:nav containerClass="<?php echo $containerClass ?>" rowClass="<?php echo $gridMode;?>" wrapClass="navbar-fixed-top" type="toolbar" name="toolbar" />
    <?php endif; ?>
    <div class="<?php echo $containerClass ?>">
        <!-- header -->
        <header id="header">
        	<div class="<?php echo $gridMode; ?> clearfix">
        		<w:logo name="top" />
        		<div class="clear"></div>
        	</div>
        </header>
        <?php if ($this->countModules('menu')) : ?>
        <!-- menu -->
   		<w:nav name="menu" />
        <?php endif; ?>
        <!-- featured -->
        <?php if ($this->countModules('featured')) : ?>
        <div id="featured">
            <w:module type="none" name="featured" chrome="xhtml" />
        </div>
        <?php endif; ?>
        <!-- grid-top -->
        <?php if ($this->countModules('grid-top')) : ?>
        <div id="grid-top">
            <w:module type="<?php echo $gridMode; ?>" name="grid-top" chrome="wrightflexgrid" />
        </div>
        <?php endif; ?>
        <?php if ($this->countModules('grid-top2')) : ?>
        <!-- grid-top2 -->
        <div id="grid-top2">
            <w:module type="<?php echo $gridMode; ?>" name="grid-top2" chrome="wrightflexgrid" />
        </div>
        <?php endif; ?>
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
        <?php if ($this->countModules('bottom-menu')) : ?>
        <!-- bottom-menu -->
		<w:nav containerClass="<?php echo $containerClass ?>" rowClass="<?php echo $gridMode;?>" name="bottom-menu" />
        <?php endif; ?>

    </div>

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
