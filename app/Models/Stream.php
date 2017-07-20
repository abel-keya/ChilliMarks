<?php

namespace chilliapp\Models;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    protected $fillable = [
        'name', 'class_id', 'from_user'
    ];

    public function classes()
    {
    	return $this->belongsTo('chilliapp\Models\Classes','class_id');
  	}

    public function fromUser()
    {
    	return $this->belongsTo('chilliapp\Models\User','from_user');
  	}
}
