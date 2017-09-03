<?php

namespace App\v1_0\Controllers;

use Common\AuthManager;
use Common\Mapper\AccessTokenMapper;
use Common\Mapper\UserMapper;
use Common\Model\User;
use Nen\Database\Connection;
use Nen\Database\ConnectionInterface;
use Nen\Formatter\FormatterInterface;
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

        $this->response->setHeader(
            'Content-Type', 'application/json; charset=utf-8'
        );
        $this->response->setHeader(
            'Access-Control-Allow-Origin', '*'
        );
        $this->response->setHeader(
            'Access-Control-Allow-Headers', 'Content-Type, Authorization'
        );
        $this->response->setHeader(
            'Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE'
        );

        $this->connection = new Connection(
            getenv('DB_HOST'),
            getenv('DB_DATABASE'),
            getenv('DB_USERNAME'),
            getenv('DB_PASSWORD')
        );

        $this->auth = new AuthManager(
            new AccessTokenMapper($this->connection),
            new UserMapper($this->connection)
        );
    }

    /**
     * @param FormatterInterface $formatter
     */
    protected final function format(FormatterInterface $formatter): void
    {
        $this->response($formatter->format());
    }

    /**
     * @param array|null $data
     */
    protected final function response(array $data = null): void
    {
        $this->response->setJsonContent($data ?? new \stdClass());
    }
}
