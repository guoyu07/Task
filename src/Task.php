<?php
/**
 * Created by PhpStorm.
 * User: Tony Chen
 * Date: 2017/11/3
 * Time: 15:21
 */

namespace Tony\Task;


class Task
{
    /**
     * @var Timer
     */
    public $timer;

    /**
     * 时间对象
     * @param Timer $timer
     */
    public function setTimer(Timer $timer)
    {
        $this->timer = $timer;
    }

    public function run()
    {
        while (true) {
            // 1秒检测一次
            sleep(1);
            if ($this->timer->isDue()) {
                echo 1;
            }
        }
    }
}