<?php

namespace Common\Model;

/**
 * Class Expense
 */
class Expense implements ModelInterface
{
    /**
     * @var int
     */
    private $expense_id;

    /**
     * @var int
     */
    private $user_id;

    /**
     * @var float
     */
    private $cost = 0.00;

    /**
     * @var string
     */
    private $spent_date;

    /**
     * Expense constructor.
     *
     * @param int|null $expense_id
     * @param int $user_id
     * @param float $cost
     * @param null|string $spent_date
     */
    public function __construct(
        ?int $expense_id,
        int $user_id,
        float $cost = 0.00,
        ?string $spent_date = null
    )
    {
        $this->setExpenseId($expense_id);
        $this->setUserId($user_id);
        $this->setCost($cost);
        $this->setSpentDate($spent_date);
    }

    /**
     * @return int|null
     */
    public function getExpenseId(): ?int
    {
        return $this->expense_id;
    }

    /**
     * @param int|null $expense_id
     */
    public function setExpenseId(?int $expense_id)
    {
        $this->expense_id = $expense_id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     */
    public function setCost(float $cost)
    {
        $this->cost = $cost;
    }

    /**
     * @return null|string
     */
    public function getSpentDate(): ?string
    {
        return $this->spent_date;
    }

    /**
     * @param null|string $spent_date
     */
    public function setSpentDate(?string $spent_date)
    {
        $this->spent_date = $spent_date;
    }

    /**
     * @param array $state
     *
     * @return Expense|ModelInterface
     */
    public static function fromState(array $state): ModelInterface
    {
        return new Expense(
            $state['expense_id'],
            $state['user_id'],
            $state['cost'],
            $state['spent_date']
        );
    }
}
