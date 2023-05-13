<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $entityId;
    public $header;
    public $show = false;

    protected $listeners = [
        EventConstant::DELETE_ENTITY => 'setEntityId'
    ];

    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;
        $this->showModal();
    }

    public function showModal()
    {
        $this->show = true;
    }

    public function render()
    {
        return view('livewire.modal');
    }
}
