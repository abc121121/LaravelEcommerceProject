<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $fillable = [
        'product_id',
        'user_id',
        'order_id',
        'ip_address',
        'product_quantity',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function totalItems()
    {
        $carts =  Cart::Where('ip_address', request()->ip())->get();

        $total_item = 0;
        foreach ($carts as $cart) {
            $total_item += $cart->product_quantity;
        }
        return $total_item;
    }

    public static function totalCarts()
    {
        $carts =  Cart::Where('ip_address', request()->ip())->get();

        return $carts;
    }
}
