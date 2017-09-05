<?php

namespace chillimarks\Http\Controllers\Core\School;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use chillimarks\Models\School;

class SchoolController extends Controller
{ 
    public function index()
    {   
        $page = 'School Settings';

        $school = School::first();

        return view('core.settings.school', compact('page', 'school'));
    }

    public function update(Request $request)
    {
    	$this->validate($request, [
            'name'              => 'required',
            'address'           => 'required', 
            'phone'             => 'required',
            'school_type'       => 'required',
        ]);

        $from_user = $request->user()->id;

        $school = School::first();

        if(!$school)
        {
            School::create([
                'name'        => $request->input('name'),
                'address'     => $request->input('address'),
                'phone'       => $request->input('phone'),
                'school_type' => $request->input('school_type'),
                'from_user'   => $from_user
            ]);

        } else {

            $school_id = $request->input('school_id');

            School::whereId($school_id)->update([
                'from_user'       => $from_user
            ]);

            $school = School::where('id', $school_id)->first();
            $input = $request->all();
            $school->fill($input)->save();

        }

        return redirect()->back()->with('info', 'School has been updated successfully!');
    }
}
