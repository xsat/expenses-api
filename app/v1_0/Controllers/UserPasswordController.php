<?php

namespace App\v1_0\Controllers;

use Common\Binder\PasswordBinder;
use Common\Mapper\UserMapper;
use Common\PasswordManager;
use Common\Validation\PasswordValidation;
use Nen\Exception\ValidationException;

/**
 * Class UserPasswordController
 */
class UserPasswordController extends PrivateController
{
    /**
     * @throws ValidationException
     */
    public function updateAction(): void
    {
        $mapper = new UserMapper($this->connection);
        $validation = new PasswordValidation();
        $binder = new PasswordBinder($this->request->getPut() ?? []);

        if (!$validation->validate($binder)) {
            throw new ValidationException($validation);
        }

        (new PasswordManager())->decode($binder, $this->user);

        $mapper->update($this->user);

        $this->response();
    }
}
