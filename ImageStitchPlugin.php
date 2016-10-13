<?php
/**
 * ImageStitch plugin for Craft CMS
 *
 * Render multiple images side-by-side as one.
 *
 * --snip--
 * Craft plugins are very much like little applications in and of themselves. We’ve made it as simple as we can,
 * but the training wheels are off. A little prior knowledge is going to be required to write a plugin.
 *
 * For the purposes of the plugin docs, we’re going to assume that you know PHP and SQL, as well as some semi-
 * advanced concepts like object-oriented programming and PHP namespaces.
 *
 * https://craftcms.com/docs/plugins/introduction
 * --snip--
 *
 * @author    ChaseGiunta
 * @copyright Copyright (c) 2016 ChaseGiunta
 * @link      twitter.com/chasegiunta
 * @package   ImageStitch
 * @since     1.0.0
 */

namespace Craft;

class ImageStitchPlugin extends BasePlugin
{
    public function init()
    {
    }

    public function getName()
    {
         return Craft::t('ImageStitch');
    }

    public function getDescription()
    {
        return Craft::t('Render multiple images side-by-side as one.');
    }

    public function getDocumentationUrl()
    {
        return 'https://github.com/chasegiunta/imagestitch/blob/master/README.md';
    }

    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/chasegiunta/imagestitch/master/releases.json';
    }

    public function getVersion()
    {
        return '1.0.0';
    }

    public function getDeveloper()
    {
        return 'ChaseGiunta';
    }

    public function getDeveloperUrl()
    {
        return 'twitter.com/chasegiunta';
    }

    public function hasCpSection()
    {
        return false;
    }

    public function addTwigExtension()
    {
        Craft::import('plugins.imagestitch.twigextensions.ImageStitchTwigExtension');

        return new ImageStitchTwigExtension();
    }

    protected function defineSettings()
    {
        return array(
            'stitchResultPath' => array(AttributeType::String, 'label' => 'Some Setting', 'default' => ''),
        );
    }

    public function getSettingsHtml()
    {
       return craft()->templates->render('imagestitch/ImageStitch_Settings', array(
           'settings' => $this->getSettings()
       ));
    }

}