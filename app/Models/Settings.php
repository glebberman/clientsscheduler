<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    
    protected $table = 'settings';
    protected static $settings = [];

    static function getAssoc() : array{
        if (empty(self::$settings)) {
            self::$settings = self::get()->pluck('value', 'name')->all();
        }

        return self::$settings;
    }

    static function setValueForName(string $name, string $value) :void {
        self::where('name', $name)->update(['value' => $value]);
        self::$settings[$name] = $value;
    }

    static function getValueByName(string $name) : string{
        return self::getAssoc()[$name];
    }

}
