<?php
/*
 * Limb PHP Framework
 *
 * @link http://limb-project.com
 * @copyright  Copyright &copy; 2004-2007 BIT(http://bit-creative.com)
 * @license    LGPL http://www.gnu.org/copyleft/lesser.html
 */

/**
 * @package imagekit
 * @version $Id$
 */
lmb_require(dirname(__FILE__).'/../../lmbAbstractImageFilter.class.php');

/**
 * Resize image filter
 * @package imagekit
 * @version $Id$
 */
class lmbGdResizeImageFilter extends lmbAbstractImageFilter
{

  function run(lmbAbstractImageContainer $container)
  {
    $src_w = $container->getWidth();
    $src_h = $container->getHeight();
    list($dst_w, $dst_h) = $this->calcNewSize($src_w, $src_h);
    $im = imagecreatetruecolor($dst_w, $dst_h);
    imagecopyresampled($im, $container->getResource(), 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    $container->replaceResource($im);
  }

  protected function calcNewSize($src_w, $src_h)
  {
    $dst_w = $this->getWidth();
    if(!$dst_w) $dst_w = $src_w;
    $dst_h = $this->getheight();
    if(!$dst_h) $dst_h = $src_h;
    //return array($dst_w, $dst_h);
    return $this->calcSize($src_w, $src_h, $dst_w, $dst_h, $this->getPreserveAspectRatio(), $this->getSaveMinSize());
  }

  function getWidth()
  {
  	return $this->getParam('width', 0);
  }

  function getHeight()
  {
    return $this->getParam('height', 1);
  }

  function getPreserveAspectRatio()
  {
    return $this->getParam('preserve_aspect_ratio', 2, true);
  }

  function getSaveMinSize()
  {
    return $this->getParam('save_min_size', 3, false);
  }
}
?>