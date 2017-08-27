<?php

namespace App\v1_0\Controllers;

use Common\Binder\UserBinder;
use Common\Mapper\UserMapper;
use Common\Model\User;
use Common\Validation\UserValidation;
use Nen\Exception\ValidationException;

/**
 * Class PublicUserController
 */
class PublicUserController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function createAction(): void
    {
        $mapper = new UserMapper($this->connection);
        $validation = new UserValidation($mapper);
        $binder = new UserBinder($this->request->getPut() ?? []);

        if (!$validation->validate($binder)) {
            throw new ValidationException($validation);
        }

        $this->user = new User();
        $this->user->setName($binder->getName());
        $this->user->setEmail($binder->getEmail());
        $this->user->setPassword(
            password_hash($binder->getPassword(), PASSWORD_BCRYPT)
        );
        $mapper->create($this->user);

        $accessToken = $this->auth->createToken($this->user);

        $this->response([
            'token' => $accessToken->getToken(),
        ]);
    }
}
