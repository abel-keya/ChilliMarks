<?php

namespace chillimarks\Http\Controllers\Core\Exams;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use chillimarks\Models\Grade;
use chillimarks\Models\Exam;
use chillimarks\Models\Assessment;
use chillimarks\Models\User;
use Auth;

class GradesController extends Controller
{
    public function view($id)
    {
    	$page = 'View Grades';

    	$grades = Grade::whereAssessmentId($id)->get();

    	$assessment = Assessment::whereId($id)->first();

    	return view('core.grades.core.view', compact('page', 'grades', 'assessment'));
    }

    public function grades($id)
    {
    	$page = 'Submit Grades';

    	$grades = Grade::whereAssessmentId($id)->get();

    	$assessment = Assessment::whereId($id)->first();

    	return view('teachers.exams.grades', compact('page', 'grades', 'assessment'));
    }		

    public function postgrades(Request $request, $id)
    {	
        $assessment = Assessment::whereId($id)->first();

        $out_of = $assessment->out_of;

        $this->validate($request, [
          'grades.*'              => 'required|numeric|max:'.$out_of.'|min:0'
        ]);

    	$grades       = Grade::where('assessment_id', $id)->get();

        $grades_1st   = Grade::where('assessment_id', $id)->first();

        $grades_1st   = $grades_1st->id;

        $input = $request->all();

        for($i=0;$i<$grades->count(); $i++) {

            $grade    = Grade::whereId($grades_1st+$i);

            $grade->update(['marks' => $request->grades[$i], 'status' => 1]);            
        }

        $assessment = Assessment::whereId($id)->update(['status' => 1]);

        return redirect()->back()->with('success', 'Grades updated successfully.');
    }

    public function createselect($id)
    {
        $page = 'Select Students';
        
        $assessment = Assessment::whereId($id)->first();

        $assessment_id = $assessment->id;

        $exam_id = $assessment->exam->id;

        $stream_id  = $assessment->exam->stream_id;

        $students          = User::WhereHas(
                            'streams', function($q) use ($stream_id){
                                $q->where('stream_id', $stream_id);
                            })->WhereDoesntHave('grades', function ($term) use($assessment_id) {
                                    $term->where('assessment_id','=', $assessment_id);
                                })->get();

        return view('core.grades.core.create-select', compact('page', 'assessment', 'students'));
    }

    public function postcreateselect(Request $request, $id)
    {   
        $students  = $request->input('students', []);

        $from_user = Auth::user()->id;

        if($students)
        {   
            foreach ($students as $student) 
            {   
                    Grade::create([
                        'assessment_id'   => $id,
                        'student_id'      => $student,
                        'marks'           => 0,
                        'status'          => 0,
                        'from_user'       => $from_user
                    ]);
            }

            $message = 'Grades created successfully!';

        } else {
            
            $message = 'No grades created since none were selected!';
        }

        return redirect()->back()->with('success', $message);
    }

    public function edit($id)
    {
        $page = 'Edit Grade';

        $grade = Grade::whereId($id)->first();

        return view('core.grades.core.edit', compact('page', 'grade'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
          'marks'           => 'required|min:1'
        ]);

        $marks              = $request->input('marks');
        $from_user          = Auth::user()->id;

        $grade              = Grade::whereId($id)->update([
                'marks'                   => $marks,
                'from_user'               => $from_user
        ]);

        $assessment_id = Grade::whereId($id)->value('assessment_id');

        $message = 'Grade updated successfully!';

        return redirect()->route('view-assessment', compact('assessment_id'))->with('success', $message);
    }

    public function confirm ($id)
    {
        $page = 'Confirm Delete';

        $grade = Grade::whereId($id)->first();

        return view('core.grades.core.delete', compact('page', 'grade'));
    }

    public function delete($id)
    {
        $grade = Grade::whereId($id)->first();

        $assessment_id = $grade->assessment_id;

        $grade->delete();

        $message = 'Grade deleted successfully!';

        return redirect()->route('view-assessment', compact('assessment_id'))->with('success', $message);
    }

}
