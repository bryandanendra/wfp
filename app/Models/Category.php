<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = ['name', 'description'];
    
    protected $dates = ['deleted_at'];

    public function foods(){
        return $this->hasMany('App\Models\Food');
    }

    public function __toString(){
        return $this->name;
    }
}
