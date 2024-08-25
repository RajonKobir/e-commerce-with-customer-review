<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'user_name',
        'blog_id',
        'title',
        'description',
        'rating',
        'approved'
    ];
}
