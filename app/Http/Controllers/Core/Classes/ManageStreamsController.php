<?php

namespace chilliapp\Http\Controllers\Core\Classes;

use Illuminate\Http\Request;
use chilliapp\Http\Controllers\Controller;

class ManageStreamsController extends Controller
{
    
    /*  Only authenticated users can access all functions.
    |--------------------------------------------------------------------------| */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $page = 'Classes Settings';

        return view('core.classes.manage.index', compact('page'));
    }

    public function streams()
    {
        $page = 'Manage Streams';

        return view('core.classes.manage.manage-many', compact('page'));
    }

}
