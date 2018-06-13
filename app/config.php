<?php

return [
    'daemon' => [
        'pid' => '/tmp/php_task.pid', // 进程id
        'stdin' => '/dev/null',      // 标准输入
        'stdout' => '/tmp/stdout.txt',  // 标准输出
        'stderr' => '/tmp/stderr.txt',  // 错误输出
    ]
];