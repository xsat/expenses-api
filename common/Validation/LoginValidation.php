<?php

namespace Common\Validation;

use Nen\Validation\Validation;
use Nen\Validation\Validator\Email;
use Nen\Validation\Validator\Presence;
use Nen\Validation\Validator\Maximum;

/**
 * Class LoginValidation
 */
class LoginValidation extends Validation
{
    /**
     * LoginValidation constructor.
     */
    public function __construct()
    {
        parent::__construct([
            new Presence('email', 'Can\'t be empty'),
            new Email('email', 'Email is not valid'),
            new Maximum('email', 255, 'The maximum length is 255'),

            new Presence('password', 'Can\'t be empty'),
            new Maximum('password', 255, 'The maximum length is 255'),
        ]);
    }
}
