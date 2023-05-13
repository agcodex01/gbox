<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('products', 'customer')->withCount('products')->paginate();
        $headers = ['Orders'];

        return view('orders.index', compact('orders', 'headers'));
    }

    public function create()
    {
        $customer = new Customer();
        $headers = ['Orders', 'Add New'];
        $customers = Customer::with('user')->get()->pluck('user.name', 'id');

        return view('orders.create', compact('headers', 'customer', 'customers'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $order = Order::create();

        $order->products()->syncWithoutDetaching();

        return redirect()->route('orders.index');
    }
}
