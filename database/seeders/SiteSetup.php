<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings;

class SiteSetup extends Seeder
{
    static $defaultSettings = [
        'language' => 'en',
        'firstDayOfTheWeek' => 'monday',
        'weekend' => '["saturday", "sunday"]',
        'workingHours' => '8:00 - 20:00',
    ];

    public function run(): void
    {
        foreach (self::$defaultSettings as $settingName => $value) {
            Settings::create([
                'name' => $settingName,
                'value' => $value
            ]);
        }
    }

}
