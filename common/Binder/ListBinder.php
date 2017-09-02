<?php

namespace Common\Binder;

use Nen\Binder\Binder;

/**
 * Class ListBinder
 */
class ListBinder extends Binder
{
    /**
     * Available orders
     */
    public const ORDER_EXPIRY_DATE = 'expiry_date';
    public const ORDER_EXPENSE_ID = 'expense_id';
    public const ORDER_NOTE = 'note';

    /**
     * Available sorts
     */
    public const SORT_DESC = 'desc';
    public const SORT_ASC = 'asc';

    /**
     * @var int
     */
    private $offset = 0;

    /**
     * @var int
     */
    private $limit = 10;

    /**
     * @var string
     */
    private $order = self::ORDER_EXPIRY_DATE;

    /**
     * @var string
     */
    private $sort = self::SORT_DESC;

    /**
     * @var string
     */
    private $search;

    /**
     * @var string
     */
    private $from_date;

    /**
     * @var string
     */
    private $to_date;

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @return string
     */
    public function getOrder(): string
    {
        return $this->order;
    }

    /**
     * @param string $order
     */
    public function setOrder(string $order): void
    {
        $this->order = $order;
    }

    /**
     * @return string
     */
    public function getSort(): string
    {
        return $this->sort;
    }

    /**
     * @param string $sort
     */
    public function setSort(string $sort): void
    {
        $this->sort = $sort;
    }

    /**
     * @return null|string
     */
    public function getSearch(): ?string
    {
        return $this->search;
    }

    /**
     * @param null|string $search
     */
    public function setSearch(?string $search): void
    {
        $this->search = $search;
    }

    /**
     * @return null|string
     */
    public function getFromDate(): ?string
    {
        return $this->from_date;
    }

    /**
     * @param null|string $from_date
     */
    public function setFromDate(?string $from_date): void
    {
        $this->from_date = $from_date;
    }

    /**
     * @return null|string
     */
    public function getToDate(): ?string
    {
        return $this->to_date;
    }

    /**
     * @param null|string $to_date
     */
    public function setToDate(?string $to_date): void
    {
        $this->to_date = $to_date;
    }
}
