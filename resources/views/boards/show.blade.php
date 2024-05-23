@extends('layouts.app')

@section('content')
    <div class="bg-white shadow-md rounded my-6 p-6">
        <h1 class="text-2xl font-semibold mb-4">{{ $board->name }}</h1>
        <p class="text-gray-700 mb-6">{{ $board->description }}</p>

        @foreach ($threads as $thread)
            <div class="mb-4">
                <h3 class="text-xl font-semibold"><a href="{{ route('threads.show', $thread) }}" class="text-blue-600 hover:underline">{{ $thread->title }}</a></h3>
            </div>
        @endforeach

        <form action="{{ route('threads.store', $board) }}" method="POST" class="mt-6">
            @csrf
            <input type="text" name="title" placeholder="Thread title" class="border rounded w-full py-2 px-3 text-gray-700 mb-3">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Thread</button>
        </form>
    </div>
@endsection
