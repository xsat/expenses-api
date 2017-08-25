<?php

namespace Common\Mapper;

use Common\Model\User;
use Nen\Database\Query\Insert;
use Nen\Database\Query\Select;
use Nen\Database\Query\Update;

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
        $items = $this->connection->selectAll(
            new Select('user', $conditions, $binds)
        );

        $modes = [];

        foreach ($items as $item) {
            $modes[] = User::fromState($item);
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
        $item = $this->connection->selectOne(
            new Select('user', $conditions, $binds)
        );

        if (!$item) {
            return null;
        }

        return User::fromState($item);
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
    }

    /**
     * @param User $user
     */
    public function update(User $user): void
    {
        $this->connection->execute(
            new Update('user', $this->convert($user))
        );
    }

    /**
     * @param User $user
     *
     * @return array
     */
    private function convert(User $user): array
    {
        return [[
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ]];
    }
}
