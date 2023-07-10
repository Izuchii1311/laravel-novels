<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    # 1 category bisa memiliki banyak postingan
    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
