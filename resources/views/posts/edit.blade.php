@extends('layouts.app')

@section('content')
    <div class="bg-white shadow-md rounded my-6 p-6">
        <h1 class="text-2xl font-semibold mb-4">Edit Post</h1>

        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <textarea name="content" class="border rounded w-full py-2 px-3 text-gray-700 mb-3">{{ $post->content }}</textarea>
            <input type="file" name="image" class="border rounded w-full py-2 px-3 text-gray-700 mb-3">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Post</button>
        </form>
    </div>
@endsection
