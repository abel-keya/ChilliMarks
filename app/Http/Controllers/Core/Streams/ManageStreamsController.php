<?php

namespace chilliapp\Http\Controllers\Core\Streams;

use Illuminate\Http\Request;
use chilliapp\Http\Controllers\Controller;
use chilliapp\Models\Stream;
use chilliapp\Models\User;
use chilliapp\Models\Group;

class ManageStreamsController extends Controller
{   
    /*  Only authenticated users can access all functions.
    |--------------------------------------------------------------------------| */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function selectAttachStream($id)
    {
    	$page = 'Assign Stream';

    	$streams = Stream::get();

        $user = User::whereId($id)->first();

        if($user->hasRole('student'))
        {
            $back_url = 'view-student';
        } else {
            $back_url = 'view-teacher';
        }
        
        return view('core.streams.manage.assign', compact('page', 'streams', 'id', 'back_url'));
    }

    public function assignStream(Request $request, $id)
    {	
    	$this->validate($request, [
          'stream'              => 'required'
        ]);

    	$stream   = $request->input('stream');

    	$stream      = Stream::whereId($stream)->first();

    	$user        = User::whereId($id)->first();

        if($user->hasRole('student'))
        {
            $return_url = 'view-student';
        } else {
            $return_url = 'view-teacher';
        }

        if(!$user->hasStream($stream->name))
        {
            $user->assignStream($stream);

            $message = 'Stream assigned successfully!';

        } else {

            $message = 'Sorry, that stream is already assigned!';

        }

	   	$user_id = $user->id;
        
        return redirect()->route($return_url, compact('user_id'))->with('success', $message);
    }

    public function selectDetachStream($id)
    {
    	$page = 'Detach Stream';

    	$streams = Stream::get();

    	$user = User::whereId($id)->first();

        if($user->hasRole('student'))
        {
            $back_url = 'view-student';
        } else {
            $back_url = 'view-teacher';
        }

        return view('core.streams.manage.detach', compact('page', 'streams', 'id', 'user', 'back_url'));
    }

    public function detachStream(Request $request, $id)
    {
    	$this->validate($request, [
          'stream'              => 'required'
        ]);

    	$stream  = $request->input('stream');

    	$stream     = Stream::whereId($stream)->first();

    	$user       = User::whereId($id)->first();

	   	$user->removeStream($stream);
	   	
	   	$message = 'Stream detached successfully!';

        if($user->hasRole('student'))
        {
            $return_url = 'view-student';
        } else {
            $return_url = 'view-teacher';
        }
        
        $user_id = $user->id;

        return redirect()->route($return_url, compact('user_id'))->with('success', $message);
    }

    public function assignmany()
    {
        $page = 'Assign Stream';

        $streams = Stream::get();

        return view('core.classes.manage.assign-many', compact('page', 'streams', 'groups'));
    }

    public function postassignmany(Request $request)
    {
        $this->validate($request, [
                'assignstream'        => 'required',
                'wherestream'         => 'required'
        ]);

        $stream       = $request->input('stream');

        $assignstream  = $request->input('assignstream');
        $wherestream   = $request->input('wherestream');

        $users               = User::whereHas(
                            'roles', function($q){
                                $q->where('name', 'student');
                            }
                        )->WhereHas(
                            'streams', function($q) use ($wherestream){
                                $q->where('stream_id', $wherestream);
                            }
                        )->get();

        $assignstream   = Stream::whereId($assignstream)->first();
        
        foreach ($users as $user) {
            $user->assignStream($assignstream); 
        }

        $message = 'Stream assigned successfully!';

        return redirect()->back()->with('success', $message);

    }

    public function detachmany()
    {
        $page = 'Detach Stream';

        $streams = Stream::get();

        return view('core.classes.manage.detach-many', compact('page', 'streams', 'groups'));
    }

    public function postdetachmany(Request $request)
    {
        $this->validate($request, [
                'detachstream'        => 'required',
                'wherestream'         => 'required'
        ]);

        $detachstream         = $request->input('detachstream');
        $wherestream          = $request->input('wherestream');

        $users               = User::whereHas(
                          'roles', function($q){
                                $q->where('name', 'student');
                            }
                        )->WhereHas(
                            'streams', function($q) use ($wherestream){
                                $q->where('stream_id', $wherestream);
                            }
                        )->get();

        $detachstream         = Stream::whereId($detachstream)->first();

        foreach ($users as $user) {
            $user->removeStream($detachstream); 
        }

        $message = 'Stream detached successfully!';

        return redirect()->back()->with('success', $message);
    }
}
