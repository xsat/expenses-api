<?php

namespace Common\Validation;

use Nen\Validation\Validation;
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
            new Presence('password', 'Field `password` is required'),
            new Minimum('password', 6, 'Field `password` must be at least 6 characters long'),
            new Maximum('password', 255, 'Field `password` must not exceed 255 characters long'),
        ]);
    }
}
