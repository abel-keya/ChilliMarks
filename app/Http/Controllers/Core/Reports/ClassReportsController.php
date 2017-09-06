<?php

namespace chillimarks\Http\Controllers\Core\Reports;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use chillimarks\Models\Exam;
use chillimarks\Models\School;
use chillimarks\Models\ClassesReport;
use chillimarks\Models\User;
use chillimarks\Models\Grade;
use chillimarks\Models\Assessment;
use chillimarks\Models\Stream;
use Auth;
use Excel;
use Carbon\Carbon;
use DB;

class ClassReportsController extends Controller
{
    public function index()
    {
    	$page = 'Class Reports';

        $classreports = ClassesReport::latest()->limit(100)->get();

        return view('core.reports.classes.index', compact('page', 'classreports'));
    }

    public function search(Request $request)
    {
        $this->validate($request, [
          'search'              => 'required|min:1'
        ],
        [
          'search.required'     => 'You need to search an class report.',
        ]);

        $query                  = $request->input('search');


        $classreports = ClassesReport::where('name', 'LIKE', '%' . $query . '%')
            ->get();

        if(count($classreports)==1)
        {
            $tense              = 'is';
            $result             = 'result.';
        }
        else
        {
            $tense              = 'are';
            $result             = 'results.';
        }

        $message                = 'There '. $tense . ' ' . count($classreports) . ' classreport '. $result;

        $page                   = 'Class Reports';

        return view('core.reports.classes.index', compact('page', 'classreports'));
    }

    public function create()
    {
    	$page = 'Create Class Report';

        $exams = Exam::get();

    	return view('core.reports.classes.create', compact('page', 'exams'));
    }

    public function postcreate(Request $request)
    {
        $this->validate($request, [
          'name'              => 'required'
        ]);

        $name                 = $request->input('name');
        $exams                = $request->input('exams');

        $from_user            = Auth::user()->id;

        $classreport = ClassesReport::create([
            'name'            => $name,
            'from_user'       => $from_user
        ]);

        foreach($exams as $exam)
        {
            $examSelected     = Exam::whereId($exam)->first();
            $classreport->assignClassesExam($examSelected);
        }

        $message = 'Class Report created successfully!';

        return redirect('class-reports')->with('success', $message);
    }

    public function attachexam($id)
    {
        $page = 'Add Exam';

        $classreport = ClassesReport::whereId($id)->first();

        $exams = Exam::get();

        return view('core.reports.classes.attach', compact('page', 'classreport', 'exams'));
    }

    public function postattachexam(Request $request, $id)
    {
        $classreport = ClassesReport::whereId($id)->first();

        $exams                = $request->input('exams');

        $message = 'Sorry, Exam Not attached since its already attached!';

        foreach($exams as $exam)
        {
            $examSelected     = Exam::whereId($exam)->first();

            if(!$classreport->hasClassesExam($examSelected->id)){

                $classreport->assignClassesExam($examSelected);

                $message = 'Exam attached successfully!';
            }
        }

        return redirect()->route('view-class-report', compact('id'))->with('success', $message);
    }


    public function view($id)
    {
        $page = 'View Class Report';

        $classreport = ClassesReport::whereId($id)->first();

        return view('core.reports.classes.view', compact('page', 'classreport'));
    }

    public function edit($id)
    {
        $page = 'Edit Class Report';

        $classreport = ClassesReport::whereId($id)->first();

        return view('core.reports.classes.edit', compact('page', 'classreport'));
    }

    public function postedit(Request $request, $id)
    {
        $this->validate($request, [
          'name'              => 'required'
        ]);

        $name                 = $request->input('name');

        $from_user            = Auth::user()->id;

        $classreport = ClassesReport::whereId($id)->update([
            'name'            => $name,
            'from_user'       => $from_user
        ]);

        $message = 'Class Report updated successfully!';

        return redirect()->route('view-class-report', compact('id'))->with('success', $message);
    }

