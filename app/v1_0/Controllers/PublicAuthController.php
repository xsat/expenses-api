<?php

namespace App\v1_0\Controllers;

use App\Controllers\BaseController;
use Common\Mapper\AccessTokenMapper;
use Common\Mapper\UserMapper;
use Common\Model\AccessToken;
use Common\Validation\LoginValidation;
use Nen\Database\Connection;
use Nen\Validation\Values;

/**
 * Class PublicAuthController
 */
class PublicAuthController extends BaseController
{
    public function loginAction(): void
    {
        $values = new Values($this->request->getPut());
        $validation = new LoginValidation();

        if (!$validation->validate($values)) {
            var_dump($validation->getMessages());
            exit;
        }

        $connection = Connection::getInstance();
        $mapper = new UserMapper($connection);
        $user = $mapper->findFirst('email = :email', [
            'email' => $values->getValue('email'),
        ]);

        if (!$user) {
            var_dump('User not found');
            exit;
        }

        if (!password_verify($values->getValue('password'), $user->getPassword())) {
            var_dump('Password is not correct');
            exit;
        }

        $mapper = new AccessTokenMapper($connection);
        $accessToken = new AccessToken(
            null,
            $user->getUserId(),
            md5(random_bytes(100))
        );
    }
}
