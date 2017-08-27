<?php

namespace App\v1_0\Controllers;

use Nen\Exception\UnauthorizedException;
use Nen\Http\RequestInterface;
use Nen\Http\ResponseInterface;

/**
 * Class PrivateController
 */
abstract class PrivateController extends Controller
{
    /**
     * AuthorizedController constructor.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @throws UnauthorizedException
     *
     * @todo Write friendly error messages
     */
    public function __construct(
        RequestInterface $request,
        ResponseInterface $response
    )
    {
        parent::__construct($request, $response);

        if (!$this->auth->checkToken($request)) {
            throw new UnauthorizedException('Invalid access token');
        }

        $this->user = $this->auth->getUser();
    }
}
