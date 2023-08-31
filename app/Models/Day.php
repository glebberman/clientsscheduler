<?php

namespace App\Models;

use DatePeriod;
use DateTime;
use DateInterval;

class Day {

    private $days = [];
    private $yearStart;
    private $yearEnd;

    function __construct($yearStart, $yearEnd) {
        $this->yearStart = $yearStart;
        $this->yearEnd = $yearEnd;
        $this->set();
    }

    function set() {
        $start = $this->yearStart <= $this->yearEnd ? new DateTime("{$this->yearStart}-01-01") : new DateTime("{$this->yearEnd}-12-31");
        $end = $this->yearStart <= $this->yearEnd ? new DateTime("{$this->yearEnd}-12-31") : new DateTime("{$this->yearStart}-01-01");

        $period = new DatePeriod(
            $start,
            new DateInterval('P1D'),
            $end->modify('+1 day')
        );

        foreach ($period as $date) {
            if (!isset($this->days[$date->format('Y')])) {
                $this->days[$date->format('Y')] = [];
            }
            if (!isset($this->days[$date->format('Y')][$date->format('m')])) {
                $this->days[$date->format('Y')][$date->format('m')] = [];
            }
            $this->days[$date->format('Y')][$date->format('m')][$date->format('d')] = [ 
                'dayOfWeek' => ucfirst(trans(strtolower($date->format('w'))))
            ];
        }

        return $this->days;
    }

    function get() {
        return $this->days;
    }

    static function getNameList() {
        return [
            '1' => __('monday'),
            '2' => __('tuesday'),
            '3' => __('wednesday'),
            '4' => __('thursday'),
            '5' => __('friday'),
            '6' => __('saturday'),
            '7' => __('sunday')
        ];
    }

    static function getShortNameList() {
        return [
            '1' => __('mon'),
            '2' => __('tue'),
            '3' => __('wed'),
            '4' => __('thu'),
            '5' => __('fri'),
            '6' => __('sat'),
            '7' => __('sun')
        ];
    }

}