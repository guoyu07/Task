<?php

namespace Demo;

use SplSubject;
use Tony\Task\AbstractTask;

class LogAll extends AbstractTask
{
    public function update(SplSubject $subject)
    {
        echo 1111;
    }
}