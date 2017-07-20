<?php

namespace chilliapp\Http\Controllers\Core\Teachers;

use Illuminate\Http\Request;
use chilliapp\Http\Controllers\Controller;
use chilliapp\Models\User;
use chilliapp\Models\Role;
use Auth;

class TeachersController extends Controller
{   
    /*  Only authenticated users can access all functions.
    |--------------------------------------------------------------------------| */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	$page = 'Teachers';

        $teachers = User::whereHas(
            'roles', function($q){
                $q->where('name', 'teacher');
            }
        )->get();

    	return view('core.teachers.index', compact('page', 'teachers'));
    }

    public function search(Request $request)
    {
        $this->validate($request, [
          'search'              => 'required|min:1'
        ],
        [
          'search.required'     => 'You need to search a teacher.',
        ]);

        $query                  = $request->input('search');


        $teachers = Teacher::where('name', 'LIKE', '%' . $query . '%')
            ->orwhere('year', 'LIKE', '%' . $query . '%')
            ->orwhere('phone', 'LIKE', '%' . $query . '%')
            ->get();

        if(count($teachers)==1)
        {
            $tense              = 'is';
            $result             = 'result.';
        }
        else
        {
            $tense              = 'are';
            $result             = 'results.';
        }

        $message                = 'There '. $tense . ' ' . count($teachers) . ' teacher '. $result;

        $page                   = 'Teachers';

        return view('core.teachers.index', compact('page', 'teachers'));
    }

    public function view($id)
    {
    	$page = 'View Teacher';

    	$teacher = User::whereId($id)->first();

    	return view('core.teachers.view', compact('page', 'teacher'));
    }

    public function create()
    {
        $page = 'Create Teacher';

        return view('core.teachers.create', compact('page'));
    }

    public function postcreate(Request $request)
    {
    	$this->validate($request, [
          'name'              => 'required|min:2',
          'year'              => 'required',
          'phone'             => 'required|min:10',
        ]);

    	$name                 = $request->input('name');
        $year                 = $request->input('year');
    	$phone                = $request->input('phone');
        $password             = 'password';
        $from_user            = Auth::user()->id;

    	$teacher = User::create([
    		'name'            => $name,
            'year'            => $year,
    		'phone'           => $phone,
            'password'        => bcrypt($password),
            'from_user'       => $from_user
    	]);

        $teacherRole          = Role::whereName('teacher')->first();
        $teacher->assignRole($teacherRole);

        $defaultpassword      = $request->input('defaultpassword');
        
        if($defaultpassword != 1)
        {
            $this->validate($request, [
              'password'         => 'required|min:8|max:256',
              'password_confirm' => 'required|min:8|max:256|same:password'
            ]);

            $password            = $request->input('password');

            $teacher = User::whereId($teacher->id)->update([
                'password'       => bcrypt($password),
                'from_user'      => $from_user
            ]);
        } 

    	$message = 'Teacher created successfully.';

    	return redirect('teachers')->with('success', $message);
    }

    public function edit($id)
    {
    	$page = 'Edit Teacher';

    	$teacher = User::whereId($id)->first();

        $years = ['2014', 
                  '2015', 
                  '2016', 
                  '2017', 
                  '2018', 
                  '2019', 
                  '2020', 
                  '2021', 
                  '2022', 
                  '2023', 
                  '2024', 
                  '2025'];

        foreach ($years as $year) {
            if($year==$teacher->year)
            {
                $teacher_year = $teacher->year;
            }
        }

    	return view('core.teachers.edit', compact('page', 'teacher', 'years', 'teacher_year'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
          'name'                  => 'required|min:1',
          'year'                  => 'required',
          'phone'                 => 'required|min:10'
        ]);

        $name                     = $request->input('name');
        $year                     = $request->input('year');
        $phone                    = $request->input('phone');
        $from_user                = Auth::user()->id;

        $teacher = User::whereId($id)->update([
            'name'                => $name,
            'year'                => $year,
            'phone'               => $phone,
            'from_user'           => $from_user
        ]);

        $oldpassword              = $request->input('oldpassword');

        if($oldpassword != 1)
        {
            $this->validate($request, [
              'password'          => 'required|min:8|max:256',
              'password_confirm'  => 'required|min:8|max:256|same:password'
            ]);

            $password             = $request->input('password');
            $from_user            = Auth::user()->id;

            $teacher = User::whereId($id)->update([
                'password'        => bcrypt($password),
                'from_user'       => $from_user
            ]);
        } 

    	$message = 'Teacher updated successfully.';

    	return redirect()->route('view-teacher', [$id])->with('success', $message);
    }

    public function confirm($id)
    {
    	$page = 'Confirm Delete';

    	$teacher = User::whereId($id)->first();

    	return view('core.teachers.delete', compact('page', 'teacher'));
    }

    public function delete($id)
    {
    	$teacher = User::whereId($id)->first();

    	$teacher->delete();

    	$message = 'Teacher deleted successfully.';

    	return redirect('teachers')->with('success', $message);
    }
}
