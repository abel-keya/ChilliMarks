<?php

namespace chilliapp\Http\Controllers\Core\Exams;

use Illuminate\Http\Request;
use chilliapp\Http\Controllers\Controller;
use chilliapp\Models\Assessment;
use chilliapp\Models\Exam;
use chilliapp\Models\Grade;
use chilliapp\Models\user;
use Auth;

class AssessmentsController extends Controller
{	
	public function index()
    {
    	$page = 'Assessment';

    	$assessments = Assessment::get();

    	return view('core.assessments.index', compact('page', 'assessments'));
    }

    public function view($id)
    {
    	$page = 'View Assessment';

    	$assessment = Assessment::whereId($id)->first();

        $grades = Grade::whereAssessmentId($assessment->id)->get();

    	return view('core.assessments.view', compact('page', 'assessment', 'grades'));
    }

    public function create($id)
    {
        $page = 'Create Assessment';

        return view('core.assessments.create', compact('page', 'id'));
    }

    public function postcreate(Request $request,$id)
    {
    	$this->validate($request, [
          'assessment_name'           => 'required|min:1',
          'out_of'                    => 'required|min:1',
          'contribution'              => 'required|min:1',
          'grades'                    => 'required'
        ]);

    	$assessment_name              = $request->input('assessment_name');
    	$out_of                       = $request->input('out_of');
    	$contribution                 = $request->input('contribution');
        $grades                       = $request->input('grades');
        $from_user                    = Auth::user()->id;
        $exam                         = Exam::whereId($id)->first();

    	$stream_id                    = $exam->stream->id;



        $students                     = User::WhereHas(
                                       'streams', function($q) use ($stream_id){
                                       $q->where('stream_id', $stream_id);
                                       }
                                      )->get();

      	if($students->count()>0)
      	{	
            //Get assessments of same assessment and do contribution check
            $assessments_true             = Assessment::where('exam_id', $id)->get();

            if($assessments_true)
            {
                $assessment_sum           = Assessment::where('exam_id', $id)->sum('contribution');
            }

            $assessment_difference = 100 - $assessment_sum;


            //Contribution check if assessment total is more than 100%
            if($assessment_difference>=$contribution==True){

                $assessment                   = Assessment::create([
                    'exam_id'                 => $id,
                    'name'                    => $assessment_name,
                    'out_of'                  => $out_of,
                    'contribution'            => $contribution,
                    'status'                  => 0,
                    'from_user'               => $from_user
                ]);

                if($grades=='allstudents')
                {   

        	        foreach($students as $student)
        	        {
        		          $grade = Grade::create([
        		              'assessment_id'       => $assessment->id,
        		              'student_id'          => $student->id,
        		              'marks'               => 0,
        		              'status'              => 0,
        		              'from_user'           => $from_user
        		          ]);
        	        }

                    $redirect_url = 'view-exam';

                    $message = 'Assessment and grades created successfully!';

                } else {
                    
                    $message = 'Assessment created successfully!';

                    $redirect_url = 'create-select-grades';

                    $id           =  $assessment->id;

                }

            } else {

                $redirect_url = 'view-exam';

                $message = 'Sorry, Assessment not been created because total % of all assessments is more than 100%!';
            }


	        return redirect()->route($redirect_url, compact('id'))->with('success', $message);

	    } else {

	        $message = 'Sorry, Assessment & Grades were not created since there are no students in that stream!';

	        return redirect()->route('view-exam', compact('id'))->with('success', $message);
	    }
    }

    public function edit($id)
    {
    	$page = 'Edit Assessment';

    	$assessment = Assessment::whereId($id)->first();

    	return view('core.assessments.edit', compact('page', 'assessment'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, [
          'assessment_name'           => 'required|min:1',
          'out_of'                    => 'required|min:1',
          'contribution'              => 'required|min:1'
        ]);

        $assessment_name              = $request->input('assessment_name');
        $out_of                       = $request->input('out_of');
        $contribution                 = $request->input('contribution');
        $from_user                    = Auth::user()->id;

        $assessment                   = Assessment::whereId($id)->update([
                'name'                    => $assessment_name,
                'out_of'                  => $out_of,
                'contribution'            => $contribution,
                'status'                  => 0,
                'from_user'               => $from_user
        ]);

    	$message = 'Assessment updated successfully!';

    	return redirect()->route('view-assessment', [$id])->with('success', $message);
    }

    public function confirm ($id)
    {
    	$page = 'Confirm Delete';

    	$assessment = Assessment::whereId($id)->first();

    	return view('core.assessments.delete', compact('page', 'assessment'));
    }

    public function delete($id)
    {
    	$assessment = Assessment::whereId($id)->first();

        $exam_id = $assessment->exam_id;

        $assessment->delete();
        
        Grade::whereAssessmentId($id)->delete();

    	$message = 'Assessment and its associated grades deleted successfully!';

    	return redirect()->route('view-exam', $exam_id)->with('success', $message);
    }

}
