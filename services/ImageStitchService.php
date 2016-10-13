<?php
/**
 * ImageStitch plugin for Craft CMS
 *
 * ImageStitch Service
 *
 * @author    ChaseGiunta
 * @copyright Copyright (c) 2016 ChaseGiunta
 * @link      twitter.com/chasegiunta
 * @package   ImageStitch
 * @since     1.0.0
 */

namespace Craft;

class ImageStitchService extends BaseApplicationComponent
{

    public function stitch($filename, $imageArray, $height = 50, $spacing = 0, $random = false)
    {
      $canvasWidth = 0;
      $images_widths = array();
      $images_heights = array();

      if ($random == true) {
        shuffle($imageArray);
      }

      // Loop through original image URLs, create images from them, and add them to an $images array (why? idk)
      foreach($imageArray as $keyfoo => $originalImage)
      {
        $pieces = explode('.', $originalImage);

        if ($pieces[count($pieces)-1] == 'png')
        {
          // Convert logo URL to image resource (with transparency)
          $imageResource = imagecreatefrompng($originalImage);

          // Get proportional resize dimensions
          list($resizedWidth, $resizedHeight, $originalImage_width, $originalImage_height) = $this->getResizeDimensions($originalImage, $height);

          // Scale PNG and retain Transparency:
          // Source: http://stackoverflow.com/a/279310/4565664
          $newImg = imagecreatetruecolor($resizedWidth + $spacing, $resizedHeight);
          imageAlphaBlending($newImg, false);
          imageSaveAlpha($newImg, true);

          $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
          imagefilledrectangle($newImg, 0, 0, $resizedWidth + $spacing, $resizedHeight, $transparent);
          imagecopyresampled($newImg, $imageResource, 0, 0, 0, 0, $resizedWidth, $resizedHeight, $originalImage_width, $originalImage_height);

          //Add new, scaled, transparent bg images to images array
          $images[] = $newImg;

          /*
          // Debugging: Output each image by itself
          $path = craft()->path->getTempPath();
          $destination = $path.$keyfoo.'.png';
          imagepng($newImg, $destination);
          */

          // Append the resized Logo width onto our canvasWidth sum
          $canvasWidth = $canvasWidth + floor($resizedWidth) + $spacing;
          $images_widths[] = floor($resizedWidth) + $spacing;
        }
      }

      // Create new canvas with desired dimensions
      $canvas = imagecreatetruecolor($canvasWidth, $height);

      $offset = 0;
      foreach($images as $key => $image)
      {
        imageAlphaBlending($canvas, false);
        imageSaveAlpha($canvas, true);
        imagecopy($canvas, $image, $offset, 0, 0, 0, $images_widths[$key], $height);
        $offset = $offset + $images_widths[$key];
      }

      $pluginSettings = craft()->plugins->getPlugin('imageStitch')->getSettings();
      $path = $pluginSettings->stitchResultPath;

      $destination_image = $path.$filename;
      imagepng($canvas, $destination_image);

      return $destination_image;
    }


    public function getResizeDimensions($image, $height)
    {
      // Source: http://stackoverflow.com/a/16627759/4565664
      list($image_width, $image_height) = getimagesize($image);
      $ar = $image_width / $image_height;

      if ($ar < 1)
      { // "Taller" image
        $resizedWidth = min($height * $ar, $image_width);
        $resizedHeight = $resizedWidth / $ar;
      } else {
        // "Wider" image
        $resizedHeight = min($image_width / $ar, $height);
        $resizedWidth = $resizedHeight * $ar;
      }

      return array ($resizedWidth, $resizedHeight, $image_width, $image_height);
    }

}