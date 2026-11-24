<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Task extends Model
{
    use HasApiTokens;
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'is_completed',
    ];
    
}
