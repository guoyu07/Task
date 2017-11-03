<?php
/**
 * Created by PhpStorm.
 * User: Tony Chen
 * Date: 2017/11/3
 * Time: 15:22
 */

namespace Tony\Task;


class DaemonBak
{
    public function fork()
    {
        $pid = pcntl_fork();
        switch ($pid) {
            case-1:
                echo "couldn't fork";
                break;
            case 0:
                echo "I'm parent";
                break;
            default:
                echo "I'm child";
        }
    }
//    function daemonize()
//    {
//        $pid = pcntl_fork();
//        if ($pid == -1)
//        {
//            die("fork(1) failed!\n");
//        }
//        elseif ($pid > 0)
//        {
////让由用户启动的进程退出
//            exit(0);
//        }
//
////建立一个有别于终端的新session以脱离终端
//        posix_setsid();
//
//        $pid = pcntl_fork();
//        if ($pid == -1)
//        {
//            die("fork(2) failed!\n");
//        }
//        elseif ($pid > 0)
//        {
////父进程退出, 剩下子进程成为最终的独立进程
//            exit(0);
//        }
//    }
//
//daemonize();
//sleep(1000);


}