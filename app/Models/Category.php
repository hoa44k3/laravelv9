<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // The attributes that are mass assignable.
    protected $fillable = ['name', 'image_path','comment'];
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function blogs()
{
    return $this->hasMany(Blog::class);
}

}
