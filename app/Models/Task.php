<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    
    protected $table = "task";
    protected $fillable = [
        'name', 'description', 'category', 'deadline', 'image', 'image1', 'price', 'limit',
        'status'
    ];
}
