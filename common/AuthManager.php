<?php

namespace Common;

use Common\Mapper\AccessTokenMapper;
use Common\Mapper\UserMapper;
use Common\Model\AccessToken;
use Common\Model\User;
use Nen\Database\Query\Expression;
use Nen\Http\RequestInterface;
use Nen\Http\ResponseInterface;

/**
 * Class AuthManager
 */
class AuthManager
{
    /**
     * @var AccessTokenMapper
     */
    private $tokenMapper;

    /**
     * @var UserMapper
     */
    private $userMapper;

    /**
     * @var AccessToken
     */
    private $accessToken;

    /**
     * AuthManager constructor.
     *
     * @param AccessTokenMapper $tokenMapper
     * @param UserMapper $userMapper
     */
    public function __construct(
        AccessTokenMapper $tokenMapper,
        UserMapper $userMapper
    )
    {
        $this->tokenMapper = $tokenMapper;
        $this->userMapper = $userMapper;
    }

    /**
     * @param User $user
     *
     * @return AccessToken
     */
    public function createToken(User $user): AccessToken
    {
        $accessToken = new AccessToken();
        $accessToken->setUserId($user->getUserId());
        $accessToken->setToken(md5(random_bytes(100)));
        $this->tokenMapper->create($accessToken);

        return $accessToken;
    }

    /**
     * @param RequestInterface $request
     *
     * @return bool
     */
    public function checkToken(RequestInterface $request): bool
    {
        $token = $request->getQuery('token');

        if (!$token) {
            return false;
        }

        $this->accessToken = $this->tokenMapper->findFirst(
            'token = :token AND expiry_date >= :expiry_date',
            [
                'token' => $token,
                'expiry_date' => new Expression('CURRENT_TIMESTAMP()'),
            ]
        );

        return $this->accessToken !== null;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        if (!$this->accessToken) {
            return null;
        }

        return $this->userMapper->findFirst('user_id = :user_id', [
            'user_id' => $this->accessToken->getUserId(),
        ]);
    }
}