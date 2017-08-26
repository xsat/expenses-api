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
            new Presence('name', 'Can\'t be empty'),
            new Minimum('name', 1, 'The minimum length is 1'),
            new Maximum('name', 255, 'The maximum length is 255'),

            new Presence('email', 'Can\'t be empty'),
            new Email('email', 'Email is not valid'),
            new UniqueEmail('email', $mapper, $user, 'Email is not available'),
            new Maximum('password', 255, 'The maximum length is 255'),

            new Presence('password', 'Can\'t be empty'),
            new Minimum('password', 6, 'The minimum length is 6'),
            new Maximum('password', 255, 'The maximum length is 255'),
        ]);
    }
}
