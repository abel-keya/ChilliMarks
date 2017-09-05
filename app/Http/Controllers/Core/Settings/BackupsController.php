<?php

namespace chillimarks\Http\Controllers\Core\Settings;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use Backup;
use File;

class BackupsController extends Controller
{
    public function index(Request $request)
    {	
        $page = 'Backup Settings';

        $pages = (int) $request->input('page') ?: 1;

        $files = collect(File::allFiles("../storage/app/public"));

        $onPage = 50;

        $slice = $files->slice(($pages-1)* $onPage, $onPage);

         $paginator = new \Illuminate\Pagination\LengthAwarePaginator($slice, $files->count(), $onPage);

    	return view('core.settings.backups.index', compact('page', 'files', $paginator));
    }

    public function create()
    {		
    	Backup::export();

    	$message = 'Backup successfully created!';

    	return redirect()->back()->with('success', $message);
    }

    public function restore(Request $request)
    {	
    	$this->validate($request, [
	    	'name'      => 'required',
	    ]);

    	$name = $request->input('name');
    	
    	Backup::restore($name);

    	$message = 'Backup successfully restored!';

    	return redirect()->back()->with('success', $message);
    }


    public function delete(Request $request)
    {	
    	$this->validate($request, [
	    	'name'      => 'required',
	    ]);

    	$name = $request->input('name');

    	File::delete($name);

    	$message = 'Backup successfully deleted!';

    	return redirect()->back()->with('success', $message);
    }
}
