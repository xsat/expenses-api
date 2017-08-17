<?php

namespace Common\Model;

/**
 * Class User
 */
class User implements ModelInterface
{
    /**
     * @var int
     */
    private $user_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * User constructor.
     *
     * @param int|null $user_id
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(
        ?int $user_id,
        string $name,
        string $email,
        string $password
    )
    {
        $this->setUserId($user_id);
        $this->setName($name);
        $this->setEmail($email);
        $this->setPassword($password);
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @param int|null $user_id
     */
    public function setUserId(?int $user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @param array $state
     *
     * @return User|ModelInterface
     */
    public static function fromState(array $state): ModelInterface
    {
        return new User(
            $state['user_id'],
            $state['name'],
            $state['email'],
            $state['password']
        );
    }
}
