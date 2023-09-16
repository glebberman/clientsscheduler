<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Settings;

class Translation extends Model
{
    protected $table = 'translations';
    static protected $translations = [];
 
    static function getList() : array {
        $languages = self::get()->pluck('name_native', 'code')->all();

        return $languages;
    }

    static function getAll(string $languageCode = null) : array {
        if (!isset($languageCode) && !empty(self::$translations)) {
            return self::$translations;
        }

        $languageCode = $languageCode ?? self::getCodeByName(Settings::getValueByName('language'));

        if (file_exists(base_path('lang/' . $languageCode . '.json'))) {
            $languageFile = base_path('lang/' . $languageCode . '.json');
        } else {
            $languageFile = base_path('lang/en.json');
        }

        self::$translations = json_decode(file_get_contents($languageFile), true);

        return self::$translations;
    }

    static function getCodeByName(string $name) : string {
        $code = self::find(1)->where('name_native', $name)->get()->first()->code;
        return $code;
    }

    static function getOne(string $word) : string {
        if (!isset(self::getAll()[$word])) {
            if (preg_match('/(.+)_declension$/', $word, $matches)) {
                return self::getAll()[$matches[1]] ?? $word;
            }
            return $word;
        }

        return self::getAll()[$word];
    }

    static function map(array $arrayToTranslate) : array {
        $translatedArray = array_map(function($value) {
            if (is_array($value)) {
                return self::map($value);
            }
            
            return self::getOne($value);           
        }, $arrayToTranslate);

        return $translatedArray;
    }


}
