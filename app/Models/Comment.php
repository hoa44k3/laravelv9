<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'name',
        'author',
        'content',
        'blog_id',
        'category_id',
        'user_id',
   
        
        
    ];
    public $timestamps = true; 

    public function category()
    {
        return $this->blog ? $this->blog->category : null;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function blog()
{
    return $this->belongsTo(Blog::class);
}
}
