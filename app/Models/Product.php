<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_description',
        'product_price_capital',
        'product_price_sell',
    ];

    public function getFormattedPriceAttribute()
    {
        return 'Rp. ' . number_format($this->product_price_sell, 0, ',', '.');
    }

    public function getFormattedCapitalAttribute()
    {
        return 'Rp. ' . number_format($this->product_price_capital, 0, ',', '.');
    }

    public function getProfitAttribute()
    {
        return $this->product_price_sell - $this->product_price_capital;
    }

    public function getProfitPercentageAttribute()
    {
        return ($this->profit / $this->product_price_capital) * 100;
    }

    public function getFormattedProfitAttribute()
    {
        return 'Rp. ' . number_format($this->profit, 0, ',', '.');
    }

    public function getFormattedProfitPercentageAttribute()
    {
        return number_format($this->profit_percentage, 2, ',', '.') . '%';
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
