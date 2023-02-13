<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    use HasFactory;
    
    protected $table = 'studies';
    protected $guarded = [];

    public function applicant(){
        return $this->belongsTo('App\Models\Applicant');
    }
}
