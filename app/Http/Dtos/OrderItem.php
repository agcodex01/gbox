<?php

namespace App\Http\Dtos;

use App\Models\Product;

class OrderItem
{
    public  $name;
    public  $qty;
    public  $price;
    public  $subTotal;

    public function __construct(Product $product)
    {
        $this->name = $product->name;
        $this->qty = $product->pivot->quantity;
        $this->price = $product->price;
        $this->subTotal = $product->pivot->sub_total;
    }
}
