<?php


namespace App\Services;

use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;

class StoreStudentsData
{

    public function storeStudentData($request){

        Excel::import(new StudentsImport, $request->file('fileUpload'));

    }
}
