<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'job_date',
        'image',
        'user_id'
    ];
    protected $dates = ['job_date'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
