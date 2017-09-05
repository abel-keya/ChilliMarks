<?php

namespace chillimarks\Http\Controllers\Core\Reports;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use chillimarks\Models\School;
use chillimarks\Models\Stream;
use chillimarks\Models\StreamReport;
use chillimarks\Models\ClassesReport;
use chillimarks\Models\Assessment;
use chillimarks\Models\User;
use chillimarks\Models\Grade;
use Carbon\Carbon;
use PDF;

class PrimaryReportsCardsController extends Controller
{
    public function index(Request $request)
    {	
    	$this->validate($request, [
          'classesreport_id'                => 'required',
          'stream_id'                       => 'required',
        ]);

        $classesreport_id       = $request->input('classesreport_id');

        $stream_id              = $request->input('stream_id');



        $school = School::first();
        
        $school_name            = $school->name;

        $school_address         = $school->address; 

        $school_phone           =  $school->phone;



        $classesreport = ClassesReport::whereId($classesreport_id)->first();

        $classesreport_id = $classesreport->id;

        //Get 1st exam in classes report
        $classesreport_exam = $classesreport->exams->first();

        $classesreport_class_id = $classesreport_exam->stream->class_id;

        $streamreport_class_id  = $classesreport_exam->stream_id;

        $classesreport_name     = $classesreport_exam->name . ' Exam, ' . $classesreport_exam->period . ', ' . $classesreport_exam->year;



        $stream                 = Stream::whereId($stream_id)->first();

        $stream_current_abbr    = $stream->abbr; 

        $stream_current_name    = $stream->name;

        $stream_class_name      = $stream->classes->name;

        $date                   = Carbon::today()->format('jS F\\, Y');

        //students in a stream
        $students = User::whereHas(
                    'roles', function($q){
                        $q->where('name', 'student');
                    }
                )->whereHas(
                    'grades.assessment.exam', function($q) use($streamreport_class_id){
                        $q->where('stream_id', $streamreport_class_id);
                    }
        )->get();

        //students in a class
        $classes_students = User::whereHas(
                    'roles', function($q){
                        $q->where('name', 'student');
                    }
                )->whereHas(
                    'grades.assessment.exam.stream', function($q) use($classesreport_class_id){
                        $q->where('class_id', $classesreport_class_id);
                    }
        )->get();


        $grades = Grade::whereHas(
                    'assessment.exam.stream', function($q) use($classesreport_class_id){
                        $q->where('class_id', $classesreport_class_id);
                    }
        )->get();



    	$pdf = PDF::loadView('core.reports.report-cards.primary-report', compact('school_name', 'school_address', 'school_phone', 'classesreport_name', 'stream_current_abbr', 'date', 'stream_class_name', 'stream_current_name', 'students', 'grades', 'classesreport_id', 'streamreport_class_id', 'classes_students'));

        return $pdf->download('Class Report.pdf');
    }


    public static function getMathsTotalReportMarks($student_id, $classesreport_id)
    {   
        $student = User::whereId($student_id)->first();

        $classes_report = ClassesReport::whereId($classesreport_id)->first();

        $maths_exam     = $classes_report->exams->where('subject.name','Mathematics')->first();

        $maths_marks    = $student->grades->where('assessment.name','Mathematics')->where('assessment.exam.id', $maths_exam->id)->first()->marks;

        $assessment_id = $student->grades->where('assessment.name','Mathematics')->where('assessment.exam.id', $maths_exam->id)->first()->assessment_id;

        $out_of_marks = Assessment::whereId($assessment_id)->first()->out_of;

        $maths_contr_marks = Assessment::whereId($assessment_id)->first()->contribution;

        $maths_final = ($maths_marks / $out_of_marks) * $maths_contr_marks;
        
        return number_format($maths_final, 2);
    }

