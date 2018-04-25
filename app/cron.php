<?php
/**
 * 这是个定时任务配置文件；
 */


use App\Task\LogAll;
use Tony\Task\CronCenter;

$cronCenters = new SplObjectStorage();


// 每5分钟运行一次的定时器
$cronCenterSubject = new CronCenter();
$cronCenterSubject->everyFiveMinutes();
$cronCenterSubject->attach(new LogAll());

// 每1个小时运行一次的定时器


// 每天运行一次的定时器
$cronCenters->attach($cronCenterSubject);