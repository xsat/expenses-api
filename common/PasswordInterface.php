<?php

namespace Common;

/**
 * Interface PasswordInterface
 */
interface PasswordInterface {
    /**
     * @return null|string
     */
    public function getPassword(): ?string;

    /**
     * @param null|string $password
     */
    public function setPassword(?string $password): void;
}
