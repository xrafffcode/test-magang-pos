<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        "order_number",
        "order_date",
        "order_total",
    ];

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedTotalAttribute()
    {
        return number_format($this->order_total, 2, ",", ".");
    }

    public function getFormattedDateAttribute()
    {
        return date("d-m-Y", strtotime($this->order_date));
    }
}
