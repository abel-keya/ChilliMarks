<?php

namespace chillimarks\Http\Controllers\Subjects;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use chillimarks\Models\Subject;

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
            ->orwhere('year', 'LIKE', '%' . $query . '%')
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
          'year'              => 'required|min:1'
        ]);

    	$name                 = $request->input('name');
    	$year                 = $request->input('year');
        $from_user            = Auth::user()->id;
        
    	$subject = Subject::create([
    		'name'            => $name,
    		'year'            => $year,
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
          'year'              => 'required|min:1'
        ]);

        $name                 = $request->input('name');
    	$year                 = $request->input('year');
        $from_user            = Auth::user()->id;

    	$subject = Subject::whereId($id)->update([
    		'name'            => $name,
    		'year'            => $year,
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

        $subject->delete();

    	$message = 'Subject deleted successfully.';

    	return redirect('subjects')->with('success', $message);
    }
}
