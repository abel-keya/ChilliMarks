<?php

namespace chillimarks\Http\Controllers\Core\Groups;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use chillimarks\Models\Group;
use chillimarks\Models\User;
use Auth;

class GroupsController extends Controller
{   
    
    public function settings()
    {
        $page = 'Groups Settings';

        return view('core.groups.manage.index', compact('page'));
    }

    public function index()
    {
        $page = 'Groups';

        $groups = Group::get();

        return view('core.groups.core.index', compact('page', 'groups'));
    }

    public function search(Request $request)
    {
        $this->validate($request, [
          'search'              => 'required|min:1'
        ],
        [
          'search.required'     => 'You need to search a group.',
        ]);

        $query                  = $request->input('search');


        $groups = Group::where('name', 'LIKE', '%' . $query . '%')
            ->get();

        if(count($groups)==1)
        {
            $tense              = 'is';
            $result             = 'result.';
        }
        else
        {
            $tense              = 'are';
            $result             = 'results.';
        }

        $message                = 'There '. $tense . ' ' . count($groups) . ' group '. $result;

        $page                   = 'Groups';

        return view('core.groups.core.index', compact('page', 'groups'));
    }

    public function view($id)
    {
    	$page = 'View Group';

    	$group = Group::whereId($id)->first();

    	return view('core.groups.core.view', compact('page', 'group'));
    }

    public function create()
    {
        $page = 'Create Group';

        return view('core.groups.core.create', compact('page', 'id'));
    }

    public function postcreate(Request $request)
    {
    	$this->validate($request, [
          'name'              => 'required|min:1'
        ]);

    	$name                 = $request->input('name');
        $from_user            = Auth::user()->id;
        
    	$group = Group::create([
    		'name'            => $name,
            'from_user'       => $from_user
    	]);

    	$message = 'Group created successfully.';

    	return redirect('groups')->with('success', $message);
    }

    public function edit($id)
    {
    	$page = 'Edit Group';

    	$group = Group::whereId($id)->first();

    	return view('core.groups.core.edit', compact('page', 'group', 'id'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, [
          'name'              => 'required|min:1'
        ]);

        $name                 = $request->input('name');
        $from_user            = Auth::user()->id;

    	$group = Group::whereId($id)->update([
    		'name'            => $name,
            'from_user'       => $from_user
    	]);

    	$message = 'Group updated successfully.';

    	return redirect()->route('view-group', [$id])->with('success', $message);
    }

    public function confirm ($id)
    {
    	$page = 'Confirm Delete';

    	$group = Group::whereId($id)->first();

    	return view('core.groups.core.delete', compact('page', 'group'));
    }

    public function delete($id)
    {
    	$group = Group::whereId($id)->first();

        $group_name = $group->name;

        $users = User::whereHas(
            'groups', function($q) use($group_name){
                $q->where('name', $group_name);
            }
        )->get();

        foreach($users as $user)
        {
            if($user->hasGroup($group->name))
            {
                $user->removeGroup($group);
            }
        }

    	$group->delete();

    	$message = 'Group deleted successfully.';

        return redirect('groups')->with('success', $message);
    }
}
