<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/../vendor/autoload.php';

define('DATA_DIR', __DIR__ . '/../data/');

use Dotenv\Dotenv;

(new Dotenv(__DIR__ . '/../'))->load();

return require __DIR__ . '/app.php';
