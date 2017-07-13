<?php

namespace chilliapp\Http\Controllers\Core\Messaging;

use Illuminate\Http\Request;
use chilliapp\Http\Controllers\Controller;
use chilliapp\Models\Classes;
use chilliapp\Models\Exam;
use chilliapp\Models\Message;

class MessagingController extends Controller
{
    public function index()
    {
    	$page = 'Messaging';

    	return view('core.messaging.index', compact('page'));
    }

    public function academic()
    {
    	$page    = 'Academic Messaging';

    	$classes = Classes::get();

    	$exams   = Exam::get();

    	return view('core.messaging.academic', compact('page', 'classes', 'exams'));
    }

    public function past()
    {
        $page    = 'Past Messages';

        $messages = Message::get();

        return view('core.messaging.messages', compact('page', 'messages'));
    }

    public function search(Request $request)
    {
        $this->validate($request, [
          'search'              => 'required|min:1'
        ],
        [
          'search.required'     => 'You need to search an message.',
        ]);

        $query                  = $request->input('search');


        $messages = Message::where('name', 'LIKE', '%' . $query . '%')->get();

        if(count($messages)==1)
        {
            $tense              = 'is';
            $result             = 'result.';
        }
        else
        {
            $tense              = 'are';
            $result             = 'results.';
        }

        $message                = 'There '. $tense . ' ' . count($messages) . ' message '. $result;

        $page                   = 'Messaging';

        return view('core.messaging.messages', compact('page', 'messages'));
    }

    public function view($id)
    {
        $page    = 'Message';

        $message = Message::whereId($id)->first();

        return view('core.messaging.view', compact('page', 'message'));
    }

    public function send(Request $request)
    {	
    	$this->validate($request, [
          'class_id'          => 'required|min:1',
          'term'              => 'required|min:1',
          'year'              => 'required|min:1',
        ]);

    	$name                 = $request->input('name');
    	$year                 = $request->input('year');
        $from_user            = Auth::user()->id;
        
    	//....Sending academic message code goes here

        $description = $name .' '. $year;

        Message::create([
            'name'      => $decription
        ]);

    	$message = 'Academic messages sent successfully!';

    	return redirect()->route('classes')->with('success', $message);
    }
}
