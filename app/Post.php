<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['tags'];

    protected $dates = [
        'created_at',
        'updated_at',
        'publication_date'
    ];
    
    protected $fillable = [
        'title',
        'subtitle',
        'text',
        'author',
        'img_path',
        'publication_date',
        'slug'
    ];

    // DB relationships
    public function infoPost() {
        return $this->hasOne('App\InfoPost');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }

    public function images() {
        return $this->belongsToMany('App\Image', 'post_image');
    }
}
