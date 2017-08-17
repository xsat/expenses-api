<?php

namespace Common\Model;

/**
 * Class AccessToken
 */
class AccessToken implements ModelInterface
{
    /**
     * @var int
     */
    private $access_token_id;

    /**
     * @var int
     */
    private $user_id;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $expiry_date;

    /**
     * AccessToken constructor.
     *
     * @param int|null $access_token_id
     * @param int $user_id
     * @param int $token
     * @param null|string $expiry_date
     */
    public function __construct(
        ?int $access_token_id,
        int $user_id,
        int $token,
        ?string $expiry_date = null
    )
    {
        $this->setAccessTokenId($access_token_id);
        $this->setUserId($user_id);
        $this->setToken($token);
        $this->setExpiryDate($expiry_date);
    }

    /**
     * @return int|null
     */
    public function getAccessTokenId(): ?int
    {
        return $this->access_token_id;
    }

    /**
     * @param int|null $access_token_id
     */
    public function setAccessTokenId(?int $access_token_id)
    {
        $this->access_token_id = $access_token_id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return null|string
     */
    public function getExpiryDate(): ?string
    {
        return $this->expiry_date;
    }

    /**
     * @param null|string $expiry_date
     */
    public function setExpiryDate(?string $expiry_date)
    {
        $this->expiry_date = $expiry_date;
    }

    /**
     * @param array $state
     *
     * @return AccessToken|ModelInterface
     */
    public static function fromState(array $state): ModelInterface
    {
        return new AccessToken(
            $state['access_token_id'],
            $state['user_id'],
            $state['token'],
            $state['expiry_date']
        );
    }
}
