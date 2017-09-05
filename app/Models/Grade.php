<?php

namespace chillimarks\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['assessment_id', 'student_id', 'marks', 'status', 'from_user'];

    public function assessment()
    {
    	return $this->belongsTo('chillimarks\Models\Assessment');
  	}
    
  	public function student()
    {
    	return $this->belongsTo('chillimarks\Models\User','student_id');
  	}

	  public function fromUser()
    {
    	return $this->belongsTo('chillimarks\Models\User','from_user');
  	}

}
