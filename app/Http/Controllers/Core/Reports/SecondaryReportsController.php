<?php

namespace chillimarks\Http\Controllers\Core\Reports;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use chillimarks\Models\ClassesReport;
use chillimarks\Models\Stream;

class SecondaryReportsController extends Controller
{
    public function reportforms()
    {
    	$page = 'Report Forms';

        $classesreports = ClassesReport::get();

        $streams = Stream::get();

    	return view('core.reports.secondary.report-forms', compact('page', 'classesreports', 'streams'));
    }

    public function postreportforms()
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
}
