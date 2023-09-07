<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class Year extends Model
{
    

    static function markCurrentYear(array $years) : array {
        $markedYear = array_map(function($year){
            $year = ['year' => $year, 'current' => $year === date('Y')];
            return $year;
        }, $years);

        return $markedYear;
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


    static function getEventsByEmployeeAndYear(Employee $employee, int $year): object {
        $events = DB::table('events')
             ->join('event_types', 'event_types.id', '=', 'events.event_types_id')
             ->join('employees', 'employees.id', '=', 'events.employees_id')
             ->select(DB::raw('DATE_FORMAT(start_time, "%Y-%m-%d") AS date, DATE_FORMAT(start_time, "%Y") AS year'))
             ->where('employees.id', '=', $employee->id)
             ->where('start_time', '>=', $year . '-01-01 00:00:00')
             ->where('start_time', '<=', $year . '-31-12 23:59:59')
             ->groupBy('date')
             ->orderByDesc('date')
             ->get();

        return $events ?? [];
    }  


    
    
}