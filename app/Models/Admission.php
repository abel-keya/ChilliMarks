<?php

namespace chillimarks\Models;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    protected $fillable = ['user_id', 'adm_no', 'from_user'];

  	public function fromUser()
    {
    	return $this->belongsTo('chillimarks\Models\User','from_user');
  	}
}
