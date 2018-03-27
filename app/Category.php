<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function events() {
        return $this->belongsToMany('App\Event');
    }

    public function scopeActive($query) {
        return $this->where('status', 1);
    }
}
