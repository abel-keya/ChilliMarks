<?php

namespace chilliapp\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['exam_id', 'student_id', 'grade', 'status', 'from_user'];

    public function exam()
    {
    	return $this->belongsTo('chilliapp\Models\Exam');
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
