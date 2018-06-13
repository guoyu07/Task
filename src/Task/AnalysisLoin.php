<?php
/**
 * Created by PhpStorm.
 * User: chendan
 * Date: 2017/11/3
 * Time: 下午9:13
 */

namespace App\Task;


use SplSubject;
use Tony\Task\AbstractTask;

class AnalysisLoin extends AnalysisBase
{
    public function doAnalysisDay(string $date): void
    {

        $day1Players = $this->getLoginNum($date, 1);


    }

    public function getLoginNum(string $date, int $afterDay, bool $isAll = false): int
    {







        if ($isAll)
        {
            $sql = 'SELECT COUNT(DISTINCT(player_id)) FROM log_login';
        } else
        {
            $sql = sprintf("SELECT COUNT(DISTINCT(player_id)) FROM log_login WHERE DATE(login_time)='%s'", $date);
        }

        return (int)$this->getDb()->fetchSingle($sql);
    }

    public function getSourceField(): array
    {
        // TODO: Implement getSourceField() method.
    }
}