<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Calendar;
use App\Models\Event;
use App\Models\Employee;

class CalendarController extends Controller
{
    
    function index(Request $request): Response {
        $events = Event::getByEmployeeAndYear(Employee::find(1), date('Y'));
        
        return Inertia::render('Calendar', [
            'currentMonth' => date('m'),
            'yearsData' => Calendar::getYears(Employee::find(1)),
            'events' => Event::hierarchizeEventsByDate($events),
            'defaultActiveYear' => date('Y'),
        ]);
    }

}
