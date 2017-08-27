<?php

namespace Common\Binder;

use Nen\Binder\Binder;

/**
 * Class ExpenseBinder
 */
class ExpenseBinder extends Binder
{
    /**
     * @var string
     */
    private $note;

    /**
     * @var float
     */
    private $cost;

    /**
     * @var string
     */
    private $spent_date;

    /**
     * @return null|string
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param null|string $note
     */
    public function setNote(?string $note)
    {
        $this->note = $note;
    }

    /**
     * @return float|null
     */
    public function getCost(): ?float
    {
        return $this->cost;
    }

    /**
     * @param float|null $cost
     */
    public function setCost(?float $cost)
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
}
