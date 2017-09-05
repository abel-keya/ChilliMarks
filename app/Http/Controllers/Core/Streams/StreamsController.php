<?php

namespace chillimarks\Http\Controllers\Core\Streams;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use chillimarks\Models\Stream;
use chillimarks\Models\Classes;
use chillimarks\Models\User;
use Auth;

class StreamsController extends Controller
{   
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
          'name'              => 'required|min:1',
          'abbr'              => 'required|min:1'
        ]);

    	$name                 = $request->input('name');
        $abbr                 = $request->input('abbr');
        $from_user            = Auth::user()->id;
        
    	$stream = Stream::create([
    		'name'            => $name,
            'abbr'            => $abbr,
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
          'name'              => 'required|min:1',
          'abbr'              => 'required|min:1'
        ]);

        $name                 = $request->input('name');
        $abbr                 = $request->input('abbr');
        $from_user            = Auth::user()->id;

    	$stream = Stream::whereId($id)->first();
        
        $stream->update([
    		'name'            => $name,
            'abbr'            => $abbr,
            'from_user'       => $from_user
    	]);

    	$message = 'Stream updated successfully.';

    	return redirect()->route('view-class', [$stream->class_id])->with('success', $message);
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

        $stream_name = $stream->name;

        $class_id = $stream->class_id;

        $users = User::whereHas(
            'streams', function($q) use($stream_name){
                $q->where('name', $stream_name);
            }
        )->get();

        foreach($users as $user)
        {
            if($user->hasStream($stream->name))
            {
                $user->removeStream($stream);
            }
        }

    	$stream->delete();

    	$message = 'Stream deleted and detached from users successfully.';

        return redirect()->route('view-class', [$class_id])->with('success', $message);
    }
}
