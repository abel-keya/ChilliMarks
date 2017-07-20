<?php

namespace chilliapp\Http\Controllers\Core\Streams;

use Illuminate\Http\Request;
use chilliapp\Http\Controllers\Controller;
use chilliapp\Models\Stream;
use chilliapp\Models\Classes;
use Auth;

class StreamsController extends Controller
{   
    /*  Only authenticated users can access all functions.
    |--------------------------------------------------------------------------| */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function view($id)
    {
    	$page = 'View Stream';

    	$stream = Stream::whereId($id)->first();

    	return view('core.streams.view', compact('page', 'stream'));
    }

    public function create($id)
    {
        $page = 'Create Stream';

        $classes = Classes::get();

        return view('core.streams.create', compact('page', 'classes', 'id'));
    }

    public function postcreate(Request $request, $id)
    {
    	$this->validate($request, [
          'name'              => 'required|min:1'
        ]);

    	$name                 = $request->input('name');
        $from_user            = Auth::user()->id;
        
    	$stream = Stream::create([
    		'name'            => $name,
    		'class_id'        => $id,
            'from_user'       => $from_user
    	]);

    	$message = 'Stream created successfully.';

    	return redirect()->route('view-class', [$stream->class_id])->with('success', $message);
    }

    public function edit($id)
    {
    	$page = 'Edit Stream';

    	$stream = Stream::whereId($id)->first();

    	$classes = Classes::get();

    	return view('core.streams.edit', compact('page', 'stream', 'classes', 'id'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, [
          'name'              => 'required|min:1'
        ]);

        $name                 = $request->input('name');
        $from_user            = Auth::user()->id;

    	$stream = Stream::whereId($id)->update([
    		'name'            => $name,
            'from_user'       => $from_user
    	]);

    	$message = 'Stream updated successfully.';

    	return redirect()->route('view-class', [$id])->with('success', $message);
    }

    public function confirm ($id)
    {
    	$page = 'Confirm Delete';

    	$stream = Stream::whereId($id)->first();

    	return view('core.streams.delete', compact('page', 'stream'));
    }

    public function delete($id)
    {
    	$stream = Stream::whereId($id)->first();

        $class_id = $stream->class_id;

    	$stream->delete();

    	$message = 'Stream deleted successfully.';

        return redirect()->route('view-class', [$class_id])->with('success', $message);
    }
}
