<?php

namespace chillimarks\Http\Controllers\Core\Messaging;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use chillimarks\Models\Classes;
use chillimarks\Models\Exam;
use chillimarks\Models\Message;
use chillimarks\Models\Stream;
use chillimarks\Models\ClassesReport;
use chillimarks\Models\User;
use SMSProvider;

class MessagingController extends Controller
{
    public function index()
    {
    	$page = 'Messaging';

    	return view('core.messaging.index', compact('page'));
    }

    public function academic()
    {
    	$page    = 'Academic Messaging';

    	$classes_reports = ClassesReport::get();

        $streams = Stream::get();

    	return view('core.messaging.academic', compact('page', 'classes_reports', 'streams'));
    }

    public function send(Request $request)
    {   
        $this->validate($request, [
          'classesreport_id'                => 'required',
          'stream_id'                       => 'required',
        ]);

        $classesreport_id       = $request->input('classesreport_id');

        $stream_id              = $request->input('stream_id');



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


        foreach ($students as $student) {

            $maths_marks = round(\chillimarks\Http\Controllers\Core\Reports\PrimaryReportsCardsController::getMathsTotalReportMarks($student->id, $classesreport_id), 0);


            $eng_marks = round(\chillimarks\Http\Controllers\Core\Reports\PrimaryReportsCardsController::getEnglishTotalReportMarks($student->id, $classesreport_id), 0);
            
            $kiswa_marks = round(\chillimarks\Http\Controllers\Core\Reports\PrimaryReportsCardsController::getKiswaTotalReportMarks($student->id, $classesreport_id), 0);
            
            $sci_marks = round(\chillimarks\Http\Controllers\Core\Reports\PrimaryReportsCardsController::getScienceTotalReportMarks($student->id, $classesreport_id), 0);
            
            $ss_marks = round(\chillimarks\Http\Controllers\Core\Reports\PrimaryReportsCardsController::getSocialStudiesTotalReportMarks($student->id, $classesreport_id), 0);

            $total_marks = round(\chillimarks\Http\Controllers\Core\Reports\PrimaryReportsCardsController::getFinalReportMarks($student->id, $classesreport_id), 2);

            $class_position = \chillimarks\Http\Controllers\Core\Reports\PrimaryReportsCardsController::getStudentClassesPosition($classes_students, $student->id, $classesreport_id);

            $exam_message = 

                $student->name . ' (' . $student->admission->adm_no . ') of ' . $stream_current_abbr . ' scored:' 
                . '  Maths:'       . $maths_marks
                . ', Eng:'         . $eng_marks
                . ', Kiswa:'       . $kiswa_marks
                . ', Sci:'         . $sci_marks
                . ', S.S:'         . $ss_marks
                . ', Exam: '       . $total_marks
                . ', Class Pos: '  . $class_position
                . '.';

            SMSProvider::sendMessage($student->phone, $exam_message); 
        }

        $messages = 'Academic messages sent successfully!';

        return redirect()->route('classes')->with('success', $message);
    }


    public function notifications()
    {
        $page    = 'Messages';

        $messages = Message::get();

        return view('core.messaging.messages', compact('page', 'messages'));
    }

    public function notifystream()
    {
        $page    = 'Notify Stream';

        $streams = Stream::get();

        return view('core.messaging.notify-stream', compact('page', 'streams'));
    }

    public function notifyclass()
    {
        $page    = 'Notify Class';

        $classes = Classes::get();

        return view('core.messaging.notify-class', compact('page', 'classes'));
    }

    public function postnotifystream(Request $request)
    {
        $this->validate($request, [
          'stream_id'           => 'required|min:1',
          'message'             => 'required|max:130'
        ]);

        $stream_id               = $request->input('stream_id');

        $message               = $request->input('message');

        $students = User::whereHas(
                    'roles', function($q){
                        $q->where('name', 'student');
                    }
                )->whereHas(
                    'streams', function($q) use($stream_id){
                        $q->where('stream_id', $stream_id);
        })->get();

        $students_count          = count($students);

        $phone_nos         = [];

        foreach($students as $student)
        {   
            //store student's report in phone
            $phone_nos[] = $student->phone;
        }

        foreach($phone_nos as $phone_no)
        {
            SMSProvider::sendMessage($phone_no, $message);   
        }

        return redirect()->back()->with('info', 'messages successfully sent!');

    }

    public function postnotifyclass(Request $request)
    {
        $this->validate($request, [
          'class_id'           => 'required|min:1',
          'message'            => 'required|max:130'
        ]);

        $class_id              = $request->input('class_id');

        $message               = $request->input('message');

        $students = User::whereHas(
                    'roles', function($q){
                        $q->where('name', 'student');
                    }
                )->whereHas(
                    'streams.classes', function($q) use($class_id){
                        $q->where('id', $class_id);
        })->get();


        $students_count          = count($students);

        $phone_nos         = [];

        foreach($students as $student)
        {   
            //store student's report in phone
            $phone_nos[] = $student->phone;
        }

        foreach($phone_nos as $phone_no)
        {
            SMSProvider::sendMessage($phone_no, $message);   
        }

        return redirect()->back()->with('info', 'messages successfully sent!');
    }

    public function postnotification(Request $request)
    {
        $page    = 'Send Notification';

        return view('core.messaging.messages', compact('page'));
    }

    public function search(Request $request)
    {
        $this->validate($request, [
          'search'              => 'required|min:1'
        ],
        [
          'search.required'     => 'You need to search an message.',
        ]);

        $query                  = $request->input('search');


        $messages = Message::where('name', 'LIKE', '%' . $query . '%')->get();

        if(count($messages)==1)
        {
            $tense              = 'is';
            $result             = 'result.';
        }
        else
        {
            $tense              = 'are';
            $result             = 'results.';
        }

        $message                = 'There '. $tense . ' ' . count($messages) . ' message '. $result;

        $page                   = 'Messaging';

        return view('core.messaging.messages', compact('page', 'messages'));
    }

    public function view($id)
    {
        $page    = 'Message';

        $message = Message::whereId($id)->first();

        return view('core.messaging.view', compact('page', 'message'));
    }
}
