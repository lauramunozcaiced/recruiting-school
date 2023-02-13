<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;


    protected $attributes = [
        'visible' => 'inactive'
    ];

    protected $guarded = ['_token'];

    public function skills(){
        return $this->hasMany('App\Models\Skill');
    }

    public function experiences(){
        return $this->hasMany('App\Models\Experience');
    }
    public function studies(){
        return $this->hasMany('App\Models\Study');
    }
    public function evaluation(){
        return $this->hasOne('App\Models\Evaluation');
    }
    public function matches(){
        return $this->hasMany('App\Models\Matche');
    }
    public function preselections(){
        return $this->hasMany('App\Models\Preselection');
    }
    public function user(){
        return $this->hasOne('App\Models\User');
    }
    public function getRouteKeyName(){
        return 'identification';
    }
}
