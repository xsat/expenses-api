<?php

use Nen\Application;

try {
    return new Application(include __DIR__ . '/routes.php');
} catch (Exception $exception) {
    var_dump($exception->getMessage());
}