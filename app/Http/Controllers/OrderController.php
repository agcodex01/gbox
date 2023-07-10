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

        $lackOfStocks = false;

        return view('orders.index', compact('orders', 'headers', 'lackOfStocks'));
    }


    public function show(Order $order)
    {
        $headers = ['Orders', 'View'];
        $order->load('products', 'products.components', 'customer');

        $boards = $order->products->reduce(function ($prev, $product) {

            $prev->put(
                $product->board->code,
                [
                    'stocks' =>  $product->board->stocks,
                    'out' => ($prev->get($product->board->code)['out'] ?? 0) + ($product->estimate * $product->pivot->quantity)
                ]
            );

            $product->components->each(function ($component) use ($prev, $product) {
                $prev->put(
                    $component->board->code,
                    [
                        'stocks' =>  $component->board->stocks,
                        'out' => ($prev->get($component->board->code)['out'] ?? 0) +  $component->getBoardQty($product->pivot->quantity)
                    ]
                );
            });

            return $prev;
        }, collect([]));

        $lackStocks = $boards->contains(function($value) {
            return $value['out'] > $value['stocks'];
        });

        return view('orders.view', compact('headers', 'order', 'boards', 'lackStocks'));
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
            'status' => Status::PENDING
        ]);

        collect($request->items)->each(function ($item) use ($order) {
            $product = Product::find($item['id']);
            $order->products()->syncWithoutDetaching([
                $item['id'] => [
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

    public function approve(Order $order)
    {
        $order->update([
            'status' => Status::APPROVED
        ]);

        return back()->with('success', 'Order status updated successfully.');
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
