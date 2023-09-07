<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Event;
use App\Models\Year;
use App\Models\Months;


class Calendar extends Model
{

    static function getYears(Employee $employee = null) {
        $years = Event::getEveryYearWithCountsByEmployee($employee);
        return $years;
    }

    static function getMonthsOfTheYear(Employee $employee = null) {
        $months = Event::getCountEveryMonthOfYearByEmployee($employee, $year);
        return $months;
    }


    static function getDaysOfClosestYears($year) {

        $firstDay = strtotime(($year - 2) . '-01-01');
        $lastDay = strtotime(($year + 2) . '-12-31');

        for ($i = $firstDay; $i <= $lastDay; $i = strtotime('+1 day', $i)) {
            $date = date('Y-m-d', $i);
            $days[$date] = 0;
        }

        return $days;
    }

    


}