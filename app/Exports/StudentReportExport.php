<?php

namespace App\Exports;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentReportExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array
    {
        return[

            "Student Id",
            "Student Name",
            "Course Id",
            "Marks",
            "Credits Completed",
            "Created At",
            "Updated At"
        ];
    }
    public function collection()
    {
        $value = DB::table('student_courses','students')
                    ->join('students','students.student_id','=','student_courses.student_id')
                    ->SELECT ('student_courses.student_id','students.name','student_courses.course_id',
                    "student_courses.marks",'students.credits_completed','student_courses.created_at','student_courses.updated_at')
                    ->get();
        return $value;

    }
}
