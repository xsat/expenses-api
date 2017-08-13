<?php

use App\Controllers\IndexController;
use App\v1_0\Controllers\AuthController;
use App\v1_0\Controllers\CostController;
use App\v1_0\Controllers\PublicAuthController;
use App\v1_0\Controllers\PublicUserController;
use App\v1_0\Controllers\UserController;
use Nen\Http\Request;
use Nen\Router\Group;
use Nen\Router\Route;
use Nen\Router\Routes;

return new Routes([
    new Route(IndexController::class, 'main', null, Request::METHOD_GET),
    new Group('api/1.0', new Routes([
        new Group('auth', new Routes([
            new Route(PublicAuthController::class, null, 'login', Request::METHOD_POST),
            new Route(AuthController::class, null, 'logout', Request::METHOD_DELETE),
        ])),
        new Group('user', new Routes([
            new Route(UserController::class, null, 'view', Request::METHOD_GET),
            new Route(PublicUserController::class, null, 'create', Request::METHOD_POST),
            new Route(UserController::class, null, 'update', Request::METHOD_DELETE),
            new Route(UserController::class, null, 'delete', Request::METHOD_DELETE),
        ])),
        new Group('cost', new Routes([
            new Route(CostController::class, null, 'list', Request::METHOD_GET),
            new Route(CostController::class, '([0-9]+)', 'view', Request::METHOD_GET),
            new Route(CostController::class, null, 'create', Request::METHOD_POST),
            new Route(CostController::class, '([0-9]+)', 'update', Request::METHOD_DELETE),
            new Route(CostController::class, '([0-9]+)', 'delete', Request::METHOD_DELETE),
        ])),
    ])),
]);
