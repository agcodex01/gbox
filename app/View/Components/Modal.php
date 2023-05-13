<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{


    /**
     * Create a new component instance.
     *
     * @param string $header - The modal header message
     * @param string $message - The modal body message
     *
     * @return void
     */
    public function __construct(public string $header, public string $message)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
