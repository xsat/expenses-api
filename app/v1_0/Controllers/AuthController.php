<?php

namespace App\v1_0\Controllers;

use stdClass;

/**
 * Class AuthController
 */
class AuthController extends PrivateController
{
    public function logoutAction(): void
    {
        $this->auth->deleteToken();

        $this->response->setJsonContent(new stdClass());
    }
}
