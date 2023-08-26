<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use App\Models\Event;
use App\Models\Employee;

class Client extends Model
{
    
    protected $table = 'clients';
    const CREATED_AT = 'create_time';

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function employees(): HasManyThrough
    {
        return $this->hasManyThrough(Employee::class, Event::class);
    }

}
