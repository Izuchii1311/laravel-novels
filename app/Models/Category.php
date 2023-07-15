<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id'];

    # 1 category bisa memiliki banyak postingan
    public function posts()
    {
        return $this->belongsTo(Post::class);
    }

    // menghapus category & Postnya
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            $category->posts()->delete();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
