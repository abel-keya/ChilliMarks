<?php

namespace chilliapp\Http\Controllers\Core\Exams;

use Illuminate\Http\Request;
use chilliapp\Http\Controllers\Controller;
use chilliapp\Models\Exam;
use chilliapp\Models\Subject;
use chilliapp\Models\User;
use chilliapp\Models\Classes;
use chilliapp\Models\Stream;
use chilliapp\Models\Grade;
use Auth;

class ExamsController extends Controller
{ 
    public function index()
    {
    	$page = 'Exams';

    	$exams = Exam::get();

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
            ->orWhereHas('teacher', function ($term) use($query) {
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

    	return view('core.exams.view', compact('page', 'exam'));
    }

    public function create()
    {
      $page = 'Create Exam';

      $subjects = Subject::get();

      $teachers = User::whereHas(
            'roles', function($q){
                $q->where('name', 'teacher');
            }
        )->get();


      $streams  = Stream::get();

      return view('core.exams.create', compact('page', 'subjects', 'teachers', 'streams'));
    }

    public function postcreate(Request $request)
    {
    	$this->validate($request, [
          'name'                 => 'required|min:1',
          'subject_id'           => 'required',
          'teacher_id'           => 'required',
          'stream_id'            => 'required',
          'period'               => 'required',
          'year'                 => 'required'
          ]);

    	$name                     = $request->input('name');
    	$subject_id               = $request->input('subject_id');
    	$teacher_id               = $request->input('teacher_id');
    	$stream_id                = $request->input('stream_id');
      $period                   = $request->input('period');
      $year                     = $request->input('year');
      $from_user                = Auth::user()->id;


      $students          = User::WhereHas(
                            'streams', function($q) use ($stream_id){
                                $q->where('stream_id', $stream_id);
                            }
                        )->get();

      if($students->count()>0)
      {
        $exam                     = Exam::create([
          'name'                => $name,
          'subject_id'          => $subject_id,
          'teacher_id'          => $teacher_id,
          'stream_id'           => $stream_id,
          'period'              => $period,
          'year'                => $year,
          'status'              => 0,
          'from_user'           => $from_user
        ]);

        foreach($students as $student)
        {
          $grade = Grade::create([
              'exam_id'             => $exam->id,
              'student_id'          => $student->id,
              'grade'               => 0,
              'status'              => 0,
              'from_user'           => $from_user
          ]);
        }

        $message = 'Exam & Grades created successfully!';

        return redirect('exams')->with('success', $message);

      } else {

        $message = 'Sorry, Exams & Grades were not created since there are no students in that class!';

        return redirect('exams')->with('success', $message);
      }

    }

    public function edit($id)
    {
    	$page = 'Edit Exam';

    	$exam = Exam::whereId($id)->first();

      $subjects = Subject::get();

      $teachers = User::whereHas(
            'roles', function($q){
                $q->where('name', 'teacher');
            }
        )->get();

      $streams  = Stream::get();

    	return view('core.exams.edit', compact('page', 'exam', 'subjects', 'teachers', 'streams'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, [
        'name'                 => 'required|min:1',
        'subject_id'           => 'required',
        'teacher_id'           => 'required',
        'stream_id'            => 'required',
        ]);

    	$name                     = $request->input('name');
    	$subject_id               = $request->input('subject_id');
    	$teacher_id               = $request->input('teacher_id');
    	$stream_id                = $request->input('stream_id');
      $period                   = $request->input('period');
      $year                     = $request->input('year');
      $from_user                = Auth::user()->id;

      $exam                     = Exam::whereId($id)->update([
        'name'                => $name,
        'subject_id'          => $subject_id,
        'teacher_id'          => $teacher_id,
        'stream_id'           => $stream_id,
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
    	$exam = Exam::whereId($id)->first();

    	$exam->delete();

    	$message = 'Exam deleted successfully.';

    	return redirect('exams')->with('success', $message);
    }
}
