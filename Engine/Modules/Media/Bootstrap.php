<?php

namespace Oforge\Engine\Modules\Media;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Oforge\Engine\Modules\Core\Abstracts\AbstractBootstrap;
use Oforge\Engine\Modules\Core\Exceptions\ServiceNotFoundException;
use Oforge\Engine\Modules\Core\Exceptions\Template\TemplateNotFoundException;
use Oforge\Engine\Modules\Media\Controller\Backend\MediaController;
use Oforge\Engine\Modules\Media\Models\Media;
use Oforge\Engine\Modules\Media\Services\ImageCompressService;
use Oforge\Engine\Modules\Media\Services\MediaService;
use Oforge\Engine\Modules\Media\Twig\MediaExtension;
use Oforge\Engine\Modules\TemplateEngine\Core\Services\TemplateRenderService;
use Twig_Error_Loader;

/**
 * Class Bootstrap
 *
 * @package Oforge\Engine\Modules\Media
 */
class Bootstrap extends AbstractBootstrap {

    public function __construct() {
        $this->models = [
            Media::class,
        ];

        $this->services = [
            'media'          => MediaService::class,
            'image.compress' => ImageCompressService::class,
        ];

        $this->endpoints = [
            MediaController::class
        ];
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws ServiceNotFoundException
     * @throws TemplateNotFoundException
     * @throws Twig_Error_Loader
     */
    public function activate() {
        /** @var TemplateRenderService $templateRenderer */
        $templateRenderer = Oforge()->Services()->get('template.render');
        $templateRenderer->View()->addExtension(new MediaExtension());
    }
}
