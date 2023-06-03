<?php

namespace App\Http\Controllers;

use App\Filters\BoardFilter;
use App\Http\Requests\BoardRequest;
use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function index(BoardFilter $filter)
    {
        $boards = Board::filter($filter)->paginate();
        $headers = ['Boards'];
        return view('boards.index', compact('boards', 'headers'));
    }

    public function create()
    {
        $board = new Board();
        $headers = ['Boards', 'Create'];
        return view('boards.create', compact('board','headers'));
    }

    public function store(BoardRequest $request)
    {
        Board::create($request->validated());

        return redirect()->route('boards.index');
    }

    public function edit(Board $board)
    {
        $headers = ["Boards", 'Edit'];
        return view('boards.edit', compact('board', 'headers'));
    }

    public function update(BoardRequest $request, Board $board)
    {
        $board->update($request->validated());

        return redirect()->route('boards.index');
    }

    public function destroy(Board $board)
    {
        $board->delete();

        return back();
    }
}
