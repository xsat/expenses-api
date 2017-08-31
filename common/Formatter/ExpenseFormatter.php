<?php

namespace Common\Formatter;

use Common\Model\Expense;
use Nen\Formatter\FormatterInterface;

/**
 * Class ExpenseFormatter
 */
class ExpenseFormatter implements FormatterInterface
{
    /**
     * @var Expense
     */
    private $expense;

    /**
     * ExpenseFormatter constructor.
     *
     * @param Expense $expense
     */
    public function __construct(Expense $expense)
    {
        $this->expense = $expense;
    }

    /**
     * @return array
     */
    public function format(): array
    {
        return [
            'expense_id' => $this->expense->getExpenseId(),
            'user_id' => $this->expense->getUserId(),
            'note' => $this->expense->getNote(),
            'cost' => $this->expense->getCost(),
            'spent_date' => $this->expense->getSpentDate(),
        ];
    }
}
