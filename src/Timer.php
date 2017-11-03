<?php
/**
 * Created by PhpStorm.
 * User: Tony Chen
 * Date: 2017/11/3
 * Time: 14:07
 */

namespace Tony\Task;

use Tony\Task\Carbon\Carbon;
use Tony\Task\Cron\CronExpression;


class Timer
{
    use ManagesFrequencies;

    /**
     * 时区
     * @var
     */
    public $timezone;

    /**
     * The cron expression representing the event's frequency.
     *
     * @var string
     */
    public $expression = '* * * * * *';

    /**
     * Determine the next due date for an event.
     *
     * @param  \DateTime|string $currentTime
     * @param  int $nth
     * @param  bool $allowCurrentDate
     * @return null|Carbon
     */
    public function nextRunDate($currentTime = 'now', $nth = 0, $allowCurrentDate = false)
    {
        return Carbon::instance(
            CronExpression::factory($this->getExpression())->getNextRunDate($currentTime, $nth, $allowCurrentDate)
        );
    }

    /**
     * Get the Cron expression for the event.
     *
     * @return string
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * Determine if the given event should run based on the Cron expression.
     * @return bool
     */
    public function isDue()
    {
        return $this->expressionPasses();
    }


    /**
     * Determine if the Cron expression passes.
     *
     * @return bool
     */
    protected function expressionPasses()
    {
        $date = Carbon::now();

        if ($this->timezone) {
            $date->setTimezone($this->timezone);
        }

        return CronExpression::factory($this->expression)->isDue($date->toDateTimeString());
    }
}