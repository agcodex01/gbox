<?php

namespace App\Http\Controllers;

use App\Consts\Status;
use App\Http\Requests\OrderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('products', 'customer')->withCount('products')->paginate();
        $headers = ['Orders'];

        return view('orders.index', compact('orders', 'headers'));
    }


    public function show(Order $order)
    {
        $headers = ['Orders', 'View'];
        $order = $order->load('products', 'products.components');
        return view('orders.view', compact('headers', 'order'));
    }

    public function create(Request $request)
    {
        $customer = Customer::find($request->customer_id) ?? new Customer();

        $headers = ['Orders', 'Create'];
        $customers = Customer::with('user')->get()->pluck('user.name', 'id');

        return view('orders.create', compact('headers', 'customer', 'customers'));
    }

    public function store(OrderRequest $request)
    {
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'estimated_delivery_date' => $request->estimated_delivery_date,
            'status' => 'pending'
        ]);

        collect($request->items)->each(function ($item) use ($order) {
            $product = Product::find($item['id']);
            $order->products()->syncWithoutDetaching([
                $product->id => [
                    'quantity' => $item['qty'],
                    'sub_total' => $product->price * $item['qty']
                ]
            ]);
        });

        $total = $order->products->sum(function ($product) {
            return $product->pivot->quantity * $product->price;
        });

        $order->update([
            'total' => $total
        ]);

        return redirect()->route('orders.index');
    }

    public function edit(Order $order)
    {
        $headers = ['Orders', 'Edit Order'];
        $statuses = Status::options();
        return view('orders.edit', compact('order', 'headers', 'statuses'));
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index');
    }
}
