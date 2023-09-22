<?php
/**
 * Pdf Renderer plugin for Craft CMS 3.x
 *
 * Trigger a new PDF to be rendered for a Thirdway product
 *
 * @link      http://bletchley.co
 * @copyright Copyright (c) 2018 Andy Skogrand
 */

namespace bletchley\pdfrenderer\fields;

use bletchley\pdfrenderer\pdfrenderer;
use bletchley\pdfrenderer\assetbundles\pdfresourcefield\pdfresourcefieldAsset;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\helpers\Db;
use craft\helpers\ElementHelper;
use yii\db\Schema;
use craft\helpers\Json;

/**
 * @author    Andy Skogrand
 * @package   pdfrenderer
 * @since     1.0.0
 */
class Pdfresource extends Field
{
    // Public Properties
    // =========================================================================
    public $codes = [0, 1, 2];
    public $error_code = 2;

    // Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('pdfrenderer', 'Pdf Resource');
    }

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getContentColumnType(): string
    {
        return Db::getNumericalColumnType(0, 3, 0);
    }

    /**
     * @inheritdoc
     */
    public function serializeValue($value, ElementInterface $element = null)
    {
        return ((int)$value != 1) ? 0 : 1;
    }

    /**
     * @inheritdoc
     */
    public function normalizeValue($value, ElementInterface $element = null)
    {
        return $value;
    }

    /**
     * @inheritdoc
     */
    public function getInputHtml($value, ElementInterface $element = null): string
    {
        // Register our asset bundle
        Craft::$app->getView()->registerAssetBundle(pdfresourcefieldAsset::class);

        // Get our id and namespace
        $id = Craft::$app->getView()->formatInputId($this->handle);
        $namespacedId = Craft::$app->getView()->namespaceInputId($id);
        $volume = Craft::$app->getVolumes()->getAllVolumes()[0];

        // Render the input template
        return Craft::$app->getView()->renderTemplate(
            'pdfrenderer/_components/fields/Pdfresource_input',
            [
                'name' => $this->handle,
                'value' => $value,
                'field' => $this,
                'id' => $id,
                'namespacedId' => $namespacedId,
                'slug' => $element->slug,
                'volume' => $volume,
                'isDraftOrRevision' => ElementHelper::isDraftOrRevision($element)
            ]
        );
    }
}
