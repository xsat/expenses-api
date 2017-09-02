<?php

namespace Common;

/**
 * Class PasswordManager
 */
class PasswordManager
{
    /**
     * @param PasswordInterface $binderPassword
     * @param PasswordInterface $userPassword
     *
     * @return bool
     */
    public function isVerified(
        PasswordInterface $binderPassword,
        PasswordInterface $userPassword
    ): bool
    {
        return password_verify(
            $binderPassword->getPassword(),
            $userPassword->getPassword()
        );
    }

    /**
     * @param PasswordInterface $binderPassword
     * @param PasswordInterface $userPassword
     */
    public function decode(
        PasswordInterface $binderPassword,
        PasswordInterface $userPassword
    ): void
    {
        $userPassword->setPassword(
            password_hash($binderPassword->getPassword(), PASSWORD_BCRYPT)
        );
    }
}
