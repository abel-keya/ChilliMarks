<?php

namespace chilliapp\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name', 'from_user'];
}
