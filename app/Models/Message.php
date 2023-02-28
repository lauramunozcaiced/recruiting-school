<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = ['read'];

    public function senderUser(){
        return $this->hasOne('App\Models\User','id','sender');
    }

    public function receiverUser(){
        return $this->hasOne('App\Models\User','id','receiver');
    }
}
