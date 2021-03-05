<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'author',
        'text',
        'post_id'
    ];
    
    // DB Relationships
    public function post() {
        return $this->belongsTo('App\Post');
    }
}