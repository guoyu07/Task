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
    }

    public function run()
    {
        while (true) {
            // 1秒检测一次
            sleep(1);

            $this->cron->notify();
//            if ($this->cron->isDue()) {
//                $this->cron->notify();
//            }
        }
    }
}