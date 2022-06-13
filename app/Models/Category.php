<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Category extends Model
{
    // public function category(){
    //     return $this->hasOne('App\Models\Post');
    // }

    protected $fillable = [
        'label','color'
    ];

    public function Post() {
        return $this->hasMany('App\Models\Post');
    }

}

