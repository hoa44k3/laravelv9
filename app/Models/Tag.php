<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name','blog_id'];
    public $timestamps = true;
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

}
