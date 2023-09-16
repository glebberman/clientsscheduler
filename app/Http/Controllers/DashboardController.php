<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Settings;
use App\Models\Translation;

class DashboardController extends Controller
{
    function index(Request $request): Response {
        
        return Inertia::render('Dashboard', [
            'translations' => Translation::getAll(),
            'settings' => Settings::getAssoc(),
        ]);
    }
}
