<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
    	'name', 'title', 'description', 'slug', 'content'
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
