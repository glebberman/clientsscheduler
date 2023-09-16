<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings;

class SiteSetup extends Seeder
{

    protected $defaultSettings = [
        'language' => 'en',
        'firstDayOfTheWeek' => 'monday',
        'weekend' => '["saturday", "sunday"]',
        'workingHours' => '8:00 - 20:00',
        'startYear' => '2023',
        'endYear' => null,
    ];

    public function run() : void
    {
        self::$defaultSettings['startYear'] = date('Y');

        foreach (self::$defaultSettings as $settingName => $value) {
            Settings::create([
                'name' => $settingName,
                'value' => $value
            ]);
        }
    }

}
