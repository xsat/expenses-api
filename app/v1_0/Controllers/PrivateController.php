<?php

namespace App\v1_0\Controllers;

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
     */
    public function __construct(
        RequestInterface $request,
        ResponseInterface $response
    )
    {
        parent::__construct($request, $response);

        if (!$this->auth->checkToken($request)) {
            var_dump('Invalid access token');
            exit;
        }

        $this->user = $this->auth->getUser();
    }
}
