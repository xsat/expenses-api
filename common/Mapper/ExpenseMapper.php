<?php

namespace Common\Mapper;

use Common\Binder\ListBinder;
use Common\Model\Expense;
use Nen\Database\Query\Delete;
use Nen\Database\Query\Expression;
use Nen\Database\Query\Insert;
use Nen\Database\Query\QueryInterface;
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
            $this->getQuery($conditions, $binds)
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
            $this->getQuery($conditions, $binds)
        );

        if (!$item) {
            return null;
        }

        return new Expense($item);
    }

    /**
     * @param string $conditions
     * @param array $binds
     *
     * @return QueryInterface
     */
    private function getQuery(string $conditions, array $binds): QueryInterface
    {
        return new Select(
            'expense',
            '`expense_id`, `user_id`, `note`, `cost`, `spent_date`',
            $conditions,
            $binds
        );
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
            new Update(
                'expense',
                $this->convert($expense),
                'expense_id = :expense_id',
                [
                    'expense_id' => $expense->getExpenseId(),
                ]
            )
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
     * @param Expense $expense
     */
    public function delete(Expense $expense): void
    {
        $this->connection->execute(
            new Delete('expense', 'expense_id = :expense_id', [
                'expense_id' => $expense->getExpenseId(),
            ])
        );
    }

    /**
     * @param ListBinder $binder
     *
     * @return Expense[]
     */
    public function getList(ListBinder $binder): array
    {
        return $this->find(
            $this->getConditions($binder) .
            ' ORDER BY :order ' . strtoupper($binder->getSort()) .
            ' LIMIT :limit OFFSET :offset',
            $this->getBinds($binder) + [
                'order' => $binder->getOrder(),
                'limit' => $binder->getLimit(),
                'offset' => $binder->getOffset(),
            ]
        );
    }

    /**
     * @param ListBinder $binder
     *
     * @return int
     */
    public function getTotal(ListBinder $binder): int
    {
        $result = $this->connection->selectFirst(
            new Select(
                'expense',
                'COUNT(`expense_id`) AS `count`',
                $this->getConditions($binder),
                $this->getBinds($binder)
            )
        );

        return $result['count'] ?? 0;
    }

    /**
     * @param ListBinder $binder
     *
     * @return string
     */
    private function getConditions(ListBinder $binder): string
    {
        $conditions = [];

        if ($binder->getSearch()) {
            $conditions[] = 'note LIKE %:search%';
        }

        if ($binder->getFromDate()) {
            $conditions[] = 'spent_date >= :from_date';
        }

        if ($binder->getToDate()) {
            $conditions[] = 'spent_date <= :to_date';
        }

        if (!$conditions) {
            $conditions[] = 1;
        }

        return implode(' AND ', $conditions);
    }

    /**
     * @param ListBinder $binder
     *
     * @return array
     */
    public function getBinds(ListBinder $binder): array
    {
        $binds = [];

        if ($binder->getSearch()) {
            $binds['search'] = $binder->getSearch();
        }

        if ($binder->getFromDate()) {
            $binds['from_date'] = $binder->getFromDate();
        }

        if ($binder->getToDate()) {
            $binds['to_date'] = $binder->getToDate();
        }

        return $binds;
    }
}
