<?php

namespace Common\Mapper;

use Common\Model\AccessToken;
use Nen\Database\Query\Expression;
use Nen\Database\Query\Insert;
use Nen\Database\Query\Select;
use Nen\Database\Query\Update;

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
        $items = $this->connection->selectAll(
            new Select('access_token', $conditions, $binds)
        );

        $modes = [];

        foreach ($items as $item) {
            $modes[] = AccessToken::fromState($item);
        }

        return $modes;
    }

    /**
     * @param string $conditions
     * @param array $binds
     *
     * @return AccessToken|null
     */
    public function findFirst(string $conditions = '', array $binds = []): ?AccessToken
    {
        $item = $this->connection->selectOne(
            new Select('access_token', $conditions, $binds)
        );

        if (!$item) {
            return null;
        }

        return AccessToken::fromState($item);
    }

    /**
     * @param AccessToken $accessToken
     */
    public function save(AccessToken $accessToken): void
    {
        if (!$accessToken->getAccessTokenId()) {
            $this->create($accessToken);
        } else {
            $this->update($accessToken);
        }
    }

    /**
     * @param AccessToken $accessToken
     */
    public function create(AccessToken $accessToken): void
    {
        $this->connection->execute(
            new Insert('access_token', $this->convert($accessToken))
        );
    }

    /**
     * @param AccessToken $accessToken
     */
    public function update(AccessToken $accessToken): void
    {
        $this->connection->execute(
            new Update('access_token', $this->convert($accessToken))
        );
    }

    /**
     * @param AccessToken $accessToken
     *
     * @return array
     */
    private function convert(AccessToken $accessToken): array
    {
        return [[
            'user_id' => $accessToken->getUserId(),
            'token' => $accessToken->getToken(),
            'expiry_date' => $accessToken->getExpiryDate() ??
                new Expression('CURRENT_TIMESTAMP()'),
        ]];
    }
}
