<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_prize extends Model
{
    protected $fillable = [
        'prize_name', 'description', 'events_id','member_id'
    ];

    public function event(){
        return $this->belongsTo(Event::class,'events_id');
    }
}
