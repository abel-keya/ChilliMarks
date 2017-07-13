<?php

namespace chilliapp\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{	
	protected $table = 'school';

    protected $fillable = [
        'name', 'address', 'phone', 'from_user'
    ];

    public function fromUser()
    {
    	return $this->belongsTo('chilliapp\Models\User','from_user');
  	}
}
