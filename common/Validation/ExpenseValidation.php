<?php

namespace Common\Validation;

use Common\Validation\Validator\Date;
use Nen\Validation\Validation;
use Nen\Validation\Validator\Maximum;
use Nen\Validation\Validator\Numerical;
use Nen\Validation\Validator\Presence;

/**
 * Class ExpenseValidation
 */
class ExpenseValidation extends Validation
{
    /**
     * ExpenseValidation constructor.
     */
    public function __construct()
    {
        parent::__construct([
            new Maximum('note', 255, 'Field `note` must not exceed 255 characters long'),

            new Presence('cost', 'Field `cost` is required'),
            new Numerical('cost', 'Field `cost` must be numeric'),

            new Date('spent_date', 'Y-m-d H:i:s', 'Field `spent_date` is not a valid date'),
        ]);
    }
}
