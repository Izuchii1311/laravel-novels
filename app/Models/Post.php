<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    # with() - mendefinisikan bahwa akan get data posts sekalian dengan user & category
    protected $with = ['user', 'category'];

    # Query Scope
    public function scopeFilterSearch($query, array $filters)
    {
        # search by title or excerpt
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('excerpt', 'like', '%' . $search . '%');
        });

        # search by title or excerpt in category
        $query->when($filters['category'] ?? false, function($query, $category) {
            # whereHas() search in relationship
            return $query->whereHas('category', function($query) use ($category) {
                # akan mencari inputan, berdasarkan jenis category slug
                $query->where('slug', $category);
            });
        });

        # search by title or excerpt in authors
        $query->when($filters['authors'] ?? false, function($query, $authors) {
            return $query->whereHas('user', function($query) use ($authors) {
                $query->where('username', $authors);
            });
        });
    }

    # 1 Post Novel dimiliki oleh 1 user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    # 1 Post Novel memiliki 1 category
    public function category()
    {
        return $this->belongsTo(Category::class);
        // return $this->belongsToMany(Category::class);
    }

    # customizing route key (detail, edit, dan delete agar berdasarkan slug post-nya)
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    use Sluggable;

    # Slug otomatis berdasarkan title
    public function sluggable(): array
    {
        return [
            'slug' => ['source' => 'title']
        ];
    }
}