<?php
/**
 * Created by PhpStorm.
 * User: Tony Chen
 * Date: 2017/11/3
 * Time: 16:20
 */

namespace Tony\Task;

/**
 * 观察者
 * Class AbstractTask
 * @package Tony\Task
 */
abstract class AbstractTask implements \SplObserver
{
    /*
     * 记录定时任务日志
     */
    public function logTask()
    {

    }
}