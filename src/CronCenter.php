<?php
/**
 * Created by PhpStorm.
 * User: Tony Chen
 * Date: 2017/11/3
 * Time: 16:15
 */

namespace Tony\Task;

use SplObjectStorage;
use SplObserver;
use SplSubject;

/**
 * 定时器被观察者
 * Class CronCenter
 * @package Tony\Task
 */
class CronCenter extends Timer implements SplSubject
{
    /**
     * @var SplObjectStorage
     */
    private $taskObservers;

    /**
     * CronCenter constructor.
     */
    public function __construct()
    {
        $this->taskObservers = new SplObjectStorage();
    }

    /**
     * 加入任务观察者
     * @param SplObserver $observer
     */
    public function attach(SplObserver $observer)
    {
        $this->taskObservers->attach($observer);
    }

    /**
     * 删除任务观察者
     * @param SplObserver $observer
     */
    public function detach(SplObserver $observer)
    {
        $this->taskObservers->detach($observer);
    }

    /**
     * 通知观察者任务时间到了，开始执行任务
     */
    public function notify()
    {
        foreach ($this->taskObservers as $observer) {
            /**
             * @var AbstractTask $observer
             */
            $observer->update($this);
        }
    }
}