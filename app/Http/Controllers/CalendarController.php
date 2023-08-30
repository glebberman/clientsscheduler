<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Calendar;
use App\Models\Year;
use App\Models\Event;
use App\Models\Employee;

class CalendarController extends Controller
{
    
    function index(Request $request): Response {
        $defaultEmployee = Employee::find(1);
        $employees = Employee::all();
        $events = Event::getByEmployeeAndYear($defaultEmployee, date('Y'));
        $years = Calendar::getYears($defaultEmployee);
        
        return Inertia::render('Calendar', [
            'weekFirstDay' => config('week_first_day'),
            'defaultActiveMonth' => date('m'),
            'defaultActiveYear' => date('Y'),
            'defaultEmployee' => $defaultEmployee,
            'yearsData' => $years,
            'employees' => $employees,
            'events' => Event::hierarchizeEventsByDate($events, array_key_first($years), array_key_last($years)),
            'everyDay'  => Year::getEveryYearWithCounts(date('Y'))
        ]);
    }

}
