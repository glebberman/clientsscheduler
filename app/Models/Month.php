<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Month;

class Month extends Model
{
 
    static function getNameList() {
        return [
            '1' => __('january'),
            '2' => __('february'),
            '3' => __('march'),
            '4' => __('april'),
            '5' => __('may'),
            '6' => __('june'),
            '7' => __('july'),
            '8' => __('august'),
            '9' => __('september'),
            '10' => __('october'),
            '11' => __('november'),
            '12' => __('december')
        ];
    }

}