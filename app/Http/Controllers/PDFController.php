<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use Smalot\PdfParser\Element\ElementArray;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Program;
use App\Student;

class PDFController extends Controller
{
    public function create()
    {
        return view('pdf.create');
    }


    public function store(Request $request)
    {
        if (!$request->hasFile('pdf'))
        {
            $request->session()->flash('error', "No se agreg&oacute; ning&uacute;n PDF");
            return redirect()->route('pdf.create');
        }

        $this->storeDataFromPDF($request->pdf);

        $request->session()->flash("message", "Agregado con &eacute;xito");
        return redirect()->route('pdf.create');
    }

    public function storeDataFromPDF($file)
    {
        $parser = new Parser();
        $courses = Program::find(1)->courses()->get();

        $pdf = $parser->parseFile($file);
        $full_text = $pdf->getText();

        $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
        $full_text = strtr( $full_text, $unwanted_array );
        $full_text = preg_replace("/[^a-zA-Z 0-9]+/", "", $full_text);

        // Guardar datos del estudiante
        $name = "";
        $code = "";
        $program = "";
        $semester = "";

        //Nombre del estudiante
        $i = strlen('Nombre') + strpos($full_text, 'Nombre');
        $j = strpos($full_text, 'EstatusAcademico');
        while (true)
        {
            $name .= $full_text[$i];
            $i++;
            if ($i >= $j)
                break;
            $name .= ctype_upper($full_text[$i]) ? ' ' : ''; 
        }

        //Matricula del estudiante
        $i = strlen('Matricula') + strpos($full_text, 'Matricula');
        $j = strpos($full_text, 'UltimoPeriodo');
        while ($i < $j)
        {
            $code .= $full_text[$i];
            $i++;
        }

        //Programa del estudiante
        $i = strlen('Programa') + strpos($full_text, 'Programa');
        $j = strpos($full_text, 'PeriodoActual');
        while ($i < $j)
        {
            $program .= $full_text[$i];
            $i++;
        }

        //Semestre del estudiante
        $i = strlen('Semestreacreditado') + strpos($full_text, 'Semestreacreditado');
        $j = strpos($full_text, 'Unidadespermitidas');
        while ($i < $j)
        {
            $semester .= $full_text[$i];
            $i++;
        }
        $semester = $semester[0] == '0' ? $semester[1] : $semester;

        // Checar si el nombre ya existe
        $already_exist = Student::first()->where('code', $code)->get();
        if ($already_exist)
        {
            foreach ($already_exist as $student)
                Student::destroy($student->id);
        }

        // Crear estudiante
        $programs = Program::first()->where('name', $program)->get();
        $student = new Student();
        $student->code = $code;
        $student->name = $name;
        foreach ($programs as $program)
            $student->program_id = $program->id;
        $student->semester_id = $semester + 1;
        $student->save();

        // Guardar calificaciones
        foreach ($courses as $course)
        {
            $course_name = str_replace(" ", "", $course->name);
            $occurrence = strstr($full_text, $course_name);
            if ($occurrence)
            {   
                $i = strlen($course_name);
                if ($course->semester_id == 1)
                {
                    // Remediales
                    if ($occurrence[$i] == 'A')
                    {
                        DB::table('courses_students')->insert([
                            'course_id' => $course->id,
                            'student_id' => $student->id, //change it
                            'grade' => NULL,
                            'approved' => true
                        ]);
                    }
                    else
                    {
                        DB::table('courses_students')->insert([
                            'course_id' => $course->id,
                            'student_id' => $student->id,
                            'grade' => NULL,
                            'approved' => false
                        ]);
                    }
                }
                else
                {
                    // Semestre normal
                    $grade = "";
                    while (is_numeric($occurrence[$i]))
                    {
                        $grade .= $occurrence[$i];
                        $i++;
                    }

                    $grade = $grade == "" ? NULL : $grade;
                    $approved = $grade >= 70 ? true : false;

                    DB::table('courses_students')->insert([
                        'course_id' => $course->id,
                        'student_id' => $student->id,
                        'grade' => $grade,
                        'approved' => $approved
                    ]);
                }
            }
        }
    }
}
