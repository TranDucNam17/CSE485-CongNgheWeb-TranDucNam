<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function index()
    {
        //
        $students = student::where('id', $classId)->get();
        return response()->json($students);
    }
}
