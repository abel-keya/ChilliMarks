<?php

namespace chillimarks\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use chillimarks\Models\Grade;
use chillimarks\Models\Assessment;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'year', 'phone', 'password', 'from_user'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function admission()
    {
        return $this->hasOne('chillimarks\Models\Admission');
    }

    public function kcpe()
    {
        return $this->hasOne('chillimarks\Models\Kcpe', 'student_id');
    }
    
    /*  Role User Relationship
    |--------------------------------------------------------------------------| */
    public function roles()
    {
        return $this->belongsToMany('chillimarks\Models\Role')->withTimestamps();
    }


    public function hasRole($name)
    {
        foreach($this->roles as $role)
        {
            if($role->name == $name) return true;
        }
        return false;
    }

    public function assignRole($role)
    {
        return $this->roles()->attach($role);
    }

    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }

    /*  Group User Relationship
    |--------------------------------------------------------------------------| */

    public function groups()
    {
        return $this->belongsToMany('chillimarks\Models\Group')->withTimestamps();
    }


    public function hasGroup($name)
    {
        foreach($this->groups as $group)
        {
            if($group->name == $name) return true;
        }
        return false;
    }

    public function assignGroup($group)
    {
        return $this->groups()->attach($group);
    }

    public function removeGroup($group)
    {
        return $this->groups()->detach($group);
    }

    /*  Stream User Relationship
    |--------------------------------------------------------------------------| */

    public function streams()
    {
        return $this->belongsToMany('chillimarks\Models\Stream')->withTimestamps();
    }


    public function hasStream($name)
    {
        foreach($this->streams as $stream)
        {
            if($stream->name == $name) return true;
        }
        return false;
    }

    public function assignStream($stream)
    {
        return $this->streams()->attach($stream);
    }

    public function removeStream($stream)
    {
        return $this->streams()->detach($stream);
    }

    /*  Subject User Relationship
    |--------------------------------------------------------------------------| */

    public function subjects()
    {
        return $this->belongsToMany('chillimarks\Models\Subject')->withTimestamps();
    }


    public function hasSubject($name)
    {
        foreach($this->subjects as $subject)
        {
            if($subject->name == $name) return true;
        }
        return false;
    }

    public function assignSubject($subject)
    {
        return $this->subjects()->attach($subject);
    }

    public function removeSubject($subject)
    {
        return $this->subjects()->detach($subject);
    }


    /*  Assessment User Relationship
    |--------------------------------------------------------------------------| */

    public function grades()
    {
        return $this->hasMany('chillimarks\Models\Grade', 'student_id');
    }

}
