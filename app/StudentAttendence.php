<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAttendence extends Model
{
    protected $fillable = array('id','student_attendence_id','attendence','status',
                                'student_id','course_id','teacher_id','created_at','updated_at');
}
