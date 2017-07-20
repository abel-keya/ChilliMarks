<?php

namespace chilliapp\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['name', 'subject_id', 'teacher_id', 'stream_id', 'period', 'year', 'status', 'from_user'];

    public function subject()
	{
	    return $this->belongsTo('chilliapp\Models\Subject');
	}

    public function teacher()
	{
	    return $this->belongsTo('chilliapp\Models\User', 'teacher_id');
	}

	public function stream()
	{
	    return $this->belongsTo('chilliapp\Models\Stream');
	}

	public function fromUser()
    {
    	return $this->belongsTo('chilliapp\Models\User','from_user');
  	}

}
