<?php
/**
 * Created by PhpStorm.
 * User: Tony Chen
 * Date: 2017/11/3
 * Time: 15:21
 */

namespace Tony\Task;

use SplObjectStorage;

class Runner extends Daemon
{
    /**
     * @var CronCenter
     */
    public $crons;

    private $config;

    /**
     * 进程id
     * @var
     */
    private $pid;

    /**
     * 配置  ['pid' => '/tmp/process.pid', // 进程id
     *        'stdin' => '/dev/null',// 标准输入'
     *         stdout' => '/tmp/stdout.txt',  // 标准输出
     *         'stderr' => '/tmp/stderr.txt'// 错误输出
     *       ]
     * Runner constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
        $this->pid    = $config['pid'];
    }

    /**
     * 时间对象
     * @param SplObjectStorage $crons
     * @return Runner
     */
    public function setCrons(SplObjectStorage $crons): Runner
    {
        $this->crons = $crons;
        return $this;
    }

    public function start()
    {
        $pid = $this->config['pid'];

        try
        {
            if (self::isRunning($pid))
            {
                echo "daemon is already running.\n";
                return;
            }
        } catch (\Exception $e)
        {

        }

        try
        {
            self::work($this->config, function ($stdin, $stdout, $stderr) {
                // these parameters are optional
                while (true)
                {
                    // do whatever it is daemons do
                    sleep(1); // sleep is good for you

                    // 循环处理每个定时器
                    foreach ($this->crons as $cron)
                    {
                        /**
                         * @var CronCenter $cron
                         */
                        if ($cron->isDue())
                        {
                            $cron->notify();
                        }
                    }
                }
            }
            );

            echo "daemon is now running.\n";
        } catch (\Exception $e)
        {

        }
    }

    public function stop()
    {
        self::kill($this->pid);
    }

    public function ask()
    {
        if (self::isRunning($this->pid))
        {
            echo "daemon is running.\n";
        } else
        {
            echo "daemon is not running.\n";
        }
    }

    public function once(): void
    {
        // 循环处理每个定时器
        foreach ($this->crons as $cron)
        {
            /**
             * @var CronCenter $cron
             */
            $cron->notify();
        }
    }
}