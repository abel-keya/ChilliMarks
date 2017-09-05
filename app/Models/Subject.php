<?php

namespace chillimarks\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name', 'abbr', 'code', 'from_user'
    ];

    public function fromUser()
    {
    	return $this->belongsTo('chillimarks\Models\User','from_user');
  	}
}
