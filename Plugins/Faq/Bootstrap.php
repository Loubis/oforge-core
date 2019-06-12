<?php

namespace Faq;

use Faq\Controller\Backend\BackendFaqController;
use Faq\Controller\Frontend\FrontendFaqController;
use Faq\Models\FaqModel;
use FrontendUserManagement\Services\AccountNavigationService;
use Oforge\Engine\Modules\AdminBackend\Core\Services\BackendNavigationService;
use Oforge\Engine\Modules\Core\Abstracts\AbstractBootstrap;

class Bootstrap extends AbstractBootstrap {
    /**
     * Bootstrap constructor.
     */
    public function __construct() {
        $this->endpoints = [
            BackendFaqController::class,
            FrontendFaqController::class,
        ];

        $this->models = [
            FaqModel::class,
        ];

        $this->dependencies = [
            \FrontendUserManagement\Bootstrap::class,
        ];
    }

    public function activate() {
        /** @var BackendNavigationService $sidebarNavigation */
        $sidebarNavigation = Oforge()->Services()->get('backend.navigation');
        $sidebarNavigation->put([
            'name'     => 'backend_faq',
            'order'    => 6,
            'parent'   => 'backend_content',
            'icon'     => 'fa fa-info-circle',
            'path'     => 'backend_faq',
            'position' => 'sidebar',
        ]);

        /** @var AccountNavigationService $accountNavigationService */
        $accountNavigationService = Oforge()->Services()->get('frontend.user.management.account.navigation');
        $accountNavigationService->put([
            'name'     => 'frontend_account_faq',
            'order'    => 13,
            'icon'     => 'profile',
            'path'     => 'frontend_account_faq',
            'position' => 'sidebar',
        ]);
    }
}