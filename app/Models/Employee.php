<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use App\Models\Event;
use App\Models\Client;

class Employee extends Model
{
    
    protected $table = 'employees';
    const CREATED_AT = 'create_time';

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function clients(): HasManyThrough
    {
        return $this->hasManyThrough(Client::class, Event::class);
    }


}
