<?php

namespace App\v1_0\Controllers;

use App\Controllers\BaseController;
use Common\Mapper\UserMapper;
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
        $mapper = new UserMapper(Connection::getInstance());
        $validation = new UserValidation($mapper);
        $values = new Values($this->request->getPut());

        if (!$validation->validate($values)) {
            var_dump($validation->getMessages());
            exit;
        }

        $user = new User(
            null,
            $values->getValue('name'),
            $values->getValue('email'),
            password_hash($values->getValue('password'), PASSWORD_BCRYPT)
        );

        $mapper->create($user);



        $this->response->setJsonContent();
    }
}
