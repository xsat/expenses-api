<?php

namespace App\v1_0\Controllers;

use Common\AuthManager;
use Common\Mapper\AccessTokenMapper;
use Common\Mapper\UserMapper;
use Common\Model\User;
use Nen\Database\Connection;
use Nen\Database\ConnectionInterface;
use Nen\Http\RequestInterface;
use Nen\Http\ResponseInterface;
use Nen\Web\Controller as NenController;

/**
 * Class Controller
 */
abstract class Controller extends NenController
{
    /**
     * @var ConnectionInterface
     */
    protected $connection;

    /**
     * @var AuthManager
     */
    protected $auth;

    /**
     * @var User
     */
    protected $user;

    /**
     * Controller constructor.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(
        RequestInterface $request,
        ResponseInterface $response
    )
    {
        parent::__construct($request, $response);

        $this->connection = Connection::getInstance();
        $this->auth = new AuthManager(
            new AccessTokenMapper($this->connection),
            new UserMapper($this->connection)
        );
    }

    /**
     * @param array|null $data
     */
    protected final function response(array $data = null): void
    {
        $this->response->setJsonContent($data ?? new \stdClass());
    }
}
