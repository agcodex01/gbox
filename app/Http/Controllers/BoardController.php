<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function index(Request $request)
    {
        $boards = Board::paginate(min($request->size, 100));
        $header = 'Boards';
        return view('boards.index', compact('boards', 'header'));
    }
}
