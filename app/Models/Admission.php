<?php

namespace chilliapp\Models;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    protected $fillable = ['user_id', 'adm_no', 'from_user'];

    public function user()
    {
    	return $this->belongsTo('chilliapp\Models\User','user_id');
  	}

  	public function fromUser()
    {
    	return $this->belongsTo('chilliapp\Models\User','from_user');
  	}


}
