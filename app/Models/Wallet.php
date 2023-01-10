<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $table = "wallets";
    protected $fillable = ['user_id', 'task_id', 'type', 'status', 'virtual_id', 'total', 'desc'];

public function virtual_number(){
    return $this->hasOne(Virtual_number::class, 'id', 'virtual_id');
}

public function user(){
    return $this->hasOne(User::class, 'id', 'user_id');
}

}
