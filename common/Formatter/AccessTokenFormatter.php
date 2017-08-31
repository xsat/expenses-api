<?php

namespace Common\Formatter;

use Common\Model\AccessToken;
use Nen\Formatter\FormatterInterface;

/**
 * Class AccessTokenFormatter
 */
class AccessTokenFormatter implements FormatterInterface
{
    /**
     * @var AccessToken
     */
    private $accessToken;

    /**
     * AccessTokenFormatter constructor.
     *
     * @param AccessToken $accessToken
     */
    public function __construct(AccessToken $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return array
     */
    public function format(): array
    {
        return [
            'token' => $this->accessToken->getToken(),
        ];
    }
}
