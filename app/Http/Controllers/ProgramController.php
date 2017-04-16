<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Smalot\PdfParser\Parser;

use App\Program;
use App\Student;
use App\User;
use App\Course;

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

    public function create()
    {
        return view('programs.create');
    }

    public function get_string_between($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = $start == '' ? 1 : strpos($string, $start);
        if ($ini == 0)
            return '';
        $ini += strlen($start);

        $len = $end == '' ? strlen($string) : strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    public function storeFromPDF(Request $request)
    {
        if (!$request->hasFile('pdf'))
        {
            $request->session()->flash('error', "No se agreg&oacute; ning&uacute;n PDF");
            return redirect()->route('program.create');
        }

        $file = $request->pdf;
        $parser = new Parser();
        $pdf = $parser->parseFile($file);
        $full_text = $pdf->getText();
        $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
        $full_text = strtr( $full_text, $unwanted_array );

        $program_name = $this->get_string_between($full_text, '', 'Remediales');
        $program_name = preg_replace('/[^A-Za-z0-9\-]/', '', $program_name);

        $already_exists = Program::where('name', $program_name)->get();
        // Checar si el programa ya existe (Se borrara si encuentra coincidencia)
        if ($already_exists)
        {
            foreach ($already_exists as $program)
                Program::destroy($program->id);
        }

        // Crear el programa nuevo
        $program = new Program();
        $program->name = $program_name;
        $program->save();

        $semesters = ['Remediales', 'Primer Semestre', 'Segundo Semestre', 'Tercer Semestre', 'Cuarto Semestre', 'Quinto Semestre', 'Sexto Semestre', 'Septimo Semestre', 'Octavo Semestre', 'Noveno Semestre'];
        
        for ($i = 0; $i <= 9; $i++)
        {
            $start = $semesters[$i];
            $end = $i == 9 ? '' : $semesters[$i + 1];
            $courses = $this->get_string_between($full_text, $start, $end);
            $courses = trim(preg_replace('/\s+/', ' ', $courses));       
            echo $courses;    
            $courses = explode('#', $courses);

            for ($j = 1; $j < count($courses); $j++)
            {
                $course_code = $this->get_string_between($courses[$j], '', '-');
                $course_name = $this->get_string_between($courses[$j], '-', '');
                $course_units = 8; // TODO: Cambiar esto

                $already_exists = Course::where('code', $course_code)->get();
                if (!$already_exists)
                {
                    $course = new Course();
                    $course->code = $course_code;
                    $course->name = $course_name;
                    $course->semester_id = $i + 1;
                    $course->units = $course_units;
                    $course->save();
                }
                else
                    $course = $already_exists[0];

                DB::table('courses_programs')->insert([
                    'course_id' => $course->id,
                    'program_id' => $program->id
                ]);
            }
        }

        $request->session()->flash("message", "Programa creado con &eacute;xito");
        return redirect()->route('program.create');
    }
}
