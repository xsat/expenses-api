<?php

namespace Common\Mapper;

/**
 * Interface MapperInterface
 */
interface MapperInterface
{
    /**
     * @param string $conditions
     * @param array $binds
     *
     * @return array
     */
    public function find(string $conditions = '', array $binds = []): array;

    /**
     * @param string $conditions
     * @param array $binds
     *
     * @return mixed
     */
    public function findFirst(string $conditions = '', array $binds = []);
}
