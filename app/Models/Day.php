<?php

namespace App\Models;

use DatePeriod;
use DateTime;
use DateInterval;
use App\Models\Settings;

class Day {

    private $days_of_week = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
    private $days = [];
    private $yearStart;
    private $yearEnd;

    function __construct(int $yearStart = null, int $yearEnd = null) {
        $settings = Settings::getAssoc();

        $this->yearStart = $yearStart ?? $settings['year_start'] ?? '1970';
        $this->yearEnd = $yearEnd ?? $settings['year_end'] ?? (intval(date('Y')) + 100);
        $this->set();
    }

    function set() : array {
        $start = $this->yearStart <= $this->yearEnd ? new DateTime("{$this->yearStart}-01-01") : new DateTime("{$this->yearEnd}-12-31");
        $end = $this->yearStart <= $this->yearEnd ? new DateTime("{$this->yearEnd}-12-31") : new DateTime("{$this->yearStart}-01-01");

        $period = new DatePeriod(
            $start,
            new DateInterval('P1D'),
            $end->modify('+1 day')
        );

        foreach ($period as $date) {
            if (!isset($this->days[$date->format('Y')])) {
                $this->days[$date->format('Y')] = [ 'count' => 0, 'months' => []];
            }
            if (!isset($this->days[$date->format('Y')]['months'][$date->format('m')])) {
                $this->days[$date->format('Y')]['months'][$date->format('m')] = [ 'count' => 0, 'days' => [] ];
            }
            $this->days[$date->format('Y')]['months'][$date->format('m')]['days'][$date->format('d')] = [ 
                'count' => 0,
                'dayOfWeek' => ucfirst(trans(strtolower($date->format('w'))))
            ];
        }

        return $this->days;
    }

    function get() : array {
        return $this->days;
    }

    function getNameList() : array {
        return [
            '1' => 'monday',
            '2' => 'tuesday',
            '3' => 'wednesday',
            '4' => 'thursday',
            '5' => 'friday',
            '6' => 'saturday',
            '7' => 'sunday'
        ];
    }

    function getShortNameList() : array {
        return [
            '1' => 'mon',
            '2' => 'tue',
            '3' => 'wed',
            '4' => 'thu',
            '5' => 'fri',
            '6' => 'sat',
            '7' => 'sun'
        ];
    }

}