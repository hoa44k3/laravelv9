<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $dates = ['event_date'];
    protected $fillable = ['title', 'description', 'event_date','image','user_id'];
    public function user()
{
    return $this->belongsTo(User::class);
}

}
