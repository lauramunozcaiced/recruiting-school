<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function matches(){
        return $this->hasMany('App\Models\Matche');
    }

    public function preselections(){
        return $this->hasMany('App\Models\Preselection');
    }
}
