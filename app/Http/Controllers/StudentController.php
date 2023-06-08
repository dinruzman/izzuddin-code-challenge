<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Services\StoreStudentsData;
use Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::get();

        return view('welcome',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,StoreStudentsData $storeStudentsData)
    {
        $request->validate([
            'fileUpload' => 'required|mimes:xls,xlsx',
        ]);

        /** move the logic to service container */
        $storeStudentsData->storeStudentData($request);

        return redirect('/')->with('success', 'Import successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function download(){
        $filepath = public_path('excel/example_excel.xlsx');
        return Response::download($filepath);
    }
}
