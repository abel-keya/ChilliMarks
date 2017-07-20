<?php

namespace chilliapp\Http\Controllers\Core\Settings;

use Illuminate\Http\Request;
use chilliapp\Http\Controllers\Controller;

class SettingsController extends Controller
{   
    /*  Only authenticated users can access all functions.
    |--------------------------------------------------------------------------| */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {	
        $page = 'Settings';

    	return view('core.settings.index', compact('page'));
    }

    public function about()
    {	
        $page = 'About ChilliApp';

        $year = date("Y");

    	return view('core.settings.about', compact('page', 'year'));
    }

    public function license()
    {	
        $page = 'ChilliApp License';

    	return view('core.settings.license', compact('page'));
    }

    public function classes()
    {   
        $page = 'Class Settings';

        return view('core.settings.classes', compact('page'));
    }

}
