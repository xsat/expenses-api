<?php

namespace App\v1_0\Controllers;

use App\Controllers\BaseController;
use Common\Mapper\AccessTokenMapper;
use Common\Mapper\UserMapper;
use Common\Model\AccessToken;
use Common\Model\User;
use Common\Validation\UserValidation;
use Nen\Database\Connection;
use Nen\Validation\Values;

/**
 * Class PublicUserController
 */
class PublicUserController extends BaseController
{
    public function createAction(): void
    {
        $connection = Connection::getInstance();
        $mapper = new UserMapper($connection);
        $validation = new UserValidation($mapper);
        $values = new Values($this->request->getPut());

        if (!$validation->validate($values)) {
            var_dump($validation->getMessages());
            exit;
        }

        $user = new User();

        $user->setName($values->getValue('name'));
        $user->setEmail($values->getValue('email'));
        $user->setPassword(
            password_hash($values->getValue('password'), PASSWORD_BCRYPT)
        );
        $mapper->create($user);

        $accessToken = new AccessToken();
        $accessToken->setUserId($user->getUserId());
        $accessToken->setToken(md5(random_bytes(100)));
        (new AccessTokenMapper($connection))->create($accessToken);

        $this->response->setJsonContent([
            'token' => $accessToken->getToken(),
        ]);
    }
}
