<?php
/**
 * Created by PhpStorm.
 * User: Tony Chen
 * Date: 2017/11/3
 * Time: 15:33
 */

namespace Tony\Task;

/**
 * 互斥接口
 * Interface Mutex
 * @package Tony\Task
 */
interface Mutex
{
    /**
     * Attempt to obtain a mutex for the given event.
     *
     * @param  \Illuminate\Console\Scheduling\Event $event
     * @return bool
     */
    public function create(Event $event);

    /**
     * Determine if a mutex exists for the given event.
     *
     * @param  \Illuminate\Console\Scheduling\Event $event
     * @return bool
     */
    public function exists(Event $event);

    /**
     * Clear the mutex for the given event.
     *
     * @param  \Illuminate\Console\Scheduling\Event $event
     * @return void
     */
    public function forget(Event $event);
}