<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public function students()
    {
        return $this->hasMany('App\Student');
    }

    public  function courses()
    {
        return $this->belongsToMany('App\Course', 'courses_programs');
    }
}
