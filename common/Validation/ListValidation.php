<?php

namespace Common\Validation;

use Common\Binder\ListBinder;
use Common\Validation\Validator\Date;
use Nen\Validation\Validation;
use Nen\Validation\Validator\Maximum;
use Nen\Validation\Validator\Numerical;
use Nen\Validation\Validator\Range;

/**
 * Class ListValidation
 */
class ListValidation extends Validation
{
    /**
     * @var array
     */
    private $orders = [
        ListBinder::ORDER_EXPIRY_DATE,
        ListBinder::ORDER_EXPENSE_ID,
        ListBinder::ORDER_NOTE,
    ];

    /**
     * @var array
     */
    private $sorts = [
        ListBinder::SORT_DESC,
        ListBinder::SORT_ASC,
    ];

    /**
     * ListValidation constructor.
     */
    public function __construct()
    {
        parent::__construct([
            new Numerical('offset', 'Offset is not valid'),

            new Numerical('limit', 'Limit is not valid'),

            new Range('order', $this->orders, 'Order is not valid'),

            new Range('sort', $this->sorts, 'Sort is not valid'),

            new Maximum('search', 255, 'The maximum length is 255'),

            new Date('from_date', 'Y-m-d H:i:s', 'Date is not valid'),
            new Date('to_date', 'Y-m-d H:i:s', 'Date is not valid'),
        ]);
    }
}
