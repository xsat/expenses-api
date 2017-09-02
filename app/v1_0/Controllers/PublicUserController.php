<?php

namespace App\v1_0\Controllers;

use Common\Binder\UserWithPasswordBinder;
use Common\Formatter\AccessTokenFormatter;
use Common\Mapper\UserMapper;
use Common\Model\User;
use Common\PasswordManager;
use Common\Validation\UserWithPasswordValidation;
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
        $validation = new UserWithPasswordValidation($mapper);
        $binder = new UserWithPasswordBinder($this->request->getPut() ?? []);

        if (!$validation->validate($binder)) {
            throw new ValidationException($validation);
        }

        $this->user = new User();
        $this->user->setName($binder->getName());
        $this->user->setEmail($binder->getEmail());

        (new PasswordManager())->decode($binder, $this->user);

        $mapper->create($this->user);

        $accessToken = $this->auth->createToken($this->user);

        $this->format(new AccessTokenFormatter($accessToken));
    }
}
