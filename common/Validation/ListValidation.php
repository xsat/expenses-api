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
            new Numerical('offset', 'Field `offset` must be numeric'),

            new Numerical('limit', 'Field `limit` must be numeric'),

            new Range('order', $this->orders, 'Field `order` must not be a part of list: ' . implode(', ' , $this->orders)),

            new Range('sort', $this->sorts, 'Field `sort` must not be a part of list: ' . implode(', ' , $this->sorts)),

            new Maximum('search', 255, 'Field `search` must not exceed 255 characters long'),

            new Date('from_date', 'Y-m-d H:i:s', 'Field `from_date` is not a valid date'),
            new Date('to_date', 'Y-m-d H:i:s', 'Field `to_date` is not a valid date'),
        ]);
    }
}
