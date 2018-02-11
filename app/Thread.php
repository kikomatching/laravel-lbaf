<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $primaryKey = 'thread_id';

    protected $guarded = [];

    public function path($extra = '')
    {   
        $path = route('threads.show', [
            'thread' => $this->thread_id
        ]);

        if( ! empty($extra)) $path = rtrim($path, '/') .'/'. $extra ;

    	return $path;
    }

    public function replies()
    {
    	return $this->hasMany(Reply::class, 'thread_id', $this->primaryKey);
    }

    public function creator()
    {
    	return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function addReply($reply)
    {
    	$this->replies()->create($reply);
    }

}
