<?php

namespace Common\Mapper;

use Common\Model\Expense;
use Nen\Database\Query\Delete;
use Nen\Database\Query\Expression;
use Nen\Database\Query\Insert;
use Nen\Database\Query\Select;
use Nen\Database\Query\Update;
use Nen\Mapper\Mapper;

/**
 * Class ExpenseMapper
 */
class ExpenseMapper extends Mapper
{
    /**
     * @param string $conditions
     * @param array $binds
     *
     * @return Expense[]
     */
    public function find(string $conditions = '', array $binds = []): array
    {
        $items = $this->connection->select(
            new Select('expense', $conditions, $binds)
        );

        $modes = [];

        foreach ($items as $item) {
            $modes[] = new Expense($item);
        }

        return $modes;
    }

    /**
     * @param string $conditions
     * @param array $binds
     *
     * @return Expense|null
     */
    public function findFirst(string $conditions = '', array $binds = []): ?Expense
    {
        $item = $this->connection->selectFirst(
            new Select('expense', $conditions, $binds)
        );

        if (!$item) {
            return null;
        }

        return new Expense($item);
    }

    /**
     * @param Expense $expense
     */
    public function save(Expense $expense): void
    {
        if (!$expense->getExpenseId()) {
            $this->create($expense);
        } else {
            $this->update($expense);
        }
    }

    /**
     * @param Expense $expense
     */
    public function create(Expense $expense): void
    {
        $this->connection->execute(
            new Insert('expense', $this->convert($expense))
        );

        $expense->setExpenseId($this->connection->lastInsetId());
    }

    /**
     * @param Expense $expense
     */
    public function update(Expense $expense): void
    {
        $this->connection->execute(
            new Update('expense', $this->convert($expense))
        );
    }

    /**
     * @param Expense $expense
     *
     * @return array
     */
    private function convert(Expense $expense): array
    {
        return [
            'user_id' => $expense->getUserId(),
            'note' => $expense->getNote() ??
                new Expression('NULL'),
            'cost' => $expense->getCost(),
            'spent_date' => $expense->getSpentDate() ??
                new Expression('CURRENT_TIMESTAMP()'),
        ];
    }

    /**
     * @param Expense $accessToken
     */
    public function delete(Expense $expense): void
    {
        $this->connection->execute(
            new Delete('expense', 'expense_id = :expense_id', [
                'expense_id' => $expense->getExpenseId(),
            ])
        );
    }
}
