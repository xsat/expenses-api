<?php

namespace Common\Validation\Validator;

use Common\Mapper\UserMapper;
use Common\Model\User;
use Nen\Validation\Validator\Validator;
use Nen\Validation\ValuesInterface;

/**
 * Class UniqueEmail
 */
class UniqueEmail extends Validator
{
    /**
     * @var UserMapper
     */
    private $mapper;

    /**
     * @var User
     */
    private $user;

    /**
     * UniqueEmail constructor.
     * @param string $field
     * @param UserMapper $mapper
     * @param User|null $user
     * @param string $message
     */
    public function __construct(
        string $field,
        UserMapper $mapper,
        ?User $user,
        string $message
    )
    {
        parent::__construct($field, $message);
        $this->mapper = $mapper;
        $this->user = $user;
    }

    /**
     * {@inheritdoc}
     */
    public function validate(ValuesInterface $values): bool
    {
        $conditions = 'email = :email';
        $binds = [
            'email' => $values->getValue($this->getField()),
        ];

        if ($this->user) {
            $conditions .= ' AND user_id != :user_id';
            $binds['user_id'] = $this->user->getUserId();
        }

        $entity = $this->mapper->findFirst($conditions, $binds);

        return $entity === null;
    }
}
