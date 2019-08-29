<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\DeletedAdminScope;
use App\Traits\Taggable;

class BlogPost extends Model
{
    use SoftDeletes, Taggable;

    protected $fillable = ['title', 'content', 'user_id'];

    protected $hidden = ['user_id', 'deleted_at'];

    protected $perPage = 20;

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable')->latest();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeMostCommented(Builder $query)
    {
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }

    public function scopeLatestWithRelation(Builder $query)
    {
        return $query->latest()
            ->withCount('comments')
            ->with('user')
            ->with('tags');
    }

    public static function boot()
    {
        // For Admin
        static::addGlobalScope(new DeletedAdminScope);

        parent::boot();
    }
}
