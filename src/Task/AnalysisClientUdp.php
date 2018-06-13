<?php
/**
 * User: Tony Chen
 * Contact me: QQ329037122
 */

namespace App\Task;


class AnalysisClientUdp extends AnalysisBase
{
    public function doAnalysisDay(string $date): void
    {
        // @TODO analysis_time+every_state 建立唯一索引
        $dbSource = $this->getSourceField();

        $sql  = sprintf("SELECT COUNT(DISTINCT platform_uname) AS player_count, COUNT(platform_uname) AS count, state FROM %s WHERE DATE(log_time) = '%s' GROUP BY state", $dbSource['data_source_table'], $date);
        $data = $this->getDb()->fetchAll($sql);

        foreach ($data as $row)
        {
            $analysisTime = $date . ' 00:00:00';
            $insertSql    = sprintf("INSERT INTO %s SET analysis_time='%s', every_state=%d, player_count=%d, count=%d ON DUPLICATE KEY UPDATE player_count=%d, count=%d", $dbSource['table_name'], $analysisTime, $row['state'],
                $row['player_count'], $row['count'], $row['player_count'], $row['count']);

            $this->getDb()->execute($insertSql);
        }
    }

    public function getSourceField(): array
    {
        return ['table_name' => 'analysis_client_udp', 'data_source_table' => 'log_client_udp', 'data_source_table_time_field' => 'log_time'];
    }
}