<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'use_id',
        'title',
        'content',
        'is_completed',
    ];
}
