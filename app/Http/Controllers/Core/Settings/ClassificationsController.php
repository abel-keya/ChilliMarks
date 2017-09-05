<?php

namespace chillimarks\Http\Controllers\Core\Settings;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use chillimarks\Models\Classification;

class ClassificationsController extends Controller
{
    public function index()
    {	
    	$page = 'Classifications';

		  $classifications = Classification::get();

    	return view('core.settings.classifications.index', compact('page', 'classifications'));
    }

    public function create()
    {
    	$page = 'Create Classification';

    	return view('core.settings.classifications.create', compact('page'));
    }

    public function postcreate(Request $request)
  	{
  		$this->validate($request, [
                'grade'             => 'required',
                'start'             => 'required|numeric',
                'end'               => 'required|numeric'
        ]);

        $grade       		= $request->input('grade');

        $start       		= $request->input('start');

        $end         		= $request->input('end');

        $from_user  		= $request->user()->id;

        $classifications = Classification::create(array(
            'grade'   			 =>  $grade,
            'start'              =>  $start,
            'end'                =>  $end,
            'from_user'          =>  $from_user 
        ));

        $message = 'Classification successfully added!';

        return redirect('classifications')->with('info', $message);
  	}

    public function view($id)
    {
      $page = 'View Classification';

      $classification = Classification::whereId($id)->first();

      return view('core.settings.classifications.view', compact('page', 'classification'));
    }

  	public function edit($id)
  	{
  		$page = 'Edit Classification';

      $classification = Classification::whereId($id)->first();

    	return view('core.settings.classifications.edit', compact('page', 'classification'));
  	}

  	public function update(Request $request, $id)
  	{
  		$this->validate($request, [
                'grade'             => 'required',
                'start'             => 'required|numeric',
                'end'               => 'required|numeric'
        ]);

        $classification  = Classification::whereId($id)->first();

        $input = $request->all();

        $classification->fill($input)->save();

        $message = 'Classification successfully updated!';

        return redirect('classifications')->with('info', $message);
  	}

  	public function confirm($id)
  	{
  		$page = 'Delete Classification';

      $classification = Classification::whereId($id)->first();

    	return view('core.settings.classifications.delete', compact('page', 'classification'));
  	}

  	public function postdelete($id)
  	{
  		$classification = Classification::find($id);

        $classification->delete();

        $message = 'Classification successfully deleted!';

        return redirect('classifications')->with('info', $message);
  	}
}
