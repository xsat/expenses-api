<?php

namespace Common\Formatter;

use Common\Model\User;
use Nen\Formatter\FormatterInterface;

/**
 * Class UserFormatter
 */
class UserFormatter implements FormatterInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserFormatter constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function format(): array
    {
        return [
            'user_id' => $this->user->getUserId(),
            'name' => $this->user->getName(),
            'email' => $this->user->getEmail(),
        ];
    }
}
