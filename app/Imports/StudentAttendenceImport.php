<?php

namespace App\Imports;

use App\StudentAttendence;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentAttendenceImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $query = StudentAttendence::orderby('student_attendence_id','desc')
                                    ->first();
        $st = intval(substr($query->student_attendence_id, 2,5))+1;
        $st = "SA".strval($st);
        return new StudentAttendence([

            'student_attendence_id'     => $st,
            'attendence'                => $row[2],
            'status'                    => $row[3],
            'student_id'         => $row[4],
            'course_id'         => $row[5],
            'teacher_id'         => $row[6],

        ]);
    }
}
