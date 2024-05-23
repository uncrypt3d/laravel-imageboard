<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $threads = Thread::all();
        return view('admin.index', compact('threads'));
    }

    public function bulkDeleteThreads(Request $request)
    {
        $threadIds = $request->input('threads');
        Thread::whereIn('id', $threadIds)->delete();
        return redirect()->route('admin.index')->with('success', 'Threads deleted successfully.');
    }

    public function listUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function banUser(User $user)
    {
        $user->update(['banned' => true]);
        return redirect()->route('admin.users.index')->with('success', 'User banned successfully.');
    }
}
