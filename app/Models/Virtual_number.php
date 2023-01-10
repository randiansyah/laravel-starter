<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Virtual_number extends Model
{
    use HasFactory;
    protected $table = "virtual_numbers";
    protected $fillable = ['user_id', 'virtual', 'no_virtual', 'name_virtual'];

    public function wallet(){
        return $this->belongsTo(Wallet::class, 'virtual_id', 'id');
    }

}
