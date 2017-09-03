<?php

namespace Common\Validation;

use Common\Mapper\UserMapper;
use Common\Model\User;
use Common\Validation\Validator\UniqueEmail;
use Nen\Validation\Validation;
use Nen\Validation\Validator\Email;
use Nen\Validation\Validator\Maximum;
use Nen\Validation\Validator\Minimum;
use Nen\Validation\Validator\Presence;

/**
 * Class UserValidation
 */
class UserValidation extends Validation
{
    /**
     * UserValidation constructor.
     *
     * @param UserMapper $mapper
     * @param User|null $user
     */
    public function __construct(UserMapper $mapper, ?User $user = null)
    {
        parent::__construct([
            new Presence('name', 'Field `name` is required'),
            new Minimum('name', 1, 'Field `name` must be at least one character long'),
            new Maximum('name', 255, 'Field `name` must not exceed 255 characters long'),

            new Presence('email', 'Field `email` is required'),
            new Email('email', 'Field `email` must be an email address'),
            new UniqueEmail('email', $mapper, $user, 'Field `email` must be unique'),
            new Maximum('email', 255, 'Field `email` must not exceed 255 characters long'),
        ]);
    }
}
