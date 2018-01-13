<?php

namespace App\v1_0\Controllers;

use Common\Binder\LoginBinder;
use Common\Formatter\AccessTokenFormatter;
use Common\Mapper\UserMapper;
use Common\PasswordManager;
use Common\Validation\LoginValidation;
use Exception;
use Nen\Exception\UnauthorizedException;
use Nen\Exception\ValidationException;

/**
 * Class PublicAuthController
 */
class PublicAuthController extends Controller
{
    /**
     * @throws ValidationException
     * @throws UnauthorizedException
     * @throws Exception
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
            throw new UnauthorizedException('Email or password is not correct');
        }

        if (!(new PasswordManager())->isVerified($binder, $this->user)) {
            throw new UnauthorizedException('Email or password is not correct');
        }

        $accessToken = $this->auth->createToken($this->user);

        $this->format(new AccessTokenFormatter($accessToken));
    }
}
