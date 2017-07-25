<?php

namespace chilliapp\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['assessment_id', 'student_id', 'marks', 'status', 'from_user'];

    public function assessment()
    {
    	return $this->belongsTo('chilliapp\Models\Assessment');
  	}

  	public function student()
    {
    	return $this->belongsTo('chilliapp\Models\User','student_id');
  	}

	public function fromUser()
    {
    	return $this->belongsTo('chilliapp\Models\User','from_user');
  	}
}
