<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/../vendor/autoload.php';

use Nen\Application;

return new Application(include __DIR__ . '/routes.php');
