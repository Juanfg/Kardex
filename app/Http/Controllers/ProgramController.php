<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Program;
use App\Student;
use App\User;

class ProgramController extends Controller
{
    public function show($id)
    {
        $program = Program::where('id', $id)->firstOrFail();
        $students = Program::find($id)->students()->where('user_id', Auth::user()->id)->get();
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
        $current_user = Auth::user();
        $students = Program::find($id)->students()->where('user_id', $current_user->id)->get();

        foreach ($students as $student)
        {
            $courses = Student::find($student->id)->courses()->get();
            $student->courses = $courses;
        }

        $studentsArray = []; 

        $temp = ['Matricula', 'Nombre', 'Semestre'];

        if (count($students) > 0)
        {
            foreach ($students[0]->courses as $course)
                array_push($temp, $course->name);
        }

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

    public function catalog()
    {
        $current_user = Auth::user();
        $programs_user = User::find($current_user->id)->programs()->get();
        $programs_id_user = [];
        foreach ($programs_user as $program)
            array_push($programs_id_user, $program->id);
        $programs_not_user = Program::whereNotIn('id', $programs_id_user)->get();
        return view('programs.select', ['programs_user' => $programs_user, 'programs_not_user' => $programs_not_user]);
    }

    public function select(Request $request)
    {
        $programs = Program::all();
        $current_user = Auth::user();
        $programs_user = User::find($current_user->id)->programs()->get();
        foreach ($programs as $program)
        {
            if ($request[($program->name)])
            {
                $already_registered = false;
                foreach ($programs_user as $program_user)
                {
                    if ($program_user->id == $program->id)
                    {
                        $already_registered = true;
                        break;
                    }
                }
                
                if (!$already_registered)
                {
                    DB::table('programs_users')->insert([
                        'program_id' => $program->id,
                        'user_id' => $current_user->id
                    ]);
                }
            }
            else
            {
                $registered = false;
                foreach ($programs_user as $program_user)
                {
                    if ($program_user->id == $program->id)
                    {
                        $registered = true;
                        break;
                    }
                }
                
                if ($registered)
                    DB::table('programs_users')->where('program_id', $program->id)->where('user_id', $current_user->id)->delete();
            }
        }
        return redirect()->route('program.catalog');
    }
}
