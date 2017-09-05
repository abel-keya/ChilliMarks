<?php

namespace chillimarks\Http\Controllers\Core\Students;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use chillimarks\Models\User;
use chillimarks\Models\Role;
use chillimarks\Models\Admission;
use chillimarks\Models\Group;
use chillimarks\Models\Stream;
use chillimarks\Models\School;
use chillimarks\Models\Kcpe;
use Auth;
use Excel;
use Illuminate\Support\Facades\Input;
use DB;

class StudentsController extends Controller
{   
    
    public function index()
    {
    	$page = 'Students';

        $students = User::whereHas(
            'roles', function($q){
                $q->where('name', 'student');
            }
        )->latest()->limit(100)->get();

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


        $students = User::where('name', 'LIKE', '%' . $query . '%')
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

        $school  = School::first();

    	return view('core.students.view', compact('page', 'student', 'school'));
    }

    public function create()
    {
        $page = 'Create Student';

        $school = School::first();

        return view('core.students.create', compact('page', 'school'));
    }

    public function postcreate(Request $request)
    {
        $this->validate($request, [
          'adm_no'            => 'required|min:1|unique:admissions',
          'name'              => 'required|min:1',
          'year'              => 'required|min:1',
          'phone'             => 'required|min:10'
        ]);

        $adm_no               = $request->input('adm_no');
        $name                 = $request->input('name');
        $phone                = $request->input('phone');
        $year                 = $request->input('year');
        $password             = 'password';
        $from_user            = Auth::user()->id;

        $student = User::create([
            'name'            => $name,
            'year'            => $year,
            'phone'           => $phone,
            'password'        => bcrypt($password),
            'from_user'       => $from_user
        ]);

        $studentRole             = Role::whereName('student')->first();
        $student->assignRole($studentRole);

        Admission::create([
                'user_id'        => $student->id,
                'adm_no'         => $adm_no,
                'from_user'      => $from_user
        ]);

        $defaultpassword      = $request->input('defaultpassword');

        if($defaultpassword != 1)
        {
            $this->validate($request, [
              'password'         => 'required|min:8|max:256',
              'password_confirm' => 'required|min:8|max:256|same:password'
            ]);

            $password            = $request->input('password');

            $student = User::whereId($student->id)->update([
                'password'       => bcrypt($password),
                'from_user'      => $from_user
            ]);
        }

        $school = School::where('school_type', 'kenyan_secondary')->first();

        if($school)
        {   
            $this->validate($request, [
              'kcpe_marks'           => 'required|min:1',
              'kcpe_position'        => 'required|min:1',
            ]);

            $kcpe_marks              = $request->input('kcpe_marks');
            $kcpe_position           = $request->input('kcpe_position');

            Kcpe::create([
                'student_id'     => $student->id,
                'marks'          => $kcpe_marks,
                'position'       => $kcpe_position,
                'from_user'      => $from_user
            ]);
            
        }

    	$message = 'Student created successfully.';

    	return redirect('students')->with('success', $message);
    }

    public function edit($id)
    {
    	$page = 'Edit Student';

    	$student = User::whereId($id)->first();

        $school = School::where('school_type', 'kenyan_secondary')->first();

    	return view('core.students.edit', compact('page', 'student', 'school'));
    }

