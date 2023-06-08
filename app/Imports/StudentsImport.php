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
        $array = $rows->toArray();
        $array = array_combine(range(1, count($array)), $array);

        Validator::make($array, [
            '*.name' => 'required',
            '*.class' => 'required',
            '*.level' => 'required',
            '*.parent_contact' => 'required|regex:/^[0-9]+$/|digits_between:10,11',
        ])->validate();

        foreach ($rows as $row)
        {
            $student = Student::where('name',$row['name'])->where('class',$row['class'])->where('level',$row['level'])->where('parent_phone_no',$row['parent_contact'])->first();

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
