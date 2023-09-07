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
            '1' => [
                'regular' => __('january'), 
                'declension' => __('january_declension') ?? __('january')],
            '2' => [
                'regular' => __('february'), 
                'declension' => __('february_declension') ??  __('february')],
            '3' => [
                'regular' => __('march'), 
                'declension' => __('march_declension') ?? __('march')],
            '4' => [
                'regular' => __('april'), 
                'declension' => __('april_declension') ?? __('april')],
            '5' => [
                'regular' => __('may'), 
                'declension' => __('may_declension') ?? __('may')],
            '6' => [
                'regular' => __('june'), 
                'declension' => __('june_declension') ?? __('june')],
            '7' => [
                'regular' => __('july'), 
                'declension' => __('july_declension') ?? __('july')],
            '8' => [
                'regular' => __('august'), 
                'declension' => __('august_declension') ?? __('august')],
            '9' => [
                'regular' => __('september'), 
                'declension' => __('september_declension') ?? __('september')],
            '10' => [
                'regular' => __('october'), 
                'declension' => __('october_declension') ?? __('october')],
            '11' => [
                'regular' => __('november'), 
                'declension' => __('november_declension') ?? __('november')],
            '12' => [
                'regular' => __('december'), 
                'declension' => __('december_declension') ?? __('december')],
        ];
    }

}