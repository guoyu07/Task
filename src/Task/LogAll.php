<?php

namespace Demo\Task;

use SplSubject;
use Tony\Task\AbstractTask;

class LogAll extends AbstractTask
{
    public function update(SplSubject $subject)
    {
        echo "我来测试一下1秒运行一次\n";
    }
}