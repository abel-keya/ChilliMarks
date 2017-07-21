<?php

namespace chilliapp\Http\Controllers\Core\School;

use Illuminate\Http\Request;
use chilliapp\Http\Controllers\Controller;
use chilliapp\Models\School;

class SchoolController extends Controller
{ 
    public function index()
    {   
        $page = 'School';

        $school = School::first();

        return view('core.settings.school', compact('page', 'school'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, [
            'name'              => 'required',
            'address'           => 'required', 
            'phone'             => 'required'
        ]);

        $from_user = $request->user()->id;

        Schoool::whereId($id)->update([
            'from_user'       => $from_user
        ]);

        $school = School::where('id', $id)->first();
        $input = $request->all();
        $school->fill($input)->save();

        return redirect()->route('school')->with('info', 'School has been updated successfully.');
    }
}
