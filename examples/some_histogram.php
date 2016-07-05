<?php

require __DIR__ . '/../vendor/autoload.php';

use Prometheus\Registry;

error_log('c='. $_GET['c']);

Registry::setDefaultRedisOptions(array('host' => isset($_SERVER['REDIS_HOST']) ? $_SERVER['REDIS_HOST'] : '127.0.0.1'));
$registry = Registry::getDefaultRegistry();

$histogram = $registry->registerHistogram('test', 'some_histogram', 'it observes', ['type'], [0.1, 1, 2, 3.5, 4, 5, 6, 7, 8, 9]);
$histogram->observe($_GET['c'], ['blue']);

echo "OK\n";