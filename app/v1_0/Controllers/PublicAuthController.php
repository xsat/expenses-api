<?php

namespace App\v1_0\Controllers;

use Common\Mapper\UserMapper;
use Common\Validation\LoginValidation;
use Nen\Validation\Values;

/**
 * Class PublicAuthController
 */
class PublicAuthController extends Controller
{
    public function loginAction(): void
    {
        $values = new Values($this->request->getPut() ?? []);
        $validation = new LoginValidation();

        if (!$validation->validate($values)) {
            var_dump($validation->getMessages());
            exit;
        }

        $this->user = (new UserMapper($this->connection))
            ->findFirst('email = :email', [
                'email' => $values->getValue('email'),
            ]);

        if (!$this->user) {
            var_dump('User not found');
            exit;
        }

        if (!password_verify($values->getValue('password'), $this->user->getPassword())) {
            var_dump('Password is not correct');
            exit;
        }

        $accessToken = $this->auth->createToken($this->user);

        $this->response->setJsonContent([
            'token' => $accessToken->getToken(),
        ]);
    }
}
