<?php
/**
 * Pdf Renderer plugin for Craft CMS 3.x
 *
 * Trigger a new PDF to be rendered for a Thirdway product
 *
 * @link      http://bletchley.co
 * @copyright Copyright (c) 2018 Andy Skogrand
 */

namespace bletchley\pdfrenderer\assetbundles\pdfresourcefield;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Andy Skogrand
 * @package   pdfrenderer
 * @since     1.0.0
 */
class pdfresourcefieldAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@bletchley/pdfrenderer/assetbundles/pdfresourcefield/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/Pdfresource.js',
        ];

        $this->css = [
            'css/Pdfresource.css',
        ];

        parent::init();
    }
}
