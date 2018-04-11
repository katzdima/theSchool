<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    public function studentCon()
    {
        return $this->belongsToMany('App\Student','courses_students','courseId','studentId');    
    }
}
