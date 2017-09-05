<?php

namespace chillimarks\Http\Controllers\Core\Classes;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;

class ManageStreamsController extends Controller
{
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
