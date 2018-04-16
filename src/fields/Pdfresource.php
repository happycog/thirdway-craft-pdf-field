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

    // Static Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('pdf-renderer', 'Pdf Resource');
    }

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getContentColumnType(): string
    {
        return Schema::TYPE_BOOLEAN;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function normalizeValue($value, ElementInterface $element = null)
    {
        // Unlike other boolean fields, null is an option
        // False = error occurred
        // True = pdf exists
        return ($value === null) ? $value : (bool) $value ;
    }

    /**
     * @inheritdoc
     */
    public function serializeValue($value, ElementInterface $element = null)
    {
        var_dump($value);
        return parent::serializeValue($value, $element);
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

        // Render the input template
        return Craft::$app->getView()->renderTemplate(
            'pdf-renderer/_components/fields/Pdfresource_input',
            [
                'name' => $this->handle,
                'value' => $value,
                'field' => $this,
                'id' => $id,
                'namespacedId' => $namespacedId,
            ]
        );
    }
}
