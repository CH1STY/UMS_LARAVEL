<?php

namespace App\Exports;

use App\StudentAttendence;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentAttendenceExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return StudentAttendence::all();
    }
}
