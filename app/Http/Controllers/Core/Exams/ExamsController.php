<?php

namespace chilliapp\Http\Controllers\Core\Exams;

use Illuminate\Http\Request;
use chilliapp\Http\Controllers\Controller;
use chilliapp\Models\Exam;

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
            ->orwhere('subject', 'LIKE', '%' . $query . '%')
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

    public function create(Request $request)
    {
    	$this->validate($request, [
          'name'                 => 'required|min:1',
          'subject'              => 'required',
          'teacher_id'           => 'required',
          'class_id'             => 'required',
          'period'               => 'required',
          'year'                 => 'required'
          ]);

    	$name                     = $request->input('name');
    	$subject                  = $request->input('subject');
    	$teacher_id               = $request->input('teacher_id');
    	$class_id                 = $request->input('class_id');
      $period                   = $request->input('period');
      $year                     = $request->input('year');
      $from_user                = Auth::user()->id;

      $exam                     = Exam::create([
          'name'                => $name,
          'subject'             => $subject,
          'teacher_id'          => $teacher_id,
          'class_id'            => $class_id,
          'period'              => $period,
          'year'                => $year,
          'from_user'           => $from_user
          ]);

        $message = 'Exam created successfully.';

        return redirect()->route('exams')->with('success', $message);
    }

    public function edit($id)
    {
    	$page = 'Edit Exam';

    	$exam = Exam::whereId($id)->first();

    	return view('core.exams.edit', compact('page', 'exam'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, [
          'name'                 => 'required|min:1',
          'subject'              => 'required',
          'teacher_id'           => 'required',
          'class_id'             => 'required',
          ]);

    	$name                     = $request->input('name');
    	$subject                  = $request->input('subject');
    	$teacher_id               = $request->input('teacher_id');
    	$class_id                 = $request->input('class_id');
        $period                   = $request->input('period');
        $year                     = $request->input('year');
        $from_user                = Auth::user()->id;

        $exam                     = Exam::whereId($id)->update([
          'name'                => $name,
          'subject'             => $subject,
          'teacher_id'          => $teacher_id,
          'class_id'            => $class_id,
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

    	return redirect()->route('exams')->with('success', $message);
    }
}
