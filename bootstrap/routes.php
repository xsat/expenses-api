<?php

use App\Controllers\IndexController;
use App\v1_0\Controllers\AuthController;
use App\v1_0\Controllers\ExpenseController;
use App\v1_0\Controllers\PublicAuthController;
use App\v1_0\Controllers\PublicUserController;
use App\v1_0\Controllers\UserController;
use Nen\Http\Request;
use Nen\Router\Group;
use Nen\Router\Route;
use Nen\Router\Routes;

return new Routes([
    new Route(IndexController::class, 'main', null, Request::METHOD_POST),
    new Group('api/1.0', new Routes([
        new Group('auth', new Routes([
            new Route(PublicAuthController::class, 'login', null, Request::METHOD_POST),
            new Route(AuthController::class, 'logout', null, Request::METHOD_DELETE),
        ])),
        new Group('user', new Routes([
            new Route(UserController::class, 'view', null, Request::METHOD_GET),
            new Route(PublicUserController::class, 'create', null, Request::METHOD_POST),
            new Route(UserController::class, 'update', null, Request::METHOD_DELETE),
            new Route(UserController::class, 'delete', null, Request::METHOD_DELETE),
        ])),
        new Group('expense', new Routes([
            new Route(ExpenseController::class, 'list', null, Request::METHOD_GET),
            new Route(ExpenseController::class, 'view', '([0-9]+)', Request::METHOD_GET),
            new Route(ExpenseController::class, 'create', null, Request::METHOD_POST),
            new Route(ExpenseController::class, 'update', '([0-9]+)', Request::METHOD_DELETE),
            new Route(ExpenseController::class, 'delete', '([0-9]+)', Request::METHOD_DELETE),
        ])),
    ])),
]);
