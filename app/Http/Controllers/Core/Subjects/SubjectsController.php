<?php

namespace chillimarks\Http\Controllers\Core\Subjects;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use chillimarks\Models\Subject;
use chillimarks\Models\User;
use Auth;

class SubjectsController extends Controller
{
    public function index()
    {
    	$page = 'Subjects';

    	$subjects = Subject::get();

    	return view('core.subjects.core.index', compact('page', 'subjects'));
    }

    public function search(Request $request)
    {
        $this->validate($request, [
          'search'              => 'required|min:1'
        ],
        [
          'search.required'     => 'You need to search a subject.',
        ]);

        $query                  = $request->input('search');


        $subjects = Subject::where('name', 'LIKE', '%' . $query . '%')
            ->orwhere('code', 'LIKE', '%' . $query . '%')
            ->get();

        if(count($subjects)==1)
        {
            $tense              = 'is';
            $result             = 'result.';
        }
        else
        {
            $tense              = 'are';
            $result             = 'results.';
        }

        $message                = 'There '. $tense . ' ' . count($subjects) . ' subject '. $result;

        $page                   = 'Subject';

        return view('core.subjects.core.index', compact('page', 'subjects'));
    }

    public function view($id)
    {
    	$page = 'View Subject';

    	$subject = Subject::whereId($id)->first();

    	return view('core.subjects.core.view', compact('page', 'subject'));
    }

    public function create()
    {
        $page = 'Create Subject';

        return view('core.subjects.core.create', compact('page'));
    }

    public function postcreate(Request $request)
    {
    	$this->validate($request, [
          'name'              => 'required|min:1',
          'abbr'              => 'required|min:1',
          'code'              => 'required|min:1'
        ]);

    	$name                 = $request->input('name');
        $abbr                 = $request->input('abbr');
        $code                 = $request->input('code');
        $from_user            = Auth::user()->id;
        
    	$subject = Subject::create([
    		'name'            => $name,
            'abbr'            => $abbr,
            'code'            => $code,
            'from_user'       => $from_user
    	]);

    	$message = 'Subject created successfully.';

    	return redirect('subjects')->with('success', $message);
    }

    public function edit($id)
    {
    	$page = 'Edit Subject';

    	$subject = Subject::whereId($id)->first();

    	return view('core.subjects.core.edit', compact('page', 'subject'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, [
          'name'              => 'required|min:1',
          'abbr'              => 'required|min:1',
          'code'              => 'required|min:1'
        ]);

        $name                 = $request->input('name');
        $abbr                 = $request->input('abbr');
        $code                 = $request->input('code');
        $from_user            = Auth::user()->id;

    	$subject = Subject::whereId($id)->update([
    		'name'            => $name,
            'abbr'            => $abbr,
            'code'            => $code,
            'from_user'       => $from_user
    	]);

    	$message = 'Subject updated successfully.';

    	return redirect()->route('view-subject', [$id])->with('success', $message);
    }

    public function confirm ($id)
    {
    	$page = 'Confirm Delete';

    	$subject = Subject::whereId($id)->first();

    	return view('core.subjects.core.delete', compact('page', 'subject'));
    }

    public function delete($id)
    {
    	$subject = Subject::whereId($id)->first();

        $subject_name = $subject->name;

        $users = User::whereHas(
            'subjects', function($q) use($subject_name){
                $q->where('name', $subject_name);
            }
        )->get();

        foreach($users as $user)
        {
            if($user->hasSubject($subject->name))
            {
                $user->removeSubject($subject);
            }
        }

        $subject->delete();

    	$message = 'Subject deleted successfully.';

    	return redirect('subjects')->with('success', $message);
    }

    public function assign($id)
    {
        $page = 'Assign Subject';

        $subjects = Subject::get();

        $teacher = User::whereId($id)->first();

        return view('core.subjects.teachers.assign', compact('page', 'subjects', 'teacher'));
    }

    public function postassign(Request $request, $id)
    {
        $this->validate($request, [
          'subject'              => 'required'
        ]);

        $subject_id   = $request->input('subject');

        $subject      = Subject::whereId($subject_id)->first();

        $user         = User::whereId($id)->first();

        if(!$user->hasSubject($subject->name))
        {
            $user->assignSubject($subject);

            $message = 'Subject assigned successfully!';

        } else {

            $message = 'Sorry, that subject is already assigned!';
        }

        $user_id = $user->id;
        
        return redirect()->route('view-teacher', compact('user_id'))->with('success', $message);
    }

    public function detach($id)
    {
        $page = 'Detach Subject';

        $subjects = Subject::get();

        $teacher = User::whereId($id)->first();

        return view('core.subjects.teachers.detach', compact('page', 'subjects', 'teacher'));
    }

    public function postdetach(Request $request, $id)
    {
        $this->validate($request, [
          'subject'              => 'required'
        ]);

        $subject_id  = $request->input('subject');

        $subject     = Subject::whereId($subject_id)->first();

        $user        = User::whereId($id)->first();

        if($user->hasSubject($subject->name))
        {
            $user->removeSubject($subject);

            $message = 'Subject detached successfully!';

        } else {

            $message = 'Sorry, that subject is not assigned!';

        }
        
        $user_id = $user->id;

        return redirect()->route('view-teacher', compact('user_id'))->with('success', $message);
    }
}
