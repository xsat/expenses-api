<?php

namespace App\v1_0\Controllers;

use Common\Mapper\UserMapper;
use Common\Model\User;
use Common\Validation\UserValidation;
use Nen\Validation\Values;

/**
 * Class PublicUserController
 */
class PublicUserController extends Controller
{
    public function createAction(): void
    {
        $mapper = new UserMapper($this->connection);
        $validation = new UserValidation($mapper);
        $values = new Values($this->request->getPut());

        if (!$validation->validate($values)) {
            var_dump($validation->getMessages());
            exit;
        }

        $this->user = new User();
        $this->user->setName($values->getValue('name'));
        $this->user->setEmail($values->getValue('email'));
        $this->user->setPassword(
            password_hash($values->getValue('password'), PASSWORD_BCRYPT)
        );
        $mapper->create($this->user);

        $accessToken = $this->auth->createToken($this->user);

        $this->response->setJsonContent([
            'token' => $accessToken->getToken(),
        ]);
    }
}
