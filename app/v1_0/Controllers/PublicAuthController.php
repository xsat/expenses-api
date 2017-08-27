<?php

namespace App\v1_0\Controllers;

use Common\Binder\LoginBinder;
use Common\Mapper\UserMapper;
use Common\Validation\LoginValidation;
use Nen\Exception\ForbiddenException;
use Nen\Exception\ValidationException;

/**
 * Class PublicAuthController
 */
class PublicAuthController extends Controller
{
    /**
     * @throws ValidationException
     * @throws ForbiddenException
     */
    public function loginAction(): void
    {
        $binder = new LoginBinder($this->request->getPut() ?? []);
        $validation = new LoginValidation();

        if (!$validation->validate($binder)) {
            throw new ValidationException($validation);
        }

        $this->user = (new UserMapper($this->connection))
            ->findFirst('email = :email', [
                'email' => $binder->getEmail(),
            ]);

        if (!$this->user) {
            throw new ForbiddenException('Email or password is not correct');
        }

        if (!password_verify($binder->getPassword(), $this->user->getPassword())) {
            throw new ForbiddenException('Email or password is not correct');
        }

        $accessToken = $this->auth->createToken($this->user);

        $this->response([
            'token' => $accessToken->getToken(),
        ]);
    }
}
