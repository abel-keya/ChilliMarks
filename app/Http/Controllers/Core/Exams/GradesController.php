<?php

namespace chilliapp\Http\Controllers\Core\Exams;

use Illuminate\Http\Request;
use chilliapp\Http\Controllers\Controller;
use chilliapp\Models\Grade;
use chilliapp\Models\Exam;

class GradesController extends Controller
{
    public function view($id)
    {
    	$page = 'View Grades';

    	$grades = Grade::whereExamId($id)->get();

    	$exam = Exam::whereId($id)->first();

    	return view('core.grades.core.view', compact('page', 'grades', 'exam'));
    }

    public function grades($id)
    {
    	$page = 'Submit Grades';

    	$grades = Grade::whereExamId($id)->get();

    	$exam = Exam::whereId($id)->first();

    	return view('teachers.exams.grades', compact('page', 'grades', 'exam'));
    }		

    public function postgrades(Request $request, $id)
    {	
    	$this->validate($request, [
          'grades.*'              => 'required|numeric|max:100|min:0'
        ]);

    	$grades       = Grade::where('exam_id', $id)->get();

        $grades_1st   = Grade::where('exam_id', $id)->first();

        $grades_1st   = $grades_1st->id;

        $input = $request->all();

        for($i=0;$i<$grades->count(); $i++) {

            $grade    = Grade::whereId($grades_1st+$i);

            $grade->update(['grade' => $request->grades[$i], 'status' => 1]);            
        }

        $exam = Exam::whereId($id)->update(['status' => 1]);

        return redirect()->back()->with('success', 'Grades updated successfully.');
    }

}
