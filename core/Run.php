<?php
/**
 * Created by PhpStorm.
 * User: Tony Chen
 * Date: 2017/11/3
 * Time: 15:21
 */

namespace Tony\Task;

class Run extends Daemon
{
    /**
     * @var CronCenter
     */
    public $cron;

    /**
     * 时间对象
     * @param CronCenter $cron
     */
    public function setTimer(CronCenter $cron)
    {
        $this->cron = $cron;
        return $this;
    }

    public function run()
    {
        if (self::isRunning('/tmp/process.pid')) {
            echo "daemon is already running.\n";
        } else {
            self::work(array(
                'pid' => '/tmp/process.pid', // required
                'stdin' => '/dev/null',            // defaults to /dev/null
                'stdout' => '/tmp/stdout.txt',  // defaults to /dev/null
                'stderr' => '/tmp/stderr.txt',  // defaults to php://stdout
            ),
                function ($stdin, $stdout, $stderr) { // these parameters are optional
                    while (true) {
                        // do whatever it is daemons do
                        sleep(1); // sleep is good for you
                    }
                }
            );
            echo "daemon is now running.\n";
        }


//        while (true) {
//            // 1秒检测一次
//            sleep(1);
//
//            $this->cron->notify();
////            if ($this->cron->isDue()) {
////                $this->cron->notify();
////            }
//        }
    }
}