    public function detach($sr_id, $id)
    {
        $page = 'Detach Exam';

        $exam  = Exam::whereId($id)->first();

        return view('core.reports.classes.detach', compact('page', 'exam', 'sr_id', 'id'));
    }

    public function postdetach($sr_id, $id)
    {   
        $classreport     = ClassesReport::whereId($sr_id)->first();

        $examSelected     = Exam::whereId($id)->first();
        
        $classreport->removeClassesExam($examSelected);

        $message = 'Exam detached successfully!';

        return redirect()->route('view-class-report', compact('sr_id'))->with('success', $message);
    }

    public function delete($id)
    {
        $page = 'Delete Students';

        $classreport = ClassesReport::whereId($id)->first();

        return view('core.reports.classes.delete', compact('page', 'classreport'));
    }

    public function postdelete($id)
    {
        $classreport = ClassesReport::whereId($id)->first();

        DB::table('classes_report_exam')->where('classes_report_id', $id)->delete();

        $classreport->delete();

        $message = 'Class Report deleted successfully!';

        return redirect('class-reports')->with('success', $message);
    }

    public function download($id)
    {    

        $classesreport = ClassesReport::whereId($id)->first();
        
        $school = School::first();
        $school_name       = $school->name;
        $school_address    = $school->address . ' '. $school->phone; 

        //Get 1st exam in classes report
        $classesreport_exam = $classesreport->exams->first();

        $classesreport_class_id = $classesreport_exam->stream->class_id;
        $class_name           = $classesreport_exam->stream->classes->name;
        $classesreport_name    = $classesreport_exam->name . ' Exam, ' . $classesreport_exam->period . ', ' . $classesreport_exam->year;

        $date = Carbon::today()->format('jS F\\, Y');


        Excel::create('Classes Report', function($excel) use($id, $school_name, $school_address,  $class_name, $classesreport_name, $classesreport_class_id, $date){

            $excel->sheet('Classes Report', function($sheet) use($id, $school_name, $school_address, $class_name, $classesreport_name, $classesreport_class_id, $date){

                $sheet->setOrientation('landscape');

                $sheet->setPageMargin(array(
                    0.25, 0.15, 0.15, 0.25
                ));

                $sheet->setWidth(array(
                    'A'     =>  5,
                    'B'     =>  15,
                    'C'     =>  30,
                    'D'     =>  6,
                    'E'     =>  6,
                    'F'     =>  6,
                    'G'     =>  6,
                    'H'     =>  6,
                    'I'     =>  6,
                    'J'     =>  6,
                    'K'     =>  6,
                    'L'     =>  6,
                    'M'     =>  6,
                    'N'     =>  6,
                    'O'     =>  6,
                    'P'     =>  6,
                ));

                $sheet->setBorder('A7:Q11', 'thin');

                $sheet->mergeCells('A1:Q2');
                $sheet->mergeCells('A3:Q3');
                $sheet->mergeCells('A4:Q4');
                $sheet->mergeCells('A5:C5');
                $sheet->mergeCells('A6:Q6');

                $sheet->cell('A1', function($cell) use($school_name) {
                    $cell->setValue(strtoupper($school_name));
                    $cell->setFontWeight('bold');
                    $cell->setAlignment('center');
                    $cell->setFontSize(14);
                });

                $sheet->cell('A3', function($cell) use($school_address) {
                    $cell->setValue($school_address);
                    $cell->setFontWeight('bold');
                    $cell->setAlignment('center');
                    $cell->setFontSize(10);
                });

                $sheet->cell('A4', function($cell) use($class_name) {
                    $cell->setValue('Overall Class Report, '. $class_name);
                    $cell->setFontWeight('bold');
                    $cell->setAlignment('center');
                    $cell->setFontSize(10);
                });

                $sheet->cell('A5', function($cell) use($classesreport_name) {
                    $cell->setValue($classesreport_name);
                    $cell->setFontWeight('bold');
                    $cell->setAlignment('center');
                    $cell->setFontSize(10);
                });

                $sheet->cell('O5', function($cell) use($date) {
                    $cell->setValue($date);
                    $cell->setFontWeight('bold');
                    $cell->setAlignment('center');
                    $cell->setFontSize(10);
                });

                $htitle_cells = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q'];
                $hcontent_cells = ['POS.', 'ADM NO.', 'STUDENT NAME', 'MATHS', 'ENG', 'COMP', 'TOTAL', 'KISWA', 'INSHA', 'JUMLA', 'SCIE', 'S.S', 'C.R.E', 'I.R.E', 'H.R.E', 'TOTAL', 'FINAL'];

                

                $students = User::whereHas(
                    'roles', function($q){
                        $q->where('name', 'student');
                    }
                )->whereHas(
                    'grades.assessment.exam.stream', function($q) use($classesreport_class_id){
                        $q->where('class_id', $classesreport_class_id);
                    }
                )->get();

                $students_marks               = [];

                $students_mean_marks          = [];

                //populate marks to calculate mean
                $marks_mathematics            = [];
                $marks_english                = [];
                $marks_composition            = [];
                $marks_english_total          = [];
                $marks_kiswahili              = [];
                $marks_insha                  = [];
                $marks_kiswahili_total        = [];
                $marks_science                = [];
                $marks_social_studies         = [];
                $marks_cre                    = [];
                $marks_ire                    = [];
                $marks_hre                    = [];
                $marks_total_social_studies   = [];
                $marks_total_marks            = [];
                
                $i = 1;

                foreach($students as $student)
                {      
                    $i++;

                    $students_marks[$i]['position'] = '';
                    $students_marks[$i]['admission_no'] = $student->admission->adm_no;


                   	//need to be redone correctly->getting stream for the user
                    $student_stream = DB::table('stream_user')->where('user_id', $student->id)->first();
                    $student_stream    = $student_stream->stream_id;

                    $student_stream    = Stream::whereId($student_stream)->value('abbr');


                    $students_marks[$i]['student_name'] = $student->name . '(' . $student_stream . ')';


                    $mathematics_grade = Grade::whereStudentId($student->id)
                            ->whereHas(
                                'assessment', function($q){
                                    $q->where('name', '=' ,'Mathematics');
                                }
                    )->first();

                    $mathematics_assessment_id       = $mathematics_grade->assessment_id;

                    $mathematics_marks               = $mathematics_grade->marks;

                    $mathematics_assessment          = Assessment::whereId($mathematics_assessment_id)->first();

                    $mathematics_assessment_outof    = $mathematics_assessment->out_of;

                    $mathematics_assessment_contr    = $mathematics_assessment->contribution;


                    //compute assessment percentage

                    $mathematics_final = ($mathematics_marks / $mathematics_assessment_outof) * $mathematics_assessment_contr;

                    $students_marks[$i]['mathematics'] = $mathematics_final;

                    $marks_mathematics[$i]             = round($mathematics_final,2);




                    $english_grade = Grade::whereStudentId($student->id)
                            ->whereHas(
                                'assessment', function($q){
                                    $q->where('name', '=' ,'English');
                                }
                    )->first();

                    $english_assessment_id       = $english_grade->assessment_id;

                    $english_marks               = $english_grade->marks;

                    $english_assessment          = Assessment::whereId($english_assessment_id)->first();

                    $english_assessment_outof    = $english_assessment->out_of;

                    $english_assessment_contr    = $english_assessment->contribution;

                    //compute assessment percentage

                    $english_final = ($english_marks / $english_assessment_outof) * $english_assessment_contr;

                    $students_marks[$i]['english'] = $english_marks;

                    $marks_english[$i]             =   $english_final;




                    $composition_grade = Grade::whereStudentId($student->id)
                            ->whereHas(
                                'assessment', function($q){
                                    $q->where('name', '=' ,'Composition');
                                }
                    )->first();


                    $composition_assessment_id       = $composition_grade->assessment_id;

                    $composition_marks               = $composition_grade->marks;

                    $composition_assessment          = Assessment::whereId($english_assessment_id)->first();

                    $composition_assessment_outof    = $composition_assessment->out_of;

                    $composition_assessment_contr    = $composition_assessment->contribution;

                    //compute assessment percentage

                    $composition_final               = ($composition_marks / $composition_assessment_outof) * $composition_assessment_contr;

                    $students_marks[$i]['composition']  = $composition_marks;

                    $marks_composition[$i]           = $composition_final;




                    $english_total_final             = $english_final + $composition_final;

                    $students_marks[$i]['english_total']                = $english_total_final;

                    $marks_english_total[$i]           = round($english_total_final, 2);




                    $kiswahili_grade = Grade::whereStudentId($student->id)
                            ->whereHas(
                                'assessment', function($q){
                                    $q->where('name', '=' ,'Kiswahili');
                                }
                    )->first();

                    $kiswahili_assessment_id       = $kiswahili_grade->assessment_id;

                    $kiswahili_marks               = $kiswahili_grade->marks;

                    $kiswahili_assessment          = Assessment::whereId($kiswahili_assessment_id)->first();

                    $kiswahili_assessment_outof    = $kiswahili_assessment->out_of;

                    $kiswahili_assessment_contr    = $kiswahili_assessment->contribution;

                    //compute assessment percentage

                    $kiswahili_final = ($kiswahili_marks / $kiswahili_assessment_outof) * $kiswahili_assessment_contr;

                    $students_marks[$i]['kiswahili'] = $kiswahili_marks;

                    $marks_kiswahili[$i]           = $kiswahili_final;




                    $insha_grade = Grade::whereStudentId($student->id)
                            ->whereHas(
                                'assessment', function($q){
                                    $q->where('name', '=' ,'Insha');
                                }
                    )->first();


                    $insha_assessment_id           = $insha_grade->assessment_id;

                    $insha_marks                   = $insha_grade->marks;

                    $insha_assessment              = Assessment::whereId($insha_assessment_id)->first();

                    $insha_assessment_outof        = $insha_assessment->out_of;

                    $insha_assessment_contr        = $insha_assessment->contribution;

                    //compute assessment percentage

                    $insha_final                   = ($insha_marks / $insha_assessment_outof) * $insha_assessment_contr;

                    $students_marks[$i]['insha']   = $insha_marks;

                    $marks_insha[$i]               = $insha_final;




                    $kiswahili_total_final         = $kiswahili_final + $insha_final;

                    $students_marks[$i]['kiswahili_total']              = $kiswahili_total_final;

                    $marks_kiswahili_total[$i]           = round($kiswahili_total_final, 2);


                    
                    $science_grade = Grade::whereStudentId($student->id)
                            ->whereHas(
                                'assessment', function($q){
                                    $q->where('name', '=' ,'Science');
                                }
                    )->first();


                    $science_assessment_id         = $science_grade->assessment_id;

                    $science_marks                 = $science_grade->marks;

                    $science_assessment            = Assessment::whereId($science_assessment_id)->first();

                    $science_assessment_outof      = $science_assessment->out_of;

                    $science_assessment_contr      = $science_assessment->contribution;

                    //compute assessment percentage

                    $science_final                 = ($science_marks / $science_assessment_outof) * $science_assessment_contr;

                    $students_marks[$i]['science']              = $science_final;

                    $marks_science[$i]             = round($science_final, 2);





                    $social_studies_grade = Grade::whereStudentId($student->id)
                            ->whereHas(
                                'assessment', function($q){
                                    $q->where('name', '=' ,'Social Studies');
                                }
                    )->first();


                    $social_studies_assessment_id         = $social_studies_grade->assessment_id;

                    $social_studies_marks                 = $social_studies_grade->marks;

                    $social_studies_assessment            = Assessment::whereId($social_studies_assessment_id)->first();

                    $social_studies_assessment_outof      = $social_studies_assessment->out_of;

                    $social_studies_assessment_contr      = $social_studies_assessment->contribution;

                    //compute assessment percentage

                    $social_studies_final                 = ($social_studies_marks / $social_studies_assessment_outof) * $social_studies_assessment_contr;

                    $students_marks[$i]['social_studies'] = $social_studies_marks;

                    $marks_social_studies[$i]             = $social_studies_marks;




                    $cre_grade = Grade::whereStudentId($student->id)
                            ->whereHas(
                                'assessment', function($q){
                                    $q->where('name', '=' ,'C.R.E');
                                }
                    )->first();

                    if($cre_grade)
                    {
                        $cre_assessment_id         = $cre_grade->assessment_id;

                        $cre_marks                 = $cre_grade->marks;

                        $cre_assessment            = Assessment::whereId($cre_assessment_id)->first();

                        $cre_assessment_outof      = $cre_assessment->out_of;

                        $cre_assessment_contr      = $cre_assessment->contribution;

                        //compute assessment percentage

                        $cre_final                 = ($cre_marks / $cre_assessment_outof) * $cre_assessment_contr;

                        $students_marks[$i]['cre'] = $cre_marks;

                        $marks_cre[$i]             = $cre_marks;


                    } else {

                        $students_marks[$i]['cre'] = 0;
                    }


                    

                    $ire_grade = Grade::whereStudentId($student->id)
                            ->whereHas(
                                'assessment', function($q){
                                    $q->where('name', '=' ,'I.R.E');
                                }
                    )->first();

                    if($ire_grade)
                    {

                        $ire_assessment_id         = $ire_grade->assessment_id;

                        $ire_marks                 = $ire_grade->marks;

                        $ire_assessment            = Assessment::whereId($ire_assessment_id)->first();

                        $ire_assessment_outof      = $ire_assessment->out_of;

                        $ire_assessment_contr      = $ire_assessment->contribution;

                        //compute assessment percentage

                        $ire_final                 = ($ire_marks / $ire_assessment_outof) * $ire_assessment_contr;

                        $students_marks[$i]['ire']          = $ire_marks;

                        $marks_ire[$i]             = $ire_marks;

                    } else {
                        $students_marks[$i]['ire']          = 0;
                    }
                    


                    $hre_grade = Grade::whereStudentId($student->id)
                            ->whereHas(
                                'assessment', function($q){
                                    $q->where('name', '=' ,'H.R.E');
                                }
                    )->first();

                    if($hre_grade)
                    {

                        $hre_assessment_id             = $hre_grade->assessment_id;

                        $hre_marks                     = $hre_grade->marks;

                        $hre_assessment                = Assessment::whereId($hre_assessment_id)->first();

                        $hre_assessment_outof          = $hre_assessment->out_of;

                        $hre_assessment_contr          = $hre_assessment->contribution;

                        //compute assessment percentage

                        $hre_final                     = ($hre_marks / $hre_assessment_outof) * $hre_assessment_contr;

                        $students_marks[$i]['hre']     = $hre_marks;

                        $marks_hre[$i]                 = $hre_marks;

                    } else {
                        $students_marks[$i]['hre']     = 0;
                    }
                    

                    $exam_pretotal_marks               = $mathematics_final + $english_total_final + $kiswahili_total_final + $science_final;

                    if($social_studies_grade && $cre_final)
                    {
                        $total_social_studies_final    = ($social_studies_final + $cre_final);

                        $exam_total_marks              = $exam_pretotal_marks + $total_social_studies_final;

                        $students_marks[$i]['social_studies_total']     = $total_social_studies_final;

                        $marks_total_social_studies[$i]        = $total_social_studies_final;



                        $students_marks[$i]['final_total']     = $exam_total_marks;

                        $marks_total_marks[$i]        = round($exam_total_marks, 2);
                    } 
                    
                    if($social_studies_grade && $ire_grade)
                    {
                        $total_social_studies_final    = ($social_studies_final + $ire_final);

                        $exam_total_marks              = $exam_pretotal_marks + $total_social_studies_final;
                        
                        $students_marks[$i]['social_studies_total']     = $total_social_studies_final;

                        $marks_total_social_studies[$i]  = $total_social_studies_final;



                        $students_marks[$i]['final_total']     = $exam_total_marks;

                        $marks_total_marks[$i]        = round($exam_total_marks, 2);
                    }   
                    
                    if($social_studies_grade && $hre_grade)
                    {
                        $total_social_studies_final    = ($social_studies_final + $hre_final);

                        $exam_total_marks              = $exam_pretotal_marks + $total_social_studies_final;
                        
                        $students_marks[$i]['social_studies_total']     = $total_social_studies_final;

                        $marks_total_social_studies[$i]  = $total_social_studies_final;



                        $students_marks[$i]['final_total']     = $exam_total_marks;

                        $marks_total_marks[$i]        = round($exam_total_marks, 2);
                    }
                        
                }
                


                //count no of student marks records
                $students_marks_no = sizeof($students_marks);

                //calculate mean marks & handling division by zero

                if(sizeof($marks_mathematics)!=0){
                    $mean_marks_mathematics            = array_sum($marks_mathematics)/sizeof($marks_mathematics);
                    $mean_marks_mathematics            = round($mean_marks_mathematics, 2);
                } else {
                    $mean_marks_mathematics = 0;
                }

                if(sizeof($marks_english)!=0){
                    $mean_marks_english                = array_sum($marks_english)/sizeof($marks_english);
                    $mean_marks_english                = round($mean_marks_english, 2);
                } else {
                    $mean_marks_english                = 0;
                }

                if(sizeof($marks_composition)!=0){
                    $mean_marks_composition            = array_sum($marks_composition)/sizeof($marks_composition);
                    $mean_marks_composition            = round($mean_marks_composition, 2);
                } else {
                    $mean_marks_composition                = 0;
                }

                if(sizeof($marks_english_total)!=0){
                    $mean_marks_english_total          = array_sum($marks_english_total)/sizeof($marks_english_total);
                    $mean_marks_english_total          = round($mean_marks_english_total, 2);
                } else {
                    $mean_marks_english_total                = 0;
                }

                if(sizeof($marks_kiswahili)!=0){
                    $mean_marks_kiswahili              = array_sum($marks_kiswahili)/sizeof($marks_kiswahili);
                    $mean_marks_kiswahili              = round($mean_marks_kiswahili, 2);
                } else {
                    $mean_marks_kiswahili                = 0;
                }

                if(sizeof($marks_insha)!=0){
                    $mean_marks_insha                  = array_sum($marks_insha)/sizeof($marks_insha);
                    $mean_marks_insha                  = round($mean_marks_insha, 2);
                } else {
                    $mean_marks_insha                = 0;
                }

                if(sizeof($marks_kiswahili_total)!=0){
                    $mean_marks_kiswahili_total        = array_sum($marks_kiswahili_total)/sizeof($marks_kiswahili_total);
                    $mean_marks_kiswahili_total          = round($mean_marks_kiswahili_total, 2);
                } else {
                    $mean_marks_kiswahili_total                = 0;
                }

                if(sizeof($marks_science)!=0){
                    $mean_marks_science                = array_sum($marks_science)/sizeof($marks_science);
                    $mean_marks_science                = round($mean_marks_science, 2);
                } else {
                    $mean_marks_science                = 0;
                }

                if(sizeof($marks_social_studies)!=0){
                    $mean_marks_social_studies         = array_sum($marks_social_studies)/sizeof($marks_social_studies);
                    $mean_marks_social_studies         = round($mean_marks_social_studies, 2);
                } else {
                    $mean_marks_social_studies                = 0;
                }

                if(sizeof($marks_cre)!=0){
                    $mean_marks_cre                    = array_sum($marks_cre)/sizeof($marks_cre);
                    $mean_marks_cre                    = round($mean_marks_cre, 2);
                } else {
                    $mean_marks_cre                = 0;
                }

                if(sizeof($marks_ire)!=0){
                    $mean_marks_ire                    = array_sum($marks_ire)/sizeof($marks_ire);
                    $mean_marks_ire                    = round($mean_marks_ire, 2);
                } else {
                    $mean_marks_ire                = 0;
                }

                if(sizeof($marks_hre)!=0){
                    $mean_marks_hre                    = array_sum($marks_hre)/sizeof($marks_hre);
                    $mean_marks_hre                    = round($mean_marks_hre, 2);
                } else {
                    $mean_marks_hre                = 0;
                }

                if(sizeof($marks_total_social_studies)!=0){
                    $mean_marks_total_social_studies   = array_sum($marks_total_social_studies)/sizeof($marks_total_social_studies);
                    $mean_marks_total_social_studies   = round($mean_marks_total_social_studies, 2);
                } else {
                    $mean_marks_total_social_studies                = 0;
                }

                if(sizeof($marks_total_marks)!=0){
                    $mean_marks_total_marks            = array_sum($marks_total_marks)/sizeof($marks_total_marks);
                    $mean_marks_total_marks            = round($mean_marks_total_marks, 2);
                } else {
                    $mean_marks_total_marks                = 0;
                }
                
                
                $students_mean_marks = ['MEAN MARKS', '', '', $mean_marks_mathematics, $mean_marks_english, $mean_marks_composition, $mean_marks_english_total, $mean_marks_kiswahili, $mean_marks_insha, $mean_marks_kiswahili_total, $mean_marks_science, $mean_marks_social_studies, $mean_marks_cre, $mean_marks_ire, $mean_marks_hre, $mean_marks_total_social_studies, $mean_marks_total_marks];
                //return dd($students_mean_marks);

                //populate header
                for($i = 0; $i < 17; $i++)
                {   
                    $htitle_cell = $htitle_cells[$i];
                    $htitle_cell = $htitle_cell . '7';

                    $hcontent_cell = $hcontent_cells[$i];
                    $hcontent_cell = $hcontent_cell;

                    $sheet->cell($htitle_cell, function($cell) use($hcontent_cell) {
                        $cell->setValue($hcontent_cell);
                        $cell->setFontWeight('bold');
                        $cell->setAlignment('center');
                        $cell->setFontSize(9.5);
                    });

                    $sheet->cell($htitle_cell, function($cell) use($hcontent_cell) {
                        $cell->setValue($hcontent_cell);
                        $cell->setFontWeight('bold');
                        $cell->setAlignment('center');
                        $cell->setFontSize(9.5);
                    });
                }


                //center position marks
                for($k = 0; $k < $students_marks_no; $k++)
                {      
                    $bcount      = $k + 8;

                    $sheet->row($bcount, function($row) {

                        $row->setAlignment('center');

                    });
                }

                //populate marks
                for($j=0; $j < $students_marks_no; $j++){

                    //sort from highest to lowest final_total
                    usort($students_marks, function($a, $b) {
                        return $a['final_total'] < $b['final_total'];
                    });

                    $sheet->row($j+8, round($students_marks[$j], 2));
                }

                //populate position numbers
                for($t=1; $t<=$students_marks_no; $t++)
                {   
                    $p = 7+$t;
                    $q = 'A'.$p;
                    $sheet->cell($q, function($cell) use($t) {
                        $cell->setValue($t);
                    });
                }

                $mean_count      = $students_marks_no + 8;

                //populate mean marks
                for($i = 0; $i < 17; $i++)
                {    

                    $title_cell = $htitle_cells[$i];
                    $title_cell = $title_cell . $mean_count;

                    $content_cells = $students_mean_marks[$i];
                    $content_cells = $content_cells;

                    

                    $sheet->cell($title_cell, function($cell) use($content_cells) {
                        $cell->setValue($content_cells);
                        $cell->setFontWeight('bold');
                        $cell->setAlignment('center');
                    });

                    //$sheet->row($mean_count, $students_mean_marks[$d]);
                }

                //merge and center total marks title cells
                $sheet->mergeCells('A' . $mean_count .':C'. $mean_count);

                $sheet->cell('A'.$mean_count, function($cell){
                    $cell->setFontWeight('bold');
                    $cell->setAlignment('center');
                    $cell->setFontSize(9.5);
                });

            });

        })->download('xlsx');
    }
}
