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
            new Presence('email', 'Field `email` is required'),
            new Email('email', 'Field `email` must be an email address'),
            new Maximum('email', 255, 'Field `email` must not exceed 255 characters long'),

            new Presence('password', 'Field `password` is required'),
            new Maximum('password', 255, 'Field `password` must not exceed 255 characters long'),
        ]);
    }
}
