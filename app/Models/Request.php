<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = ['topic', 'user_id', 'message', 'status', 'comment'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
