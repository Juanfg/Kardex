<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Student;

class ProgramController extends Controller
{
    public function show($id)
    {
        $program = Program::where('id', $id)->firstOrFail();
        $students = Program::find($id)->students()->get();
        foreach ($students as $student)
        {
            $courses = Student::find($student->id)->courses()->get();
            $student->courses = $courses;
        }
        $courses = Program::find($id)->courses()->get();
        return view('programs.show', ['program_name' => $program->name, 'students' => $students, 'courses' => $courses]);
    }
}
