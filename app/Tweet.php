<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tweet extends Model
{
    use Sluggable,HasTags;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'image'
    ];
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    /**
     * Get all of the owning commentable models.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
