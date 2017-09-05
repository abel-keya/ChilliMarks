<?php

namespace chillimarks\Http\Controllers\Core\Settings;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use chillimarks\Models\School;

class SettingsController extends Controller
{  
    public function index()
    {	
        $page = 'Settings';

        $school = School::first();

    	return view('core.settings.index', compact('page', 'school'));
    }

    public function about()
    {	
        $page = 'About ChilliMarks';

        $year = date("Y");

    	return view('core.settings.about', compact('page', 'year'));
    }

    public function license()
    {	
        $page = 'ChilliMarks License';

    	return view('core.settings.license', compact('page'));
    }

    public function classes()
    {   
        $page = 'Class Settings';

        return view('core.settings.classes', compact('page'));
    }

}
