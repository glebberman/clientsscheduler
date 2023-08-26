<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Month;

class Month extends Model
{

    

    static function getEventsCountEveryYearByEmployee(Employee $employee): object {
        $countByYear = DB::table('events')
             ->join('event_types', 'event_types.id', '=', 'events.event_types_id')
             ->join('employees', 'employees.id', '=', 'events.employees_id')
             ->select(DB::raw('DATE_FORMAT(start_time, "%Y") AS year, count(*) as count'))
             ->where('event_types.client_is_not_involved', '<>', 1)
             ->where('employees.id', '=', $employee->id)
             ->groupBy('year')
             ->get();

        return $countByYear ?? [];
    }  

    

}