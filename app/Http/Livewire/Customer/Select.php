<?php

namespace App\Http\Livewire\Customer;

use App\Consts\LivewireEvents;
use App\Models\Customer;
use Livewire\Component;

class Select extends Component
{
    public Customer $customer;
    public $customers;

    public function mount()
    {
        $this->customers  = Customer::with('user')->get()->pluck('user.name', 'id');;
    }

    public function onSelect($value)
    {
        $this->emit(LivewireEvents::CUSTOMER_SELECT, $value);
    }

    public function render()
    {
        return view('livewire.customer.select');
    }
}
