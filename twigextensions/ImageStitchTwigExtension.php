<?php
/**
 * ImageStitch plugin for Craft CMS
 *
 * ImageStitch Twig Extension
 *
 * @author    ChaseGiunta
 * @copyright Copyright (c) 2016 ChaseGiunta
 * @link      twitter.com/chasegiunta
 * @package   ImageStitch
 * @since     1.0.0
 */

namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class ImageStitchTwigExtension extends \Twig_Extension
{
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'ImageStitch';
    }


    public function getFunctions()
    {
        return array(
            'imageStitch' => new \Twig_Function_Method($this, 'someInternalFunction'),
        );
    }

    public function someInternalFunction($name, $imageArray, $height = 50, $spacing = 0, $random = false, $quality = 100)
    {
        return craft()->imageStitch->stitch($name, $imageArray, $height, $spacing, $random, $quality);
    }
}