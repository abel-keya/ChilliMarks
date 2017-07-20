<?php

namespace chilliapp\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'from_user'];

    public function fromUser()
    {
    	return $this->belongsTo('chilliapp\Models\User','from_user');
  	}
}
