<?php

namespace Common\Mapper;

use Common\Model\AccessToken;
use Nen\Database\Query\Delete;
use Nen\Database\Query\Expression;
use Nen\Database\Query\Insert;
use Nen\Database\Query\QueryInterface;
use Nen\Database\Query\Select;
use Nen\Database\Query\Update;
use Nen\Mapper\Mapper;

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
        $items = $this->connection->select(
            $this->getQuery($conditions, $binds)
        );

        $modes = [];

        foreach ($items as $item) {
            $modes[] = new AccessToken($item);
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
        $item = $this->connection->selectFirst(
            $this->getQuery($conditions, $binds)
        );

        if (!$item) {
            return null;
        }

        return new AccessToken($item);
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
            'access_token',
            '`access_token_id`, `user_id`, `token`, `expiry_date`',
            $conditions,
            $binds
        );
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

        $accessToken->setAccessTokenId($this->connection->lastInsetId());
    }

    /**
     * @param AccessToken $accessToken
     */
    public function update(AccessToken $accessToken): void
    {
        $this->connection->execute(
            new Update(
                'access_token',
                $this->convert($accessToken),
                'access_token_id = :access_token_id',
                [
                    'access_token_id' => $accessToken->getAccessTokenId(),
                ]
            )
        );
    }

    /**
     * @param AccessToken $accessToken
     *
     * @return array
     */
    private function convert(AccessToken $accessToken): array
    {
        return [
            'user_id' => $accessToken->getUserId(),
            'token' => $accessToken->getToken(),
            'expiry_date' => $accessToken->getExpiryDate() ??
                new Expression('CURRENT_TIMESTAMP() + INTERVAL 1 HOUR'),
        ];
    }

    /**
     * @param AccessToken $accessToken
     */
    public function delete(AccessToken $accessToken): void
    {
        $this->connection->execute(
            new Delete('access_token', 'access_token_id = :access_token_id', [
                'access_token_id' => $accessToken->getAccessTokenId(),
            ])
        );
    }
}
