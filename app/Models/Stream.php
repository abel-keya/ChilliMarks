<?php

namespace chillimarks\Models;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    protected $fillable = [
        'name', 'class_id', 'abbr', 'from_user'
    ];

    public function abbr()
    {
        return $this->belongsTo('chillimarks\Models\User','abbr');
    }
    
    public function classes()
    {
    	return $this->belongsTo('chillimarks\Models\Classes','class_id');
  	}

    public function fromUser()
    {
    	return $this->belongsTo('chillimarks\Models\User','from_user');
  	}
}