    public static function getEnglishTotalReportMarks($student_id, $classesreport_id)
    {   

        $student = User::whereId($student_id)->first();

        $classes_report = ClassesReport::whereId($classesreport_id)->first();

        $english_exam     = $classes_report->exams->where('subject.name','English')->first();

        $eng_subject_marks = $student->grades->where('assessment.name','English')->where('assessment.exam.id', $english_exam->id)->first()->marks;

        $eng_assessment_id = $student->grades->where('assessment.name','English')->where('assessment.exam.id', $english_exam->id)->first()->assessment_id;

        $eng_out_of_marks = Assessment::whereId($eng_assessment_id)->first()->out_of;

        $eng_contr_marks  = Assessment::whereId($eng_assessment_id)->first()->contribution;
        
        $english_total = ($eng_subject_marks / $eng_out_of_marks) * $eng_contr_marks;


        $comp_subject_marks = $student->grades->where('assessment.name','Composition')->where('assessment.exam.id', $english_exam->id)->first()->marks;

        $comp_assessment_id = $student->grades->where('assessment.name','Composition')->where('assessment.exam.id', $english_exam->id)->first()->assessment_id;

        $comp_out_of_marks  = Assessment::whereId($comp_assessment_id)->first()->out_of;

        $comp_contr_marks   = Assessment::whereId($comp_assessment_id)->first()->contribution;
        
        $comp_total = ($comp_subject_marks / $comp_out_of_marks) * $comp_contr_marks;

        $english_final = $english_total + $comp_total;

        return number_format($english_final, 2);
    }

    public static function getKiswaTotalReportMarks($student_id, $classesreport_id)
    {   
        $student          = User::whereId($student_id)->first();

        $classes_report   = ClassesReport::whereId($classesreport_id)->first();

        $kiswa_exam     = $classes_report->exams->where('subject.name','Kiswahili')->first();

        $kiswa_subject_marks = $student->grades->where('assessment.name','Kiswahili')->where('assessment.exam.id', $kiswa_exam->id)->first()->marks;

        $kiswa_assessment_id = $student->grades->where('assessment.name','Kiswahili')->where('assessment.exam.id', $kiswa_exam->id)->first()->assessment_id;

        $kiswa_out_of_marks = Assessment::whereId($kiswa_assessment_id)->first()->out_of;

        $kiswa_contr_marks = Assessment::whereId($kiswa_assessment_id)->first()->contribution;
        
        $kiswa_total = ($kiswa_subject_marks / $kiswa_out_of_marks) * $kiswa_contr_marks;



        $insha_subject_marks = $student->grades->where('assessment.name','Insha')->where('assessment.exam.id', $kiswa_exam->id)->first()->marks;

        $insha_assessment_id = $student->grades->where('assessment.name','Insha')->where('assessment.exam.id', $kiswa_exam->id)->first()->assessment_id;

        $insha_out_of_marks = Assessment::whereId($insha_assessment_id)->first()->out_of;

        $insha_contr_marks = Assessment::whereId($insha_assessment_id)->first()->contribution;
        
        $insha_total = ($insha_subject_marks / $insha_out_of_marks) * $insha_contr_marks;

        $kiswa_final = $kiswa_total + $insha_total;

        return number_format($kiswa_final, 2);
    }

    public static function getScienceTotalReportMarks($student_id, $classesreport_id)
    {   
        $student = User::whereId($student_id)->first();

        $classes_report   = ClassesReport::whereId($classesreport_id)->first();

        $science_exam     = $classes_report->exams->where('subject.name','Science')->first();

        $science_marks = $student->grades->where('assessment.name','Science')->where('assessment.exam.id', $science_exam->id)->first()->marks;

        $assessment_id = $student->grades->where('assessment.name','Science')->where('assessment.exam.id', $science_exam->id)->first()->assessment_id;

        $out_of_marks = Assessment::whereId($assessment_id)->first()->out_of;

        $science_contr_marks = Assessment::whereId($assessment_id)->first()->contribution;

        $science_final = ($science_marks / $out_of_marks) * $science_contr_marks;
        
        return number_format($science_final, 2);
    }

