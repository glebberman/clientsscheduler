<?php

namespace App\Models;

use DatePeriod;
use DateTime;
use DateInterval;

class DaysHierarchy {

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
                'dayOfWeek' => $date->format('w')
            ];
        }

        return $this->days;
    }

    function get() {
        return $this->days;
    }

}