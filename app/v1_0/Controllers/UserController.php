<?php

namespace App\v1_0\Controllers;

use Common\Mapper\UserMapper;
use Common\Validation\UserValidation;
use Nen\Exception\ValidationException;
use Nen\Validation\Values;

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
        $values = new Values($this->request->getPut() ?? []);

        if (!$validation->validate($values)) {
            throw new ValidationException($validation);
        }

        $this->user->setName($values->getValue('name'));
        $this->user->setEmail($values->getValue('email'));
        $this->user->setPassword(
            password_hash($values->getValue('password'), PASSWORD_BCRYPT)
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
