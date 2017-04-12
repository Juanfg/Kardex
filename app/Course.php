<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function semester()
    {
        return $this->belongsTo('App\Semester');
    }

    public function requirements()
    {
        return $this->hasMany('App\Requirement');
    }

    public function programs()
    {
        return $this->belongsToMany('App\Program', 'courses_programs');
    }

    public function students()
    {
        return $this->belongsToMany('App\Student', 'courses_students');
    }
}
