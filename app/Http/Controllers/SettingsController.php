<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Settings;
use App\Models\Translation;

class SettingsController extends Controller
{
    function index(Request $request): Response {
        
        return Inertia::render('Settings', [
            'translationList' => Translation::getList(),
            'translations' => Translation::getAll(),
            'storedSettings' => Settings::getAssoc(),
        ]);
    }

    function get(Request $request) : Response {
        $value = Settings::getValueByName($request->post('name'));
        
        return Inertia::render('Settings', [
            'translationList' => Translation::getList(),
            'translations' => Translation::getAll(),
            'storedSettings' => Settings::getAssoc(),
        ]);
    }

    function set(Request $request) : Response {
        Settings::setValueForName($request->post('name'), $request->post('value'));
        return $this->get($request);
    }
}
