<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ComponentList extends Component
{
    public $components;
    public $boards;
    public $items = [];

    public function add()
    {
        array_push($this->items, [
            'id' => null,
            'qty' => 0
        ]);
        $this->items = array_values($this->items);
    }

    public function mounted()
    {
        array_push($this->items, [
            'id' => null,
            'qty' => 0
        ]);
        $this->items = array_values($this->items);
    }

    public function render()
    {
        return view('livewire.component-list');
    }
}
