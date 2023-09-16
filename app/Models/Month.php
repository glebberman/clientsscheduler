<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
 
    function getNameList() : array {
        
        return [
            '1' => [
                'regular' => 'january', 
                'declension' => 'january_declension',
            ],
            '2' => [
                'regular' => 'february', 
                'declension' => 'february_declension',
            ],
            '3' => [
                'regular' => 'march', 
                'declension' => 'march_declension',
            ],
            '4' => [
                'regular' => 'april', 
                'declension' => 'april_declension',
            ],
            '5' => [
                'regular' => 'may', 
                'declension' => 'may_declension',
            ],
            '6' => [
                'regular' => 'june', 
                'declension' => 'june_declension',
            ],
            '7' => [
                'regular' => 'july', 
                'declension' => 'july_declension',
            ],
            '8' => [
                'regular' => 'august', 
                'declension' => 'august_declension',
            ],
            '9' => [
                'regular' => 'september', 
                'declension' => 'september_declension',
            ],
            '10' => [
                'regular' => 'october', 
                'declension' => 'october_declension',
            ],
            '11' => [
                'regular' => 'november', 
                'declension' => 'november_declension',
            ],
            '12' => [
                'regular' => 'december', 
                'declension' => 'december_declension',
            ]
        ];
    }

}