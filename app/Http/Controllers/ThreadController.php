<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Board;

class ThreadController extends Controller
{
    public function show(Thread $thread)
    {
    $posts = $thread->posts()->with(['user', 'editor'])->oldest()->get(); // Eager load user and editor relationships
    return view('threads.show', compact('thread', 'posts'));
    }

    public function store(Request $request, Board $board)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $thread = $board->threads()->create([
            'user_id' => auth()->id(),
            'title' => $request->title,
        ]);

        return redirect()->route('threads.show', $thread);
    }

    public function destroy(Thread $thread)
    {
        $thread->delete();
        return redirect()->route('boards.show', $thread->board);
    }
}
