<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TableActionDelete extends Component
{
    public $entityId;

    public function deleteEntity()
    {
        $this->emit(EventConstant::DELETE_ENTITY, $this->entityId);
    }
    public function render()
    {
        return view('livewire.table-action-delete');
    }
}
