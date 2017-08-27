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
            new Maximum('note', 255, 'The maximum length is 255'),

            new Presence('cost', 'Can\'t be empty'),
            new Numerical('cost', 'Cost is not valid'),

            new Date('spent_date', 'Y-m-d H:i:s', 'Date is not valid'),
        ]);
    }
}
