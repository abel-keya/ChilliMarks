<?php

namespace chilliapp\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['name', 'subject', 'teacher_id', 'class_id', 'period', 'year', 'from_user'];

    public function teacher()
	{
	    return $this->hasMany('chilliapp\Models\Teacher');
	}

	public function class()
	{
	    return $this->hasMany('chilliapp\Models\Class');
	}

}
