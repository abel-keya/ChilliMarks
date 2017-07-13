<?php

namespace chilliapp\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
	protected $fillable = ['name', 'year', 'from_user'];

	public function fromUser()
    {
    	return $this->belongsTo('chilliapp\Models\User','from_user');
  	}
}
