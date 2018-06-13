<?php
/**
 * 这是个定时任务配置文件；
 */


use App\Task\AnalysisClientTcp;
use App\Task\AnalysisClientUdp;
use App\Task\Demo;
use Tony\Task\CronCenter;

$cronCenters = new SplObjectStorage();


// 每5分钟运行一次的定时器
$cronCenterSubject = new CronCenter();
$cronCenterSubject->everyMinute();
// $cronCenterSubject->attach(new AnalysisClientTcp());
$cronCenterSubject->attach(new AnalysisClientUdp());

// 每1个小时运行一次的定时器


// 每天运行一次的定时器
$cronCenters->attach($cronCenterSubject);