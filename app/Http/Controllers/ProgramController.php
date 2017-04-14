<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
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
        return view('programs.show', ['program' => $program, 'students' => $students, 'courses' => $courses]);
    }

    public function excel($id)
    {
        $students = Program::find($id)->students()->get();
        foreach ($students as $student)
        {
            $courses = Student::find($student->id)->courses()->get();
            $student->courses = $courses;
        }

        $studentsArray = []; 

        $temp = ['Matricula', 'Nombre', 'Semestre'];
        foreach ($students[0]->courses as $course)
            array_push($temp, $course->name);
        array_push($studentsArray, $temp);
        
        foreach ($students as $student)
        {
            $temp = [];
            array_push($temp, $student->code, $student->name, ($student->semester_id) - 1);

            $len = count($student->courses);
            for ($i = 0; $i < $len; $i++)
            {
                if (!$student->courses[$i]->pivot->grade && $student->courses[$i]->pivot->approved)
                    array_push($temp, 'A');
                else if ($student->courses[$i]->pivot->currently_studying)
                    array_push($temp, 'CU');
                else
                    array_push($temp, $student->courses[$i]->pivot->grade);
            }
            array_push($studentsArray, $temp);
        }

        Excel::create('Concentrado de Alumnos', function($excel) use ($studentsArray) {

            $excel->setTitle('Concentrados');
            $excel->setCreator('Laravel')->setCompany('ITESM Puebla');
            $excel->setDescription('Concentrado');

            $excel->sheet('sheet1', function($sheet) use ($studentsArray) {
                $sheet->fromArray($studentsArray, null, 'A1', false, false);
            });

        })->download('xlsx');
    }
}
