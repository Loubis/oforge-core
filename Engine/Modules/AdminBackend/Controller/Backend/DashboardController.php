<?php
namespace Oforge\Engine\Modules\AdminBackend\Controller\Backend;

use Oforge\Engine\Modules\AdminBackend\Abstracts\SecureBackendController;
use Oforge\Engine\Modules\Auth\Models\User\BackendUser;
use Slim\Http\Request;
use Slim\Http\Response;

class DashboardController extends SecureBackendController {


    public function indexAction(Request $request, Response $response) {

        $data = ['page_header' => 'Hello from the TestPlugin', 'page_header_description' => "Mega awesome optional additional description"];
        Oforge()->View()->assign($data);
    }


    public function buildAction(Request $request, Response $response) {
        Oforge()->Services()->get("assets.template")->build(Oforge()->View()->get("meta")["asset_scope"]);
    }


    public function fontAwesomeAction(Request $request, Response $response) {

    }

    public function ioniconsAction(Request $request, Response $response) {

    }

    public function testAction(Request $request, Response $response) {

    }

    public function initPermissions() {
        $this->ensurePermissions("testAction", BackendUser::class, BackendUser::ROLE_MODERATOR);
        $this->ensurePermissions("indexAction", BackendUser::class, BackendUser::ROLE_MODERATOR);
    }
}
