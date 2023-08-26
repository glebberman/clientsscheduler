<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Employee;

class EmplyeeController extends Controller
{

    public function show() {
        $employees = Employee::all();
        return Inertia::render('Employees/Index', ['employees' => $employees]);
    }


}