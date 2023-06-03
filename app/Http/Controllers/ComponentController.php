<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComponentRequest;
use App\Models\Board;
use App\Models\Component;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    public function index()
    {
        $components = Component::paginate();
        $headers = ['Components'];

        return view('_components.index', compact('components', 'headers'));
    }

    public function create()
    {
        $component = new Component();

        $headers = ['Components', 'Create'];

        $boards = Board::all();

        return view('_components.create', compact('component', 'boards', 'headers'));
    }


    public function store(ComponentRequest $request)
    {
         $component = Component::create($request->only('name', 'board_id'));

         $component->ratio()->create($request->only('is', 'to'));

         return redirect()->route('components.index');
    }

    public function edit(Component $component)
    {
        $headers = ['Components', 'Edit'];
        $boards = Board::all();
        return view('_components.edit', compact('component', 'headers', 'boards'));
    }
}
