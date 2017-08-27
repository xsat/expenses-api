<?php

namespace App\v1_0\Controllers;

use Common\Mapper\UserMapper;
use Common\Validation\UserValidation;
use Nen\Exception\ValidationException;
use Common\Binder\UserBinder;

/**
 * Class UserController
 */
class UserController extends PrivateController
{
    public function viewAction(): void
    {
        $this->response([
            'user_id' => $this->user->getUserId(),
            'name' => $this->user->getName(),
            'email' => $this->user->getEmail(),
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function updateAction(): void
    {
        $mapper = new UserMapper($this->connection);
        $validation = new UserValidation($mapper, $this->user);
        $binder = new UserBinder($this->request->getPut() ?? []);

        if (!$validation->validate($binder)) {
            throw new ValidationException($validation);
        }

        $this->user->setName($binder->getName());
        $this->user->setEmail($binder->getEmail());
        $this->user->setPassword(
            password_hash($binder->getPassword(), PASSWORD_BCRYPT)
        );
        $mapper->update($this->user);

        $this->response();
    }

    public function deleteAction(): void
    {
        (new UserMapper($this->connection))->delete($this->user);

        $this->response();
    }
}
