<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    /* Scopes */
    public function scopeActive($query) {
        return $this->where('status', 1);
    }

    /* Relations */
    public function categories() {
        return $this->belongsToMany('App\Category');
    }

    public function staff() {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function users() {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
