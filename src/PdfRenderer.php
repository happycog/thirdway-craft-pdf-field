<?php
/**
 * Pdf Renderer plugin for Craft CMS 3.x
 *
 * Trigger a new PDF to be rendered for a Thirdway product
 *
 * @link      http://bletchley.co
 * @copyright Copyright (c) 2018 Andy Skogrand
 */

namespace bletchley\pdfrenderer;

use bletchley\pdfrenderer\fields\Pdfresource as pdfresourcefield;

use \Datetime;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\services\Fields;
use craft\events\RegisterComponentTypesEvent;

use craft\base\Element;
use craft\elements\db\ElementQuery;
use craft\events\ElementEvent;
use craft\events\ElementStructureEvent;
use craft\services\Elements;

use yii\base\Event;

/**
 * Class pdfrenderer
 *
 * @author    Andy Skogrand
 * @package   pdfrenderer
 * @since     1.0.0
 *
 */

/**
* 0: A PDF has not been generated
* 1: PDF Saved
* 2: An error occurred saving the PDF
* 3: A PDF is being generated
*/

class pdfrenderer extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var pdfrenderer
     */
    public static $plugin;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = pdfresourcefield::class;
            }
        );

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Event::on(
            Elements::class,
            Elements::EVENT_BEFORE_SAVE_ELEMENT,
            function ($event) {
                // Use env for the URL below
                if((int)$event->element->productPdf === 3 && $event->element->enabled) {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://thirdway-pdf-renderer.herokuapp.com/" . $event->element->id . "/" .$event->element->uri);
                    curl_exec($ch);
                    curl_close($ch);
                }
            }
        );

        Craft::info(
            Craft::t(
                'pdf-renderer',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
