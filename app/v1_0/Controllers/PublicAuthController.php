<?php

namespace App\v1_0\Controllers;

use Common\Mapper\UserMapper;
use Common\Validation\LoginValidation;
use Nen\Exception\ForbiddenException;
use Nen\Exception\ValidationException;
use Nen\Validation\Values;

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
        $values = new Values($this->request->getPut() ?? []);
        $validation = new LoginValidation();

        if (!$validation->validate($values)) {
            throw new ValidationException($validation);
        }

        $this->user = (new UserMapper($this->connection))
            ->findFirst('email = :email', [
                'email' => $values->getValue('email'),
            ]);

        if (!$this->user) {
            throw new ForbiddenException('Email or password is not correct');
        }

        if (!password_verify($values->getValue('password'), $this->user->getPassword())) {
            throw new ForbiddenException('Email or password is not correct');
        }

        $accessToken = $this->auth->createToken($this->user);

        $this->response([
            'token' => $accessToken->getToken(),
        ]);
    }
}
