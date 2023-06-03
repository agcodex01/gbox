<?php

namespace App\Http\Livewire\Customer;

use App\Consts\LivewireEvents;
use App\Models\Customer;
use App\Models\Order;
use Livewire\Component;

class OrderForm extends Component
{
    public $customer;
    public $products = [];
    public $items = [];
    public $total = 0;

    protected $listeners = [LivewireEvents::CUSTOMER_SELECT => 'onCustomerSelect'];

    public function mount($customer)
    {
        $this->customer = Customer::find($customer)?->first();

        array_push($this->items, [
            'productId' => null,
            'price' => null,
            'subTotal' => null,
            'quantity' => null,
        ]);

        $this->products = $this->customer?->products ?? [];
    }

    public function onCustomerSelect($customer)
    {
        $this->customer = Customer::find($customer)?->first();
        $this->products = $this->customer?->products ?? [];
    }

    public function addItem()
    {
        array_push($this->items, [
            'productId' => null,
            'price' => null,
            'subTotal' => null,
            'quantity' => null,
        ]);
    }

    public function remove($index)
    {
        unset($this->items[$index]);
    }

    public function updated($key, $value)
    {
        $eKey = explode('.', $key);
        if ($eKey[2] === 'productId' && !empty($value)) {

            $price = $this->products->where('id', $value)->first()->price;
            $this->items[$eKey[1]]['productId'] = $value;
            $this->items[$eKey[1]]['price'] =  $price;
            $this->items[$eKey[1]]['quantity'] = $this->items[$eKey[1]]['quantity'] ?? 1;
            $this->items[$eKey[1]]['subTotal'] = $this->items[$eKey[1]]['quantity']  * $price;
        } else if ($eKey[2] === 'productId' && empty($value)) {
            $this->items[$eKey[1]]['price'] =  null;
            $this->items[$eKey[1]]['quantity'] = null;
            $this->items[$eKey[1]]['subTotal'] = null;
        } else if ($eKey[2] === 'quantity') {
            $this->items[$eKey[1]]['quantity'] = $value;
            if ($this->items[$eKey[1]]['productId']) {

                $this->items[$eKey[1]]['subTotal'] = $this->items[$eKey[1]]['price'] * (empty($value) ? 0 : $value);
            }
        }

        $this->total = collect($this->items)->sum('subTotal');
    }

    public function submit()
    {
        // $this->validate();

        // $order = $this->customer->orders()->create();

        // collect($this->items)->each(function ($item) use ($order) {
        //     $order->products()->syncWithoutDetaching([
        //         $item['productId'] => [
        //             'quantity' => $item['quantity'],
        //             'sub_total' => $item['subTotal']
        //         ]
        //     ]);
        // });

        // return redirect()->route('orders.index');
    }

    public function render()
    {
        return view('livewire.customer.order-form');
    }
}
