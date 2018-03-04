<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

	protected $fillable = [
		'user_id',
		'page_id',
		'comment',
	];

    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function page()
    {
        return $this->belongsTo('App\Page');
    }
}
