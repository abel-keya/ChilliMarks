<?php

namespace chillimarks\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable = [
        'exam_id', 'name', 'teacher_id', 'out_of', 'contribution', 'status', 'from_user'
    ];

    public function exam()
    {
    	return $this->belongsTo('chillimarks\Models\Exam','exam_id');
  	}

    public function teacher()
    {
        return $this->belongsTo('chillimarks\Models\User', 'teacher_id');
    }

  	public function fromUser()
    {
    	return $this->belongsTo('chillimarks\Models\User','from_user');
  	}
}
