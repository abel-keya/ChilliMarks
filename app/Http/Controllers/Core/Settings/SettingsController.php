<?php

namespace chilliapp\Http\Controllers\Core\Settings;

use Illuminate\Http\Request;
use chilliapp\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {	
        $page = 'Settings';

    	return view('core.settings.index', compact('page'));
    }

    public function about()
    {	
        $page = 'About ChilliApp';

    	return view('core.settings.about', compact('page'));
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
