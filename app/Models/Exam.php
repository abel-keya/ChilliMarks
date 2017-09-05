<?php

namespace chillimarks\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['name', 'subject_id', 'stream_id', 'period', 'year', 'status', 'from_user'];

    public function subject()
	{
	    return $this->belongsTo('chillimarks\Models\Subject');
	}

	public function stream()
	{
	    return $this->belongsTo('chillimarks\Models\Stream');
	}

	public function fromUser()
    {
    	return $this->belongsTo('chillimarks\Models\User','from_user');
  	}

}
