@extends('layouts.app')

@section('content')
    <div class="bg-white shadow-md rounded my-6 p-6">
        <h1 class="text-2xl font-semibold mb-4">{{ $thread->title }}</h1>

        @foreach ($posts as $post)
            <div class="mb-4">
                <p class="text-gray-700">
                    <strong>{{ $post->user ? $post->user->name : 'Deleted User' }}</strong>
                    <span class="text-sm text-gray-500">{{ $post->created_at ? $post->created_at->format('Y-m-d H:i:s') : '' }}</span>
                    <span class="text-sm text-red-500">[{{ $post->id }}]</span>
                    @if ($post->edited_at)
                        <span class="text-sm text-gray-500">Edited by {{ $post->editor ? $post->editor->name : 'Unknown' }} at {{ \Carbon\Carbon::parse($post->edited_at)->format('Y-m-d H:i:s') }}</span>
                    @endif
                </p>
                <p>{{ $post->content }}</p>
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="mt-2">
                @endif
                @if ($post->user_id === Auth::id() && $post->created_at && $post->created_at->diffInMinutes(now()) <= 30)
                    <a href="{{ route('posts.edit', $post) }}" class="text-blue-600 hover:underline">Edit</a>
                @endif
                @if ($post->user_id === Auth::id() && $post->created_at && $post->created_at->diffInMinutes(now()) <= 60)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                @endif
            </div>
        @endforeach

        @if(!$thread->locked)
            <form action="{{ route('posts.store', $thread) }}" method="POST" enctype="multipart/form-data" class="mt-6">
                @csrf
                <textarea name="content" placeholder="Post content" class="border rounded w-full py-2 px-3 text-gray-700 mb-3"></textarea>
                <input type="file" name="image" class="border rounded w-full py-2 px-3 text-gray-700 mb-3">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Post</button>
            </form>
        @else
            <p class="text-red-500">This thread is locked.</p>
        @endif
    </div>
@endsection
