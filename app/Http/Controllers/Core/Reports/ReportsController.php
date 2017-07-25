<?php

namespace chilliapp\Http\Controllers\Core\Reports;

use Illuminate\Http\Request;
use chilliapp\Http\Controllers\Controller;
use chilliapp\Models\Classes;
use chilliapp\Models\Stream;
use chilliapp\Models\Group;
use Auth;

class ReportsController extends Controller
{   
    public function index()	
    {	
    	$page = 'Reports';

    	return view('core.reports.index', compact('page'));
    }

    public function reportforms()
    {
    	$page = 'Report Forms';

        $streams = Stream::get();

    	return view('core.reports.report-forms', compact('page', 'streams'));
    }

    public function postreportform(Request $request)
    {
        $this->validate($request, [
          'name'          => 'required',
          'stream_id'     => 'required',
          'period'        => 'required',
          'year'          => 'required'
        ]);

        $name                 = $request->input('name');
        $stream_id            = $request->input('stream_id');
        $period               = $request->input('period');
        $year                 = $request->input('year');
        $from_user            = Auth::user()->id;

    }

    public function streamreports()
    {
    	$page = 'Stream Report';

        $streams = Stream::get();

        return view('core.reports.streams', compact('page', 'streams'));
    }

    public function poststreamreport(Request $request)
    {
        $this->validate($request, [
          'name'          => 'required',
          'stream_id'     => 'required',
          'period'        => 'required',
          'year'          => 'required'
        ]);

        $name                 = $request->input('name');
        $stream_id            = $request->input('stream_id');
        $period               = $request->input('period');
        $year                 = $request->input('year');
        $from_user            = Auth::user()->id;
    }


    public function overallclassreports()
    {
        $page = 'Overall Class Reports';

        $classes = Classes::get();

        return view('core.reports.overall-class-reports', compact('page', 'classes'));
    }

    public function postoverallclassreport(Request $request)
    {
        $this->validate($request, [
          'name'          => 'required',
          'class_id'      => 'required',
          'period'        => 'required',
          'year'          => 'required'
        ]);

        $name                 = $request->input('name');
        $class_id             = $request->input('class_id');
        $period               = $request->input('period');
        $year                 = $request->input('year');
        $from_user            = Auth::user()->id;
    }

    public function groupreports()
    {
        $page = 'Group Reports';

        $groups = Group::get();

        return view('core.reports.group-reports', compact('page', 'groups'));
    }

    public function postgroupreports(Request $request)
    {
        
    }
}
