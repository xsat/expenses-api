<?php

namespace Common\Mapper;

use Common\Model\User;
use Nen\Database\Query\Delete;
use Nen\Database\Query\Insert;
use Nen\Database\Query\QueryInterface;
use Nen\Database\Query\Select;
use Nen\Database\Query\Update;
use Nen\Mapper\Mapper;

/**
 * Class UserMapper
 */
class UserMapper extends Mapper
{
    /**
     * @param string $conditions
     * @param array $binds
     *
     * @return User[]
     */
    public function find(string $conditions = '', array $binds = []): array
    {
        $items = $this->connection->select(
            $this->getQuery($conditions, $binds)
        );

        $modes = [];

        foreach ($items as $item) {
            $modes[] = new User($item);
        }

        return $modes;
    }

    /**
     * @param string $conditions
     * @param array $binds
     *
     * @return User|null
     */
    public function findFirst(string $conditions = '', array $binds = []): ?User
    {
        $item = $this->connection->selectFirst(
            $this->getQuery($conditions, $binds)
        );

        if (!$item) {
            return null;
        }

        return new User($item);
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
            'user',
            '"user_id", "name", "email", "password"',
            $conditions,
            $binds
        );
    }

    /**
     * @param User $user
     */
    public function save(User $user): void
    {
        if (!$user->getUserId()) {
            $this->create($user);
        } else {
            $this->update($user);
        }
    }

    /**
     * @param User $user
     */
    public function create(User $user): void
    {
        $this->connection->execute(
            new Insert('user', $this->convert($user))
        );

        $user->setUserId($this->connection->lastInsetId());
    }

    /**
     * @param User $user
     */
    public function update(User $user): void
    {
        $this->connection->execute(
            new Update(
                'user',
                $this->convert($user),
                'user_id = :user_id',
                [
                    'user_id' => $user->getUserId(),
                ]
            )
        );
    }

    /**
     * @param User $user
     *
     * @return array
     */
    private function convert(User $user): array
    {
        return [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ];
    }

    /**
     * @param User $user
     */
    public function delete(User $user): void
    {
        $this->connection->execute(
            new Delete('user', 'user_id = :user_id', [
                'user_id' => $user->getUserId(),
            ])
        );
    }
}
