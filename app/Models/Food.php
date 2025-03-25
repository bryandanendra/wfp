<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';


    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function __toString(){
        return $this->name;
    }
}
