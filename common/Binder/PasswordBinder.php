<?php

namespace Common\Binder;

use Common\PasswordInterface;
use Nen\Binder\Binder;

/**
 * Class PasswordBinder
 */
class PasswordBinder extends Binder implements PasswordInterface
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
