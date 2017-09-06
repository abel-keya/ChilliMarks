<?php

namespace chillimarks\Http\Controllers\Core\Exams;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use chillimarks\Models\Exam;
use chillimarks\Models\Subject;
use chillimarks\Models\User;
use chillimarks\Models\Classes;
use chillimarks\Models\Stream;
use chillimarks\Models\Grade;
use chillimarks\Models\Assessment;
use chillimarks\Models\StreamReport;
use chillimarks\Models\ClassesReport;
use Auth;

class ExamsController extends Controller
{ 
    public function index()
    {
    	$page = 'Exams';

    	$exams = Exam::latest()->limit(100)->get();

    	return view('core.exams.index', compact('page', 'exams'));
    }

    public function search(Request $request)
    {
        $this->validate($request, [
          'search'              => 'required|min:1'
        ],
        [
          'search.required'     => 'You need to search an exam.',
        ]);

        $query                  = $request->input('search');


        $exams = Exam::where('name', 'LIKE', '%' . $query . '%')
            ->orWhereHas('subject', function ($term) use($query) {
                $term->where('name','LIKE', '%' . $query . '%');
            })
            ->orWhereHas('classes', function ($term) use($query) {
                $term->where('name','LIKE', '%' . $query . '%');
            })
            ->orwhere('period', 'LIKE', '%' . $query . '%')
            ->orwhere('year', 'LIKE', '%' . $query . '%')
            ->get();

        if(count($exams)==1)
        {
            $tense              = 'is';
            $result             = 'result.';
        }
        else
        {
            $tense              = 'are';
            $result             = 'results.';
        }

        $message                = 'There '. $tense . ' ' . count($exams) . ' exam '. $result;

        $page                   = 'Exams';

        return view('core.exams.index', compact('page', 'exams'));
    }

    public function view($id)
    {
    	$page = 'View Exam';

    	$exam = Exam::whereId($id)->first();

        $assessments = Assessment::whereExamId($exam->id)->get();


        //code to hide create assessment if total contribution is > 100% and exam is not Social studies = S.S
        $assessments_sum = $assessments->sum('contribution');

        $can_create_assessment = True;

        if($assessments_sum >= 99.99999)
        {   
            $can_create_assessment = False;

            //take care of social studies assessments sum
            if($assessments_sum <= 160 && $exam->subject->code == 'S.S')
            {   
                $can_create_assessment = True;
            }
        }

        

    	return view('core.exams.view', compact('page', 'exam', 'assessments', 'can_create_assessment'));
    }

    public function create()
    {
      $page = 'Create Exam';

      $subjects = Subject::get();

      $streams  = Stream::get();

      return view('core.exams.create', compact('page', 'subjects', 'streams'));
    }

    public function postcreate(Request $request)
    {
    	$this->validate($request, [
        'name'                 => 'required|min:1',
        'subject_id'           => 'required',
        'stream_id'            => 'required',
        'period'               => 'required',
        'year'                 => 'required'
        ]);

    	    $name                     = $request->input('name');
    	    $subject_id               = $request->input('subject_id');
    	    $stream_id                = $request->input('stream_id');
            $period                   = $request->input('period');
            $year                     = $request->input('year');
            $from_user                = Auth::user()->id;

      $exam                     = Exam::create([
        'name'                => $name,
        'subject_id'          => $subject_id,
        'stream_id'           => $stream_id,
        'period'              => $period,
        'year'                => $year,
        'status'              => 0,
        'from_user'           => $from_user
        ]);

      $message = 'Exam created successfully!';

      return redirect()->route('view-exam', [$exam->id])->with('success', $message);
    }

    public function edit($id)
    {
    	$page = 'Edit Exam';

    	$exam = Exam::whereId($id)->first();

        $teachers = User::whereHas(
            'roles', function($q){
                $q->where('name', 'teacher');
            }
        )->get();

    	return view('core.exams.edit', compact('page', 'exam', 'teachers'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, [
            'name'                 => 'required|min:1',
            'period'               => 'required',
            'year'                 => 'required'
        ]);

    	$name                     = $request->input('name');
        $period                   = $request->input('period');
        $year                     = $request->input('year');
        $from_user                = Auth::user()->id;

        $exam                     = Exam::whereId($id)->update([
            'name'                => $name,
            'period'              => $period,
            'year'                => $year,
            'from_user'           => $from_user
        ]);

      $message = 'Exam updated successfully.';

      return redirect()->route('view-exam', [$id])->with('success', $message);
    }

    public function confirm($id)
    {
    	$page = 'Confirm Delete';

    	$exam = Exam::whereId($id)->first();

    	return view('core.exams.delete', compact('page', 'exam'));
    }

    public function delete($id)
    {
    	$exam        = Exam::whereId($id)->first();

        //detach exam from classes report

        $classreports     = ClassesReport::get();

        foreach($classreports as $classreport)
        {
            if($classreport->hasClassesExam($exam->id))
            {
                $classreport->removeClassesExam($exam);
            }
        }

        //detach exam from stream report

        $streamreports     = StreamReport::get();

        foreach($streamreports as $streamreport)
        {
            if($streamreport->hasExam($exam->id))
            {
                $streamreport->removeExam($exam);
            }
        }

        $assessments = Assessment::whereExamId($id)->get();

        foreach($assessments as $assessment)
        {
            $assessment_current = $assessment->id;

            Grade::whereAssessmentId($assessment_current)->delete();

            Assessment::whereId($assessment_current)->delete();
        }

    	$exam->delete();

    	$message = 'Exam, assessments, grades and reports deletion and detaching successfully done!';

    	return redirect('exams')->with('success', $message);
    }

    public function createallexams()
    {
        $page = 'Create All Exams';

        return view('core.exams.create-all', compact('page'));
    }
}