    public function update(Request $request, $id)
    {   
        $this->validate($request, [
          'name'                  => 'required|min:1',
          'year'                  => 'required',
          'phone'                 => 'required|min:10'
        ]);

        $name                      = $request->input('name');
        $year                     = $request->input('year');
        $phone                    = $request->input('phone');
        $from_user                = Auth::user()->id;

        $student = User::whereId($id)->update([
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

            $student = User::whereId($id)->update([
                'password'        => bcrypt($password),
                'from_user'       => $from_user
            ]);
        }

        $school = School::where('school_type', 'kenyan_secondary')->first();

        if($school)
        {   
            $this->validate($request, [
              'kcpe_marks'           => 'required|min:1',
              'kcpe_position'        => 'required|min:1',
            ]);

            $kcpe_marks              = $request->input('kcpe_marks');
            $kcpe_position           = $request->input('kcpe_position');

            $kcpe = Kcpe::whereStudentId($id)->first();

            $kcpe->update([
                'marks'          => $kcpe_marks,
                'position'       => $kcpe_position,
                'from_user'      => $from_user
            ]);
            
        }


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

        $admission = Admission::whereUserId($student->id)->delete();

        $admission = Kcpe::whereStudentId($student->id)->delete();

    	$student->delete();

    	$message = 'Student deleted successfully.';

    	return redirect('students')->with('success', $message);
    }

    public function import()
    {
        $page = 'Import Students';

        return view('core.students.import', compact('page'));
    }

    public function importtemplate()
    {
        Excel::create('ChilliMarks Student Import Template', function($excel){

            $excel->sheet('sheet1', function($sheet){

                $sheet->setWidth(array(
                    'A'     =>  10,
                    'B'     =>  10,
                    'C'     =>  10,
                    'D'     =>  10,
                ));

                $sheet->cell('A1', function($cell) {
                    $cell->setValue('admissions_no');
                });

                $sheet->cell('B1', function($cell) {
                    $cell->setValue('name');
                });

                $sheet->cell('C1', function($cell) {
                    $cell->setValue('year');
                });

                $sheet->cell('D1', function($cell) {
                    $cell->setValue('phone');
                });

            });

        })->download('xlsx');
        
        return back()->with('success', 'Template generated successfully!');
    }

    public function postimport(Request $request)
    {   
        $this->validate($request, [
              'import'         => 'required|max:2000'
        ]);

        $mime = $request->file('import')->getClientMimeType();

        $mimetypes = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

        if($mime == $mimetypes[0] || $mime == $mimetypes[1])
        {
            $from_user            = Auth::user()->id;

            $default_password     = 'password';

            $studentRole          = Role::whereName('student')->first();

            $message              = array();

            $total_rows           = 0;

            $no_of_students       = 0;

            Excel::load(Input::file('import'), function ($reader) use ($default_password, $from_user, $studentRole, &$total_rows, &$no_of_students, &$message){

                $total_rows = count($reader->toArray());

                foreach ($reader->toArray() as $row) {

                    $name          = $row['name'];
                    $year          = $row['year'];
                    $phone         = $row['phone'];
                    $admissions_no = $row['admissions_no'];

                    if(strlen($name)>1 && strlen($year)>=4 && strlen($phone)>=10)
                    {
                        $student = User::create([
                            'name'            => $name,
                            'year'            => $year,
                            'phone'           => $phone,
                            'password'        => bcrypt($default_password),
                            'from_user'       => $from_user
                        ]);

                        $student->assignRole($studentRole);

                        Admission::create([
                                'user_id'        => $student->id,
                                'adm_no'         => $admissions_no,
                                'from_user'      => $from_user
                        ]);

                        $no_of_students = $no_of_students + 1;
                    }

                }


                $message[] = $no_of_students . ' out of ' . $total_rows . ' students uploaded successfully!';
                
            });

            return redirect('students')->with('success', $message[0]); 

        } else{
            $message = 'Sorry, Upload only .xls and .xlsx filetypes!';
                
            return back()->with('success', $message); 

        }

    }

    public function bulkactions()
    {
        $page = 'Students Bulk Actions';

        return view('core.students.bulk', compact('page'));
    }

    public function bulkdelete()
    {
        $page = 'Delete Many Students';

        return view('core.students.bulk-delete', compact('page'));
    }

    public function postbulkdelete(Request $request)
    {
        $this->validate($request, [
              'bulk'         => 'required'
        ]);

        $bulk                     = $request->input('bulk');

        if($bulk=='streams')
        {
            $streams = Stream::get();

            $users  = User::whereHas(
                            'roles', function($q){
                                $q->where('name', 'student');
                            }
                        )->doesntHave('streams')->get();

            $count_users = count($users);

            foreach($users as $user)
            {
                $user->delete();
            }

            $message = $count_users. ' students without streams deleted!';

        } elseif($bulk=='groups') {

            $groups = Group::get();

            $users  = User::whereHas(
                            'roles', function($q){
                                $q->where('name', 'student');
                            }
                        )->doesntHave('groups')->get();

            $count_users = count($users);

            foreach($users as $user)
            {
                $user->delete();
            }

            $message = $count_users. ' students without groups deleted!';

        } else {

            $message = 'No students have been deleted!';
        }

        return redirect('students')->with('success', $message);

    }

}

