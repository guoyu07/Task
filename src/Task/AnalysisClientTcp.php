<?php
/**
 * User: Tony Chen
 * Contact me: QQ329037122
 */

namespace App\Task;

class AnalysisClientTcp extends AnalysisBase
{
    public function doAnalysisDay(string $date): void
    {
        $dbSource = $this->getSourceField();

        for ($i = 1; $i <= 101; $i++)
        {
            $step = 'step ' . $i;

            $sql = sprintf("SELECT COUNT(*) AS num, operate FROM %s WHERE operate LIKE '%s' AND DATE(%s)='%s' LIMIT 1", $dbSource['data_source_table'], $step, $dbSource['data_source_table_time_field'], $date);
            $row = $this->getDb()->fetchRow($sql);

            if ($row['num'] === 0)
            {
                continue;
            }

            $insertSQL = sprintf("INSERT INTO %s SET analysis_time='%s', every_operate=%d, `count`=%d", $dbSource['table_name'], $date . ' 00:00:00', $i, $row['num']);
            $this->getDb()->execute($insertSQL);
        }
    }

    public function getSourceField(): array
    {
        return ['table_name' => 'analysis_client_tcp', 'data_source_table' => 'log_client_tcp', 'data_source_table_time_field' => 'log_time'];
    }
}