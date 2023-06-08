<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToCollection,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $student = Student::where('name',$row['name'])->where('class',$row['class'])->where('level',$row['level'])->where('parent_phone_no',$row['parent_contact'])->first();

            Validator::make($rows->toArray(), [
                '*.name' => 'required',
                '*.class' => 'required',
                '*.level' => 'required',
                '*.parent_contact' => 'required|digits_between:10,11',
            ])->validate();

            if(!$student){
                Student::create([
                    'name' =>  $row['name'],
                    'class' =>  $row['class'],
                    'level' =>  $row['level'],
                    'parent_phone_no' =>  $row['parent_contact'],
                ]);
            }
        }
    }
}
