<?php

namespace chillimarks\Models;

use Illuminate\Database\Eloquent\Model;

class StreamReport extends Model
{   
    protected $fillable = ['name', 'from_user'];

    public function fromUser()
    {
    	return $this->belongsTo('chillimarks\Models\User','from_user');
  	}

  	/*  Stream Report Exam Relationship
    |--------------------------------------------------------------------------| */
    public function exams()
    {
        return $this->belongsToMany('chillimarks\Models\Exam')->withTimestamps();
    }

    public function hasExam($id)
    {
        foreach($this->exams as $exam)
        {
            if($exam->id == $id) return true;
        }
        return false;
    }

    public function assignExam($exam)
    {
        return $this->exams()->attach($exam);
    }

    public function removeExam($exam)
    {
        return $this->exams()->detach($exam);
    }
}
