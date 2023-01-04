<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Todo extends Model
{
    use HasRoles;

  protected $table = "todos";
  protected $fillable = [
    'user_id', 'task_id', 'image', 'image1', 'description', 'price', 'comment', 'status','name'
  ];
}
