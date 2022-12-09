<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Category extends Model
{

    use HasRoles;
    
    protected $table = "category";
    protected $fillable = [
        'name'
    ];

}
