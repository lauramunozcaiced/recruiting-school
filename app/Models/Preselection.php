<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preselection extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function position(){
        return $this->belongsTo('App\Models\Position');
    }
    public function applicant(){
        return $this->belongsTo('App\Models\Applicant');
    }
}
