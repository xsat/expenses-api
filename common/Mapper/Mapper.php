<?php

namespace Common\Mapper;

use Nen\Database\ConnectionInterface;

/**
 * Class Mapper
 */
abstract class Mapper implements MapperInterface
{
    /**
     * @var ConnectionInterface
     */
    protected $connection;

    /**
     * Mapper constructor.
     *
     * @param ConnectionInterface $connection
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }
}
