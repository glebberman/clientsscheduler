<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use App\Models\EventType;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Year;
use App\Models\Days;

class Event extends Model
{
    
    protected $table = 'events';
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    public function eventType(): HasOne
    {
        return $this->hasOne(EventType::class);
    }

    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }

    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }

    static function getByEmployeeAndYear(Employee $employee, int $year) : array {
        $events = DB::table('events')
             ->join('event_types', 'event_types.id', '=', 'events.event_types_id')
             ->join('employees', 'employees.id', '=', 'events.employees_id')
             ->join('clients', 'clients.id', '=', 'events.clients_id')
             ->select(DB::raw(' events.id,
                                events.note,
                                events.offsite,
                                events.start_time,
                                events.finish_time,
                                events.address,

                                event_types.name AS event_type_name, 
                                event_types.description AS event_type_description, 
                                event_types.title_color_hex AS title_color, 
                                event_types.bg_color_hex AS bg_color,
                                event_types.client_is_not_involved,

                                clients.first_name AS client_first_name,
                                clients.second_name AS client_second_name,
                                clients.last_name AS client_last_name,

                                DATE_FORMAT(start_time, "%Y-%m-%d") AS date,
                                DATE_FORMAT(start_time, "%H:%i:%s") AS time,
                                DATE_FORMAT(start_time, "%w") AS day_of_the_week,
                                DATE_FORMAT(start_time, "%d") AS day,
                                DATE_FORMAT(start_time, "%m") AS month,
                                DATE_FORMAT(start_time, "%Y") AS year'))
             ->where('employees.id', '=', $employee->id)
             ->where('events.start_time', '>=', $year . '-01-01 00:00:00')
             ->where('events.start_time', '<=', $year . '-12-31 23:59:59')
             ->orderByDesc('events.start_time')
             ->get()->toArray();

        return $events ?? [];
    }  
    
    static function getFullData($event_id) {
        $event = DB::table('events')
             ->join('event_types', 'event_types.id', '=', 'events.event_types_id')
             ->join('employees', 'employees.id', '=', 'events.employees_id')
             ->join('clients', 'clients.id', '=', 'events.clients_id')
             ->select(DB::raw(' events.id, events.note,
                                events.offsite,
                                events.start_time,
                                events.end_time,
                                events.create_time,
                                events.address,
                                events.update_time,

                                event_types.name AS event_type_name, 
                                event_types.description AS event_type_description, 
                                event_types.title_color_hex AS title_color, 
                                event_types.bg_color_hex AS bg_color,
                                event_types.client_is_not_involved,

                                employees.first_name AS employee_first_name,
                                employees.second_name AS employee_second_name,
                                employees.last_name AS employee_last_name,
                                employees.specialization AS employee_specialization,

                                clients.first_name AS client_first_name,
                                clients.second_name AS client_second_name,
                                clients.last_name AS client_last_name,
                                clients.id_document AS client_id_document,
                                clients.phone AS client_phone,
                                clients.email AS client_email,
                                clients.photo AS client_photo,
                                clients.address AS client_address,
                                clients.comments AS client_comments'))
             ->where('events.id', '=', $event_id)
             ->orderByDesc('events.start_time')
             ->get()->toArray();

        return $event;
    }
    
    static function getCountEveryMonthOfYearByEmployee(Employee $employee, int $year): object {
        $months = array_fill(0, 12, 0);

        $countPerMonth = DB::table('events')
             ->join('event_types', 'event_types.id', '=', 'events.event_types_id')
             ->join('employees', 'employees.id', '=', 'events.employees_id')
             ->where('event_types.client_is_not_involved', '<>', 1)
             ->where('employees.id', '=', $employee->id)
             ->where('year', '=', $year)
             ->groupBy('month')
             ->get();

        $monthEventsCount = array_map(function($month) use ($countPerMonth) {
            return $countPerMonth[$month] ?? $month;
        }, $months);

        return $monthEventsCount ?? $months;
    }

    static function getEventsCountEveryYear(): object {
        $countByYear = DB::table('events')
             ->join('event_types', 'event_types.id', '=', 'events.event_types_id')
             ->select(DB::raw('DATE_FORMAT(start_time, "%Y") AS year, count(*) as count'))
             ->where('event_types.client_is_not_involved', '<>', 1)
             ->groupBy('year')
             ->get();

        return $countByYear ?? [];
    }   

    static function getEveryYearWithCountsByEmployee(Employee $employee): array {
        $everyYear = self::getEveryYearWithZeroEventsCount();
        $yearsWithEventsCount = self::getEventsCountEveryYearByEmployee($employee)
                                        ->pluck('count', 'year')
                                        ->all();
                                        
        if (empty($yearsWithEventsCount)) {
            return $everyYear;
        }

        $everyYearWithEventsCount = array_replace($everyYear, $yearsWithEventsCount);

        return $everyYearWithEventsCount;
    }

    static function getEveryYearWithCounts(): array {
        $everyYear = self::getEveryYearWithZeroEventsCount();
        $yearsWithEventsCount = self::getEventsCountEveryYear()
                                        ->pluck('count', 'year')
                                        ->all();
                                        
                                        
        if (empty($yearsWithEventsCount)) {
            return $everyYear;
        }

        $everyYearWithEventsCount = array_replace($everyYear, $yearsWithEventsCount);
        $everyYearWithEventsCountWithMarkedCurrentYear = Year::markCurrentYear($everyYearWithEventsCount);

        return $everyYearWithEventsCountWithMarkedCurrentYear;
    }

    static function getEveryYearWithZeroEventsCount(): array{
        $oneHundredYearsAhead = (int) date('Y') + 100;
        $years = array();
        
        for($year = 1970; $year <= $oneHundredYearsAhead; $year++){
            $years[$year] = 0;
        }

        return $years;
    }

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

    static function hierarchizeEventsByDate(array $events, string $yearStart, string $yearEnd) : array {
        $daysHierarchy = new Day($yearStart, $yearEnd);
        $hierarchizedEvents = $daysHierarchy->get();

        if (empty($events)) {
            return $hierarchizedEvents;
        }

        foreach($events as $event) {
            if (!isset($hierarchizedEvents[$event->year]['months'][$event->month]['days'][$event->day])) {
                continue;
            } else {
                $hierarchizedEvents[$event->year]['months'][$event->month]['days'][$event->day]['events'][$event->time] = $event;
                $hierarchizedEvents[$event->year]['count']++;
                $hierarchizedEvents[$event->year]['months'][$event->month]['count']++;
                $hierarchizedEvents[$event->year]['months'][$event->month]['days'][$event->day]['count']++;
            }
        }

        return $hierarchizedEvents;
    }

}
