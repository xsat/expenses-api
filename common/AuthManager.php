<?php

namespace Common;

use Common\Mapper\AccessTokenMapper;
use Common\Mapper\UserMapper;
use Common\Model\AccessToken;
use Common\Model\User;
use Exception;
use Nen\Http\RequestInterface;

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
     *
     * @throws Exception
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
        $token = $this->getToken($request);

        if (!$token) {
            return false;
        }

        $this->accessToken = $this->tokenMapper->findFirst(
            'token = :token AND expiry_date >= CURRENT_TIMESTAMP()',
            [
                'token' => $token,
            ]
        );

        return $this->accessToken !== null;
    }

    /**
     * @param RequestInterface $request
     *
     * @return null|string
     */
    private function getToken(RequestInterface $request): ?string
    {
        $token = $request->getHeader('Authorization');

        if (!$token) {
            return null;
        }

        preg_match('/^Bearer (.*)$/isu', $token, $matches);

        if (!isset($matches[1])) {
            return null;
        }

        return trim($matches[1]);
    }

    public function deleteToken(): void
    {
        if (!$this->accessToken) {
            return;
        }

        $this->tokenMapper->delete($this->accessToken);
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
