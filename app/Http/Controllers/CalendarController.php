<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Calendar;
use App\Models\Settings;
use App\Models\Day;
use App\Models\Month;
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
            'settings' => Settings::getAssoc(),
            'weekFirstDay' => config('week_first_day'),
            'defaultActiveDay' => date('Y-m-d'),
            'defaultActiveMonth' => date('m'),
            'defaultActiveYear' => date('Y'),
            'defaultEmployee' => $defaultEmployee,
            'yearsData' => $years,
            'monthsNamesList' => Month::getNameList(),
            'employees' => $employees,
            'daysNamesList' => Day::getNameList(),
            'daysNamesShortList' => Day::getShortNameList(),
            'trans' => function () {
                return json_decode(file_get_contents(base_path('lang/'. app()->getLocale() .'.json')), true);
            },
            'events' => Event::hierarchizeEventsByDate($events, array_key_first($years), array_key_last($years)),
            'everyDay'  => Event::getEveryYearWithCounts(date('Y')),
        ]);
    }

}
