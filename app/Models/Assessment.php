<?php

namespace chilliapp\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable = [
        'exam_id', 'name' , 'out_of', 'contribution', 'status', 'from_user'
    ];

    public function exam()
    {
    	return $this->belongsTo('chilliapp\Models\Exam','exam_id');
  	}

  	public function fromUser()
    {
    	return $this->belongsTo('chilliapp\Models\User','from_user');
  	}
}
