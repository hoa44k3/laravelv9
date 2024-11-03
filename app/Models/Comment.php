<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'author',
        'content',
        'blog_id',
        'category_id',
        
        
    ];
    public $timestamps = true; 
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
       // return $this->belongsTo(Blog::class);
    }
public function category()
{
    return $this->blog ? $this->blog->category : null;
}
public function user()
    {
        return $this->belongsTo(User::class); // Hoặc sử dụng tên model mà bạn đang sử dụng
    }
}
