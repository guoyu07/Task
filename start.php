<?php
/**
 * Created by PhpStorm.
 * User: Tony Chen
 * Date: 2017/11/3
 * Time: 16:39
 */

use Tony\Task\Runner;

require "core/Loader.php";

// 自动加载
$loader = new Loader();
$loader->addPrefix('Tony\Task', __DIR__ . '/core');
$loader->addPrefix('App', __DIR__ . '/src');
$loader->register();

require 'app/cron.php';
$config = require 'app/config.php';

$runner = new Runner($config['daemon']);
$runner->setCrons($cronCenters);

$action = $argv[1];
switch ($action)
{
    case 'start':
        $runner->start();
        break;
    case 'stop':
        $runner->stop();
        break;
    case 'ask':
        $runner->ask();
        break;
    default:
        exit('input error!');
}