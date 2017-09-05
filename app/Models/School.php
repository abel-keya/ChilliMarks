<?php

namespace chillimarks\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{	
    protected $fillable = [
        'name', 'address', 'phone', 'school_type', 'from_user'
    ];

    public function fromUser()
    {
    	return $this->belongsTo('chillimarks\Models\User','from_user');
  	}
}
