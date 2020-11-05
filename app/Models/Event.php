<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function organizer()
    {
        return $this->belongsTo('App\Models\Organizer','organizer_id');
    }
    public function attendance()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }
}