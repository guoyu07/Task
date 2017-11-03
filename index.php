<?php
/**
 * Created by PhpStorm.
 * User: Tony Chen
 * Date: 2017/11/3
 * Time: 14:03
 */
require "Loader.php";

// 自动加载
$loader = new Loader();
$loader->addPrefix('Tony\Task', 'src');
$loader->register();

use Tony\Task\DaemonBak;


$daemon = new DaemonBak();

$daemon->fork();




//use Tony\Task\Timer;
//
//$timer = new Timer();
//$timer->everyFiveMinutes();
//
//while (true) {
//    echo $timer->nextRunDate() . "\n";
//    sleep(5);
//}
//
////$timer->timezone = DateTimeZone::ASIA;
//
//// var_dump($timer->isDue()) . "\n";
//echo $timer->nextRunDate();