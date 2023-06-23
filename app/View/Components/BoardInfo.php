<?php

namespace App\View\Components;

use App\Models\Board;
use Illuminate\View\Component;

class BoardInfo extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Board $board, public string $label, public string $id)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.board-info');
    }
}
