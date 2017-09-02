<?php

namespace Common\Binder;

use Common\PasswordInterface;

/**
 * Class UserWithPasswordBinder
 */
class UserWithPasswordBinder extends UserBinder implements PasswordInterface
{
    /**
     * @var string
     */
    private $password;

    /**
     * @return null|string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param null|string $password
     */
    public function setPassword(?string $password)
    {
        $this->password = $password;
    }
}
