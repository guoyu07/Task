<?php
/**
 * User: Tony Chen
 * Contact me: QQ329037122
 */

namespace App\Task;


use SplSubject;
use Tony\DB\Database;
use Tony\DB\DbFactory;
use Tony\Task\AbstractTask;

abstract class AnalysisBase extends AbstractTask
{
    public function update(SplSubject $subject)
    {
        $dbSource = $this->getSourceField();
        //  ['table_name' => 'analysis_client_tcp', 'data_source_table' => 'log_client_tcp', 'data_source_table_time_field' => 'log_time'];
        $sql       = sprintf("SELECT IFNULL(%s,0) FROM %s ORDER BY %s LIMIT 1", $dbSource['data_source_table_time_field'], $dbSource['data_source_table'], $dbSource['data_source_table_time_field']);
        $firstTime = $this->getDb()->fetchSingle($sql);

        if ($firstTime === 0)
        {
            return;
        }

        $dateRangeArr = $this->getDateRangeArr(date('Y-m-d', strtotime($firstTime)), date('Y-m-d'));

        foreach ($dateRangeArr as $date)
        {

            $tableName = $dbSource['table_name'];
            // 数据已经分析过，就不再分析了
            if ($this->isAnalysed($tableName, $date) && !$this->isRealTimeAnalysis($tableName))
            {
                continue;
            }

            echo "analyzing: {$tableName} date:{$date} execution_time:{date('Y-m-d H:i:s')}" . "\n";

            $this->doAnalysisDay($date);
        }
    }

    // 是否分析过
    public function isAnalysed($tableName, $date): bool
    {
        $sql = sprintf("SELECT COUNT(analysis_time) FROM %s WHERE DATE(analysis_time)='%s'", $tableName, $date);
        $num = $this->getDb()->fetchSingle($sql);

        return $num > 0;
    }

    // 是否是需要实时更新的
    public function isRealTimeAnalysis($tableName): bool
    {
        return \in_array($tableName, ['analysis_client_udp', 'analysis_login'], true);
    }


    // 生成连续日期数组: ['2018-05-01','2018-05-02','2018-05-03',.....,'2018-05-31']
    public function getDateRangeArr($startDate, $endDate): array
    {
        // 生成日期区间
        $dateRange = new \DatePeriod(new \DateTime($startDate), new \DateInterval('P1D'), new \DateTime($endDate));

        $dateArr = [];
        foreach ($dateRange as $date)
        {
            /**@var $date \DateTime */
            $dateArr[] = $date->format('Y-m-d');
        }

        // 由于DatePeriod不包含最后一天的.所以手动加上去
        //$dateArr[] = $endDate;

        return $dateArr;
    }

    public function getDb(): Database
    {
        /* 数据库链接 ['dsn'=>'mysql:host=192.168.1.216;port=3306;dbname=rog_gmt;charset=utf8','user','password']*/
        return DbFactory::getDb(['dsn' => 'mysql:host=192.168.1.1;port=3306;dbname=rog_log_7u6u_s1;charset=utf8', 'user' => '', 'password' => '']);
    }

    // 分析数据
    abstract public function doAnalysisDay(string $date): void;

    // 获取数据源字段
    abstract public function getSourceField(): array;
}