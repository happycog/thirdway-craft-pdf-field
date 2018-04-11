<?php
/**
 * PDF Field plugin for Craft CMS 3.x
 *
 * Requests a new PDF for a product on save
 *
 * @link      http://bletchley.co/
 * @copyright Copyright (c) 2018 Andy Skogrand
 */

namespace bletchley\pdffield\services;

use bletchley\pdffield\PdfField;

use Craft;
use craft\base\Component;

/**
 * Pdfserviceresponse Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Andy Skogrand
 * @package   PdfField
 * @since     1.0.0
 */
class Pdfserviceresponse extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     PdfField::$plugin->pdfserviceresponse->exampleService()
     *
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';

        return $result;
    }
}
