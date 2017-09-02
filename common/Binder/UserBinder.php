<?php

namespace Common\Binder;

use Nen\Binder\Binder;

/**
 * Class UserBinder
 */
class UserBinder extends Binder
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName(?string $name)
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param null|string $email
     */
    public function setEmail(?string $email)
    {
        $this->email = $email;
    }
}
