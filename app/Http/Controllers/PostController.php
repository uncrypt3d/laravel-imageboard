<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Thread;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request, Thread $thread)
    {
        $request->validate([
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;

        $post = $thread->posts()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        $thread->checkAndLock();

        return redirect()->route('threads.show', $thread);
    }

    public function edit(Post $post)
    {
    if ($post->user_id !== Auth::id() || $post->created_at->diffInMinutes(now()) > 30) {
        return redirect()->route('threads.show', $post->thread)->withErrors('You cannot edit this post.');
    }

    return view('posts.edit', compact('post'));
    }


    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id() || $post->created_at->diffInMinutes(now()) > 30) {
            return redirect()->route('threads.show', $post->thread)->withErrors('You cannot edit this post.');
        }

        $request->validate([
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $post->content = $request->content;
        $post->edited_at = now();
        $post->edited_by = Auth::id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return redirect()->route('threads.show', $post->thread)->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id() || $post->created_at->diffInMinutes(now()) > 60) {
            return redirect()->route('threads.show', $post->thread)->withErrors('You cannot delete this post.');
        }

        $post->delete();

        return redirect()->route('threads.show', $post->thread)->with('success', 'Post deleted successfully.');
    }
}
