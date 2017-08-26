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
        $user = (new UserMapper($connection))->findFirst('email = :email', [
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

        $accessToken = new AccessToken();
        $accessToken->setUserId($user->getUserId());
        $accessToken->setToken(md5(random_bytes(100)));
        (new AccessTokenMapper($connection))->create($accessToken);

        $this->response->setJsonContent([
            'token' => $accessToken->getToken(),
        ]);
    }
}
