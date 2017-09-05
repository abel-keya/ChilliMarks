<?php

namespace chillimarks\Http\Controllers\Core\Groups;

use Illuminate\Http\Request;
use chillimarks\Http\Controllers\Controller;
use chillimarks\Models\Group;
use chillimarks\Models\User;

class ManageGroupsController extends Controller
{   
    
    public function index()
    {
        $page = 'Manage Groups';

        return view('core.groups.manage.index', compact('page'));
    }

    public function groups()
    {
        $page = 'Manage Groups';

        return view('core.groups.manage.manage-many', compact('page'));
    }

    public function selectAttachGroup($id)
    {
    	$page = 'Assign Group';

    	$groups = Group::get();

        $user = User::whereId($id)->first();

        if($user->hasRole('student'))
        {
            $back_url = 'view-student';
        } else {
            $back_url = 'view-teacher';
        }
        
        return view('core.groups.manage.assign', compact('page', 'groups', 'id', 'back_url'));
    }

    public function assignGroup(Request $request, $id)
    {   
        $this->validate($request, [
          'group'              => 'required'
        ]);

    	$group   = $request->input('group');

    	$group      = Group::whereId($group)->first();

    	$user       = User::whereId($id)->first();

        if($user->hasRole('student'))
        {
            $return_url = 'view-student';
        } else {
            $return_url = 'view-teacher';
        }

        if(!$user->hasGroup($group->name))
        {
            $user->assignGroup($group);

            $message = 'Group assigned successfully!';

        } else {

            $message = 'Sorry, that group is already assigned!';

        }

	   	$user_id = $user->id;
        
        return redirect()->route($return_url, compact('user_id'))->with('success', $message);
    }

    public function selectDetachGroup($id)
    {
    	$page = 'Detach Group';

    	$groups = Group::get();

    	$user = User::whereId($id)->first();

        if($user->hasRole('student'))
        {
            $back_url = 'view-student';
        } else {
            $back_url = 'view-teacher';
        }

        return view('core.groups.manage.detach', compact('page', 'groups', 'id', 'user', 'back_url'));
    }

    public function detachGroup(Request $request, $id)
    {   
        $this->validate($request, [
          'group'              => 'required'
        ]);

    	$group   = $request->input('group');

    	$group      = Group::whereId($group)->first();

    	$user       = User::whereId($id)->first();

	   	$user->removeGroup($group);
	   	
	   	$message = 'Group detached successfully!';

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
        $page = 'Assign Group';

        $groups = Group::get();

        return view('core.groups.manage.assign-many', compact('page', 'groups'));
    }

    public function postassignmany(Request $request)
    {
        $this->validate($request, [
                'assigngroup'        => 'required',
                'wheregroup'         => 'required'
        ]);

        $group          = $request->input('group');

        $assigngroup    = $request->input('assigngroup');
        $wheregroup     = $request->input('wheregroup');

        $assigngroup   = Group::whereId($assigngroup)->first();

        if($wheregroup  == 0)
        {
            $groups = Group::get();

            $users          = User::whereHas(
                                'roles', function($q){
                                    $q->where('name', 'student');
                                }
                            )->doesntHave('groups')->get();

            foreach ($users as $user) {
                $user->assignGroup($assigngroup); 
            }

        } else {

            $users               = User::whereHas(
                            'roles', function($q){
                                $q->where('name', 'student');
                            }
                        )->WhereHas(
                            'groups', function($q) use ($wheregroup){
                                $q->where('group_id', $wheregroup);
                            }
                        )->get();

            foreach ($users as $user) {
                $user->assignGroup($assigngroup); 
            }
        }   

        $message = 'Group assigned successfully!';

        return redirect('manage-groups')->with('success', $message);
    }

    public function detachmany()
    {
        $page = 'Detach Group';

        $groups = Group::get();

        return view('core.groups.manage.detach-many', compact('page', 'groups'));
    }

    public function postdetachmany(Request $request)
    {
        $this->validate($request, [
                'detachgroup'        => 'required',
                'wheregroup'         => 'required'
        ]);

        $detachgroup         = $request->input('detachgroup');
        $wheregroup          = $request->input('wheregroup');

        $users               = User::whereHas(
                          'roles', function($q){
                                $q->where('name', 'student');
                            }
                        )->WhereHas(
                            'groups', function($q) use ($wheregroup){
                                $q->where('group_id', $wheregroup);
                            }
                        )->get();

        $detachgroup         = Group::whereId($detachgroup)->first();

        foreach ($users as $user) {
            $user->removeGroup($detachgroup); 
        }

        $message = 'Group detached successfully!';

        return redirect('manage-groups')->with('success', $message);
    }
}
