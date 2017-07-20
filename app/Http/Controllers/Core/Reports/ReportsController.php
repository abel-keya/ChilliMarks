<?php

namespace chilliapp\Http\Controllers\Core\Reports;

use Illuminate\Http\Request;
use chilliapp\Http\Controllers\Controller;
use chilliapp\Models\Classes;
use Auth;

class ReportsController extends Controller
{   
    /*  Only authenticated users can access all functions.
    |--------------------------------------------------------------------------| */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()	
    {	
    	$page = 'Reports';

    	return view('core.reports.index', compact('page'));
    }

    public function students()
    {
    	$page = 'Students Reports';

    	return view('core.reports.students', compact('page'));
    }

    public function poststudents(Request $request)
    {
        $this->validate($request, [
          ''          => 'required|min:1',
        ]);

        $name                 = $request->input('');
        $from_user            = Auth::user()->id;



    }

    public function classes()
    {
    	$page = 'Classes Reports';

    	$classes = Classes::get();

    	return view('core.reports.classes', compact('page', 'classes'));
    }

    public function postclasses(Request $request)
    {
        $this->validate($request, [
          ''          => 'required|min:1',
        ]);

        $name                 = $request->input('');
        $from_user            = Auth::user()->id;




    }

}
