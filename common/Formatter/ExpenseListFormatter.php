<?php

namespace Common\Formatter;

use Common\Binder\ListBinder;
use Common\Model\Expense;
use Nen\Formatter\FormatterInterface;

/**
 * Class ExpenseListFormatter
 */
class ExpenseListFormatter implements FormatterInterface
{
    /**
     * @var int
     */
    private $total;

    /**
     * @var Expense[]
     */
    private $expenses = [];

    /**
     * @var ListBinder
     */
    private $binder;

    /**
     * ExpenseListFormatter constructor.
     *
     * @param int $total
     * @param Expense[] $expenses
     * @param ListBinder $binder
     */
    public function __construct(
        int $total,
        array $expenses,
        ListBinder $binder
    )
    {
        $this->total = $total;
        $this->expenses = $expenses;
        $this->binder = $binder;
    }

    /**
     * @return array
     */
    public function format(): array
    {
        $list = [];

        foreach ($this->expenses as $expense) {
            $data[] = (new ExpenseFormatter($expense))->format();
        }

        return [
            'offset' => $this->binder->getOffset(),
            'limit' => $this->binder->getLimit(),
            'total' => $this->total,
            'list' => $list,
        ];
    }
}
