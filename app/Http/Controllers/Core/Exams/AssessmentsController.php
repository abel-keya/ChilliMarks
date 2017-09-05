<?php

namespace chillimarks\Http\Controllers\Core\Exams;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use chillimarks\Models\Assessment;
use chillimarks\Models\Exam;
use chillimarks\Models\Grade;
use chillimarks\Models\User;
use chillimarks\Models\School;
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

        $exam = Exam::whereId($id)->first();

        $subject_code = $exam->subject->code;

        $school     = School::first();

        //Populate select element named code
        if($subject_code =='Maths')
        {
            $codes = ['Mathematics'];
            $selected = 1;

        } elseif($subject_code =='Eng')
        {
            $codes = ['English', 'Composition'];

        } elseif($subject_code == 'Kiswa')
        {
            $codes = ['Kiswahili', 'Insha'];

        } elseif($subject_code == 'Scie')
        {
            $codes = ['Science'];
            $selected = 1;

        } elseif ($subject_code == 'S.S')
        {
            $codes = ['Social Studies', 'C.R.E', 'I.R.E', 'H.R.E'];
        }


        $teachers = User::whereHas(
            'roles', function($q){
                $q->where('name', 'teacher');
            }
        )->whereHas(
            'subjects', function($q) use($subject_code){
                $q->where('code', $subject_code);
            }
        )->get();


        return view('core.assessments.create', compact('page', 'id', 'teachers', 'codes', 'selected', 'school'));
    }

    public function postcreate(Request $request,$id)
    {
    	$this->validate($request, [
          'assessment_name'           => 'required|min:1',
          'teacher_id'                => 'required',
          'grades'                    => 'required'
        ]);

    	$assessment_name              = $request->input('assessment_name');

        $exam                         = Exam::whereId($id)->first();

        $school                       = School::first();

        //use pre calculated figures of kenyan primary schools to determine worth assessments
        if($school->school_type=='kenyan_primary')
        {
            switch ($exam->subject->code)
            {
                case 'Maths':

                    switch ($assessment_name) {
                        case 'Mathematics':
                            $out_of        = '50';
                            $contribution  = '100';
                            break;
                    }

                case 'Eng':

                    switch ($assessment_name) {
                        case 'English':
                            $out_of = '50';
                            $contribution = '55.55555';
                            break;

                        case 'Composition':
                            $out_of = '50';
                            $contribution = '44.44444';
                            break;
                    }

                case 'Kiswa':

                    switch ($assessment_name) {
                        case 'Kiswahili':
                            $out_of = '50';
                            $contribution = '55.55555';
                            break;

                        case 'Insha':
                            $out_of = '50';
                            $contribution = '44.44444';
                            break;
                    }

                case 'scie':

                    switch ($assessment_name) {
                        case 'Science':
                            $out_of        = '50';
                            $contribution  = '100';
                            break;
                    }
                
                case 'S.S':

                    switch ($assessment_name) {

                        case 'Social Studies':
                            $out_of = '60';
                            $contribution = '66.66666';
                            break;

                        case 'C.R.E':
                            $out_of = '30';
                            $contribution = '33.33333';
                            break;

                        case 'I.R.E':
                            $out_of = '30';
                            $contribution = '33.33333';
                            break;

                        case 'H.R.E':
                            $out_of = '30';
                            $contribution = '33.33333';
                            break;
                    }

                break;
            }

        } else {
            $this->validate($request, [
              'out_of'                    => 'required|numeric|min:1',
              'contribution'              => 'required|numeric|min:1|max:100',
            ]);

            $out_of                       = $request->input('out_of');
            $contribution                 = $request->input('contribution');
        }

        $teacher_id                   = $request->input('teacher_id');
        $grades                       = $request->input('grades');
        $from_user                    = Auth::user()->id;
        

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
            if($assessment_difference>=$contribution==True || $assessment_name =='I.R.E' || $assessment_name =='H.R.E' || $assessment_name =='C.R.E'){

                $assessment                   = Assessment::create([
                    'exam_id'                 => $id,
                    'name'                    => $assessment_name,
                    'teacher_id'              => $teacher_id,
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

        $teachers = User::whereHas(
            'roles', function($q){
                $q->where('name', 'teacher');
            }
        )->get();

        $school = School::first();

    	$assessment = Assessment::whereId($id)->first();

        $exam_id = $assessment->exam->id;

        $exam = Exam::whereId($assessment->exam_id)->first();

        $school     = School::first();

    	return view('core.assessments.edit', compact('page', 'assessment', 'teachers', 'school'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, [
          'teacher_id'                => 'required',
        ]);

        $assessment_name              = $request->input('assessment_name');
        $teacher_id                   = $request->input('teacher_id');
        $from_user                    = Auth::user()->id;

        $assessment                   = Assessment::whereId($id)->update([
                'teacher_id'              => $teacher_id,
                'from_user'               => $from_user
        ]);

        $school     = School::first();
        
        if(!$school->school_type=='kenyan_primary')
        {
            $this->validate($request, [
              'out_of'                    => 'required|numeric|min:1',
              'contribution'              => 'required|numeric|min:1|max:100'
            ]);

            $out_of                       = $request->input('out_of');
            $contribution                 = $request->input('contribution');

            $assessment                   = Assessment::whereId($id)->update([
                'out_of'                  => $out_of,
                'contribution'            => $contribution,
                'from_user'               => $from_user
            ]);
        }

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
