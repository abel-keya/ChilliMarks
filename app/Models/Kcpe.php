<?php

namespace chillimarks\Models;

use Illuminate\Database\Eloquent\Model;

class Kcpe extends Model
{
    protected $fillable = ['student_id', 'marks', 'position', 'from_user'];

  	public function student()
    {
    	return $this->belongsTo('chillimarks\Models\User','student_id');
  	}

  	public function fromUser()
    {
    	return $this->belongsTo('chillimarks\Models\User','from_user');
  	}
}
