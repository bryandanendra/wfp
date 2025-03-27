<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['tanggal', 'status', 'grand_total', 'member_id'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'food_orders')
            ->withPivot('quantity', 'harga_jual');
    }

    // Accessor for order_date from tanggal
    public function getOrderDateAttribute()
    {
        return $this->tanggal;
    }

    // Accessor for total from grand_total
    public function getTotalAttribute()
    {
        return $this->grand_total;
    }

    // Accessor for type
    public function getTypeAttribute()
    {
        return $this->status == 1 ? 'Dine-in' : 'Take-away';
    }

    // Accessor for status text
    public function getStatusTextAttribute()
    {
        switch($this->status) {
            case 0: return 'Baru';
            case 1: return 'Proses';
            case 2: return 'Selesai';
            case 3: return 'Batal';
            default: return 'Baru';
        }
    }
} 