<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetails extends Model
{
    use HasFactory;

    protected $primaryKey = "cart_detail_id";

    protected $fillable = [
        'cart_detail_id',
        'cart_id',
        'product_id',
        'quantity',
    ];

    public function id()
    {
        return $this->cart_detail_id;
    }

    public function quantity()
    {
        return $this->quantity;
    }
    
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        $this->save();
    }

    public function product()
    {
        return $this->hasOne(Product::class, "product_id", "product_id");
    }
}
