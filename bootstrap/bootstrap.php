<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');

require_once __DIR__ . '/../vendor/autoload.php';

define('DATA_DIR', __DIR__ . '/../data/');

return require __DIR__ . '/app.php';
