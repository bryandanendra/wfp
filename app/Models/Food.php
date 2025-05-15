<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'foods';
    
    protected $fillable = [
        'name',
        'description',
        'nutritions_fact',
        'price',
        'category_id'
    ];
    
    protected $dates = ['deleted_at'];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'food_orders')
            ->withPivot('quantity', 'harga_jual')
            ->withTimestamps();
    }

    public function __toString(){
        return $this->name;
    }
}
