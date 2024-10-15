<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['path'];
    
    // Nếu bạn muốn sử dụng đường dẫn đầy đủ thay vì đường dẫn tương đối
    public function getUrlAttribute()
    {
        return Storage::url($this->path);
    }
}
