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
 * Class PasswordValidation
 */
class PasswordValidation extends Validation
{
    /**
     * PasswordValidation constructor.
     */
    public function __construct()
    {
        parent::__construct([
            new Presence('password', 'Can\'t be empty'),
            new Minimum('password', 6, 'The minimum length is 6'),
            new Maximum('password', 255, 'The maximum length is 255'),
        ]);
    }
}
