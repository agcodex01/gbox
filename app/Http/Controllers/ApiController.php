<?php

namespace App\Http\Controllers;

use App\Filters\ApiFilter;
use App\Http\Dtos\OrderItem;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function findCustomerById(Customer $customer)
    {
        return $customer;
    }

    public function products(ApiFilter $filter)
    {
        return Product::filter($filter)->get();
    }

    public function orderItems(Order $order)
    {
        return  $order->products->map(function($product){
            return new OrderItem($product);
        });
    }
}
