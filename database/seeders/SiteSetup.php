<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            YourModel::create([
                'name' => $settingName,
                'value' => $value
            ]);
        }
    }

}
