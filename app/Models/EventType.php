<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Event;

class EventType extends Model
{
    
    protected $table = 'event_types';
    const CREATED_AT = 'create_time';


    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }


}
