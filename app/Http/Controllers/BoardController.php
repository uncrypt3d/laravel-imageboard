<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;

class BoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'show']);
    }

    public function index()
    {
        $boards = Board::all();
        return view('boards.index', compact('boards'));
    }

    public function show(Board $board)
    {
        $threads = $board->threads()->latest()->get();
        return view('boards.show', compact('board', 'threads'));
    }

    public function create()
    {
        return view('boards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:boards|max:255',
            'description' => 'required',
        ]);

        Board::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('boards.index');
    }

    public function destroy(Board $board)
    {
        $board->delete();
        return redirect()->route('boards.index');
    }
}
