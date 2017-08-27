<?php

namespace App\v1_0\Controllers;

/**
 * Class AuthController
 */
class AuthController extends PrivateController
{
    public function logoutAction(): void
    {
        $this->auth->deleteToken();

        $this->response();
    }
}
