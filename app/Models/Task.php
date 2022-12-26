<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class Task extends Model
{
    use HasRoles;
    
    protected $table = "task";
    protected $fillable = [
        'name', 'description', 'category', 'deadline', 'image', 'image1', 'price', 'limit',
        'status','path_image', 'path_image1'
    ];
}
