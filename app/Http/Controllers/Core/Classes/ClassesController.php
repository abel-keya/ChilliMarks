<?php

namespace chilliapp\Http\Controllers\Core\Classes;

use Illuminate\Http\Request;
use chilliapp\Http\Controllers\Controller;
use chilliapp\Models\Classes;
use Auth;

class ClassesController extends Controller
{
    public function index()
    {
    	$page = 'Classes';

    	$classes = Classes::get();

    	return view('core.classes.index', compact('page', 'classes'));
    }

    public function search(Request $request)
    {
        $this->validate($request, [
          'search'              => 'required|min:1'
        ],
        [
          'search.required'     => 'You need to search a class.',
        ]);

        $query                  = $request->input('search');


        $classes = Classes::where('name', 'LIKE', '%' . $query . '%')
            ->orwhere('year', 'LIKE', '%' . $query . '%')
            ->get();

        if(count($classes)==1)
        {
            $tense              = 'is';
            $result             = 'result.';
        }
        else
        {
            $tense              = 'are';
            $result             = 'results.';
        }

        $message                = 'There '. $tense . ' ' . count($classes) . ' class '. $result;

        $page                   = 'Classes';

        return view('core.classes.index', compact('page', 'classes'));
    }

    public function view($id)
    {
    	$page = 'View Class';

    	$class = Classes::whereId($id)->first();

    	return view('core.classes.view', compact('page', 'class'));
    }

    public function create(Request $request)
    {
    	$this->validate($request, [
          'name'              => 'required|min:1',
          'year'              => 'required|min:1'
        ]);

    	$name                 = $request->input('name');
    	$year                 = $request->input('year');
        $from_user            = Auth::user()->id;
        
    	$class = Classes::create([
    		'name'            => $name,
    		'year'            => $year,
            'from_user'       => $from_user
    	]);

    	$message = 'Class created successfully.';

    	return redirect()->route('classes')->with('success', $message);
    }

    public function edit($id)
    {
    	$page = 'Edit Class';

    	$class = Classes::whereId($id)->first();

    	return view('core.classes.edit', compact('page', 'class'));
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

    	$class = Classes::whereId($id)->update([
    		'name'            => $name,
    		'year'            => $year,
            'from_user'       => $from_user
    	]);

    	$message = 'Class updated successfully.';

    	return redirect()->route('view-class', [$id])->with('success', $message);
    }

    public function confirm ($id)
    {
    	$page = 'Confirm Delete';

    	$class = Classes::whereId($id)->first();

    	return view('core.classes.delete', compact('page', 'class'));
    }

    public function delete($id)
    {
    	$class = Classes::whereId($id)->first();

    	$class->delete();

    	$message = 'Class deleted successfully.';

    	return redirect()->route('classes')->with('success', $message);
    }

}
