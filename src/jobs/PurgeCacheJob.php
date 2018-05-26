<?php
/**
 * Pdf Renderer plugin for Craft CMS 3.x
 *
 * Trigger a new PDF to be rendered for a Thirdway product
 *
 * @link      http://bletchley.co
 * @copyright Copyright (c) 2018 Andy Skogrand
 */

namespace bletchley\pdfrenderer\jobs;

use Craft;
use craft\queue\BaseJob;

/**
 * Class PurgeCache
 *
 * @package bletchley\pdfrenderer\jobs
 */
class PurgeCacheJob extends BaseJob
{
    /**
     * @var string tag
     */
    public $id;
    public $path;

    /**
     * @inheritdoc
     */
    public function execute($queue)
    {
        if (!$this->path) {
            return false;
        }

        file_get_contents($this->path);
    }


    /**
     * @inheritdoc
     */
    protected function defaultDescription(): string
    {
        return Craft::t('pdf-renderer', 'Render PDF for ID {tag}', ['tag' => $this->id]);
    }
}
