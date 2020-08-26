<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
    protected $fillable = [
        'content',
        'type',
        'parent',
        'rating',
        'user_id'
    ];


    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    
    // Comment model
    public function replies()
    {
        return $this->hasMany('App\Models\Comment', 'parent');
    }
}
