<?php

namespace Common\Mapper;

use Common\Model\AccessToken;
use Nen\Database\Query\Select;

/**
 * Class AccessTokenMapper
 */
class AccessTokenMapper extends Mapper
{
    /**
     * @param string $conditions
     * @param array $binds
     *
     * @return AccessToken[]
     */
    public function find(string $conditions = '', array $binds = []): array
    {
        $items = $this->connection->selectAll(new Select('access_token', $conditions, $binds));
        $modes = [];

        foreach ($items as $item) {

        }
    }

    /**
     * @param string $conditions
     * @param array $binds
     *
     * @return AccessToken|null
     */
    public function findOne(string $conditions = '', array $binds = []): ?AccessToken
    {
        $item = $this->connection->selectOne(new Select('access_token', $conditions, $binds));
    }

    /**
     * @param AccessToken $accessToken
     */
    public function create(AccessToken $accessToken): void
    {
        $this->connection->execute();
    }

    /**
     * @param AccessToken $accessToken
     */
    public function update(AccessToken $accessToken): void
    {

    }
}
