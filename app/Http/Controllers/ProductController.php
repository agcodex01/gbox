<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilter;
use App\Http\Requests\ProductRequest;
use App\Models\Board;
use App\Models\Component;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductFilter $filter)
    {
        $headers = ['Products'];

        $products = Product::filter($filter)->latest()->paginate();

        return view('products.index', compact('products', 'headers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $product = new Product();
        $customers = Customer::with('user')->get()->pluck('user.name', 'id');
        $boards = Board::all()->pluck('code', 'id');
        $components = Component::all()->pluck('name', 'id');
        $customer = null;
        if ($request->customer_id) {
            $customer = Customer::find($request->customer_id);
        }

        $headers = ['Products', 'Create'];

        return view('products.create', compact('product', 'customers', 'customer', 'boards', 'headers', 'components'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product =  Product::create(collect($request->validated())->except('items')->all());

        $items = collect($request->all())->only('items')->first();

        collect($items)->each(function ($item) use ($product) {
            $product->components()->syncWithoutDetaching([
                $item['id'] => ['qty' => $item['qty']]
            ]);
        });

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
