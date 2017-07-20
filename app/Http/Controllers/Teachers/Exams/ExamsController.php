<?php

namespace chilliapp\Http\Controllers\Teachers\Exams;

use Illuminate\Http\Request;
use chilliapp\Http\Controllers\Controller;
use chilliapp\Models\Exam;
use Auth;

class ExamsController extends Controller
{
    public function index()
    {
    	$page   = 'My Exams';

    	$user   = Auth::user()->id;

    	$exams  = Exam::where('teacher_id', $user)->get();

    	return view('teachers.exams.index', compact('page', 'exams'));
    }
}