    public static function getSocialStudiesTotalReportMarks($student_id, $classesreport_id)
    {   
        $student                      = User::whereId($student_id)->first();

        $classes_report               = ClassesReport::whereId($classesreport_id)->first();

        $social_studies_exam          = $classes_report->exams->where('subject.name','Social Studies')->first();

        $social_studies_subject_marks = $student->grades->where('assessment.name','Social Studies')->where('assessment.exam.id', $social_studies_exam->id)->first()->marks;

        $social_studies_assessment_id = $student->grades->where('assessment.name','Social Studies')->where('assessment.exam.id', $social_studies_exam->id)->first()->assessment_id;

        $social_studies_out_of_marks  = Assessment::whereId($social_studies_assessment_id)->first()->out_of;

        $social_studies_contr_marks   = Assessment::whereId($social_studies_assessment_id)->first()->contribution;
        
        $social_studies_total = ($social_studies_subject_marks / $social_studies_out_of_marks) * $social_studies_contr_marks;




        $cre_subject = $student->grades->where('assessment.name','C.R.E')->where('assessment.exam.id', $social_studies_exam->id)->first();

        $ire_subject = $student->grades->where('assessment.name','I.R.E')->where('assessment.exam.id', $social_studies_exam->id)->first();

        $hre_subject = $student->grades->where('assessment.name','H.R.E')->where('assessment.exam.id', $social_studies_exam->id)->first();


        if(count($cre_subject)>0)
        {
        	$cre_subject_marks    = $cre_subject->marks;

        	$cre_assessment_id    = $cre_subject->assessment_id;

        	$cre_out_of_marks     =  Assessment::whereId($cre_assessment_id)->first()->out_of;

        	$cre_contr_marks      = Assessment::whereId($cre_assessment_id)->first()->contribution;

        	$cre_total            = ($cre_subject_marks / $cre_out_of_marks) * $cre_contr_marks;

        	$social_studies_final = $social_studies_total + $cre_total;

        	return number_format($social_studies_final, 2);
        }

        if(count($ire_subject)>0)
        {
        	$ire_subject_marks    = $ire_subject->marks;

        	$ire_assessment_id    = $ire_subject->assessment_id;

        	$ire_out_of_marks     = Assessment::whereId($ire_assessment_id)->first()->out_of;

        	$ire_contr_marks      = Assessment::whereId($ire_assessment_id)->first()->contribution;

        	$ire_total            = ($ire_subject_marks / $ire_out_of_marks) * $ire_contr_marks;

        	$social_studies_final = $social_studies_total + $ire_total;

        	return number_format($social_studies_final, 2);
        }

        if(count($hre_subject)>0)
        {
        	$hre_subject_marks    = $hre_subject->marks;

        	$hre_assessment_id    = $hre_subject->assessment_id;

        	$hre_out_of_marks     = Assessment::whereId($hre_assessment_id)->first()->out_of;

        	$hre_contr_marks      = Assessment::whereId($hre_assessment_id)->first()->contribution;

        	$hre_total            = ($hre_subject_marks / $hre_out_of_marks) * $hre_contr_marks;

        	$social_studies_final = $social_studies_total + $hre_total;

        	return number_format($social_studies_final, 2);
        }
    }

    public static function getFinalReportMarks($student_id, $classesreport_id)
    {
    	$maths_marks           = self::getMathsTotalReportMarks($student_id, $classesreport_id);

    	$english_marks         = self::getEnglishTotalReportMarks($student_id, $classesreport_id);

    	$kiswa_marks           = self::getKiswaTotalReportMarks($student_id, $classesreport_id);

    	$science_marks         = self::getScienceTotalReportMarks($student_id, $classesreport_id);

    	$social_studies_marks  = self::getSocialStudiesTotalReportMarks($student_id, $classesreport_id);

    	return number_format($maths_marks + $english_marks + $kiswa_marks + $science_marks + $social_studies_marks, 2);
    }

    public static function getStudentStreamPosition($students, $student_id, $classesreport_id)
    {	
    	$student_marks = [];

    	$no_of_students = count($students);
    	
    	$i = 0;

    	//store marks in array in order to sort and get index
    	foreach($students as $student)
    	{	
    		$i = $i + 1;
    		$student_marks[$i]['marks'] = number_format(self::getFinalReportMarks($student->id, $classesreport_id), 2);
    		$student_marks[$i]['admission'] = $student->id;
    	}

    	//sort from highest to lowest final_total
    	usort($student_marks, function($a, $b) {
    		return $a['marks'] < $b['marks'];
    	});

    	$key = array_search($student_id, array_column($student_marks, 'admission'));

    	return $key + 1 . ' / '. $no_of_students;
    }

    public static function getStudentClassesPosition($classes_students, $student_id, $classesreport_id)
    {	
    	$student_marks = [];

    	$no_of_students = count($classes_students);
    	

    	$i = 0;

    	//store marks in array in order to sort and get index
    	foreach($classes_students as $student)
    	{	
    		$i = $i + 1;
    		$student_marks[$i]['marks'] = number_format(self::getFinalReportMarks($student->id, $classesreport_id), 2);
    		$student_marks[$i]['admission'] = $student->id;
    	}

    	//sort from highest to lowest final_total
    	usort($student_marks, function($a, $b) {
    		return $a['marks'] < $b['marks'];
    	});

    	$key = array_search($student_id, array_column($student_marks, 'admission'));

    	return $key + 1 . ' / '. $no_of_students;
    }
}
