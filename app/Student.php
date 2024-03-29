<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function program()
    {
        return $this->belongsTo('App\Program');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'courses_students')->withPivot('grade', 'currently_studying', 'approved');
    }
}
