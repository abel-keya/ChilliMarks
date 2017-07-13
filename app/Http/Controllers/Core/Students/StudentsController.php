<?php

namespace chilliapp\Http\Controllers\Core\Students;

use Illuminate\Http\Request;
use chilliapp\Http\Controllers\Controller;
use chilliapp\Models\User;
use chilliapp\Models\Admission;
use Auth;

class StudentsController extends Controller
{
    public function index()
    {
    	$page = 'Students';

        $students = User::whereHas(
            'roles', function($q){
                $q->where('name', 'student');
            }
        )->get();

    	return view('core.students.index', compact('page', 'students'));
    }

    public function search(Request $request)
    {
        $this->validate($request, [
          'search'              => 'required|min:1'
        ],
        [
          'search.required'     => 'You need to search a student.',
        ]);

        $query                  = $request->input('search');


        $students = Student::where('name', 'LIKE', '%' . $query . '%')
            ->orwhere('year', 'LIKE', '%' . $query . '%')
            ->orwhere('phone', 'LIKE', '%' . $query . '%')
            ->orWhereHas('admission', function ($term) use($query) {
                $term->where('adm_no','LIKE', '%' . $query . '%');
            })
            ->get();

        if(count($students)==1)
        {
            $tense              = 'is';
            $result             = 'result.';
        }
        else
        {
            $tense              = 'are';
            $result             = 'results.';
        }

        $message                = 'There '. $tense . ' ' . count($students) . ' student '. $result;

        $page                   = 'Students';

        return view('core.students.index', compact('page', 'students'));
    }

    public function view($id)
    {
    	$page = 'View Student';

    	$student = User::whereId($id)->first();

    	return view('core.students.view', compact('page', 'student'));
    }

    public function create(Request $request)
    {
    	$this->validate($request, [
          'adm_no'            => 'required|min:1|unique:admissions',
          'name'              => 'required|min:1',
          'year'              => 'required|min:1',
          'phone'             => 'required|min:10',
          'password'          => 'required|min:8|max:256',
          'password_confirm'  => 'required|min:8|max:256|same:password'
        ]);

    	$adm_no               = $request->input('adm_no');
    	$name                 = $request->input('name');
    	$year                 = $request->input('year');
        $phone                = $request->input('phone');
        $password             = $request->input('password');
        $from_user            = Auth::user()->id;

    	$student = User::create([
    		'name'            => $name,
    		'year'            => $year,
            'phone'           => $phone,
            'password'        => bcrypt($password),
            'from_user'       => $from_user
    	]);

        $studentRole          = Role::whereName('student')->first();
        $user->assignRole($studentRole);

        Admission::create([
                'user_id'        => $student->id,
                'adm_no'         => $adm_no,
                'from_user'      => $from_user
        ]);


    	$message = 'Student created successfully.';

    	return redirect()->route('students')->with('success', $message);
    }

    public function edit($id)
    {
    	$page = 'Edit Student';

    	$student = User::whereId($id)->first();

    	return view('core.students.edit', compact('page', 'student'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, [
          'adm_no'            => 'required|min:1|unique:admissions',
          'name'              => 'required|min:1',
          'year'              => 'required|min:1',
          'phone'             => 'required|min:10',
          'password'          => 'required|min:8|max:256',
          'password_confirm'  => 'required|min:8|max:256|same:password'
        ]);

        $adm_no               = $request->input('adm_no');
    	$name                 = $request->input('name');
    	$year                 = $request->input('year');
        $phone                = $request->input('phone');
        $password             = $request->input('password');
        $from_user            = Auth::user()->id;

    	$student = User::whereId($id)->update([
    		'name'            => $name,
            'year'            => $year,
            'phone'           => $phone,
            'password'        => bcrypt($password),
            'from_user'       => $from_user
    	]);

        Admission::whereId($id)->update([
                'adm_no'         => $adm_no,
                'from_user'      => $from_user
        ]);

    	$message = 'Student updated successfully.';

    	return redirect()->route('view-student', [$id])->with('success', $message);
    }

    public function confirm ($id)
    {
    	$page = 'Confirm Delete';

    	$student = User::whereId($id)->first();

    	return view('core.students.delete', compact('page', 'student'));
    }

    public function delete($id)
    {
    	$student = User::whereId($id)->first();

    	$student->delete();

    	$message = 'Student deleted successfully.';

    	return redirect()->route('students')->with('success', $message);
    }
}
