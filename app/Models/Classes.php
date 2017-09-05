<?php

namespace chillimarks\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
	protected $fillable = ['name', 'year', 'from_user'];

	public function streams()
    {
        return $this->hasMany('chillimarks\Models\Stream')->whereClassId($this->class_id)->count(); 
    }

	public function fromUser()
    {
    	return $this->belongsTo('chillimarks\Models\User','from_user');
  	}
}
