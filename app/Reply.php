<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $primaryKey = 'reply_id';

    protected $guarded = [];

    public function owner()
    {
    	return $this->belongsTo(User::class, 'user_id',  'user_id');
    }

}
