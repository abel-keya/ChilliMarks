<?php

namespace chillimarks\Http\Controllers\Teachers\Exams;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use chillimarks\Models\Assessment;
use Auth;

class ExamsController extends Controller
{
    public function index()
    {
    	$page   = 'My Assessments';

    	$user   = Auth::user()->id;

    	$assessments  = Assessment::where('teacher_id', $user)->get(); 

    	return view('teachers.exams.index', compact('page', 'assessments'));
    }
}
