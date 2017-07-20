<?php

namespace chilliapp\Models;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    protected $fillable = ['user_id', 'adm_no', 'from_user'];

    public function adm_no()
    {
    	return $this->belongsTo('chilliapp\Models\User','adm_no');
  	}

  	public function fromUser()
    {
    	return $this->belongsTo('chilliapp\Models\User','from_user');
  	}


}
