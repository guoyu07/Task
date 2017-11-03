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


$action = $argv[1];

switch ($action) {
    case 'start':
        (new \Tony\Task\Run())->run();
        break;
    case 'stop':
        (new \Tony\Task\Run())->kill("/tmp/process.pid");
        break;
    case 'ask':
        if (Daemon::isRunning('/path/to/process.pid')) {
            echo "daemon is running.\n";
        } else {
            echo "daemon is not running.\n";
        }
        break;
    default:
        exit('input error!');
}

//
//use Demo\Task\LogAll;
//use Tony\Task\CronCenter;
//
//$cronCenterSubject = new CronCenter();
//$cronCenterSubject->everyFiveMinutes();
//$cronCenterSubject->attach(new LogAll());
//
//(new \Tony\Task\Run())->setTimer($cronCenterSubject)->run();


