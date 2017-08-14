<?php

namespace Common\Validation;

use Nen\Validation\Validation;
use Nen\Validation\Validator\Email;
use Nen\Validation\Validator\Presence;

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
            new Presence('email', 'Can\'t be empty.'),
            new Email('email', 'Email is not valid.'),
        ]);
    }
}
