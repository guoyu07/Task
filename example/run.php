<?php
/**
 * Created by PhpStorm.
 * User: Tony Chen
 * Date: 2017/11/3
 * Time: 16:39
 */

require "../Loader.php";

// 自动加载
$loader = new Loader();
$loader->addPrefix('Tony\Task', '../src');
$loader->addPrefix('Demo', __DIR__);
$loader->register();

use Demo\Task\LogAll;
use Tony\Task\CronCenter;

$cronCenterSubject = new CronCenter();
$cronCenterSubject->everyFiveMinutes();
$cronCenterSubject->attach(new LogAll());

(new \Tony\Task\Run())->setTimer($cronCenterSubject)->run();




