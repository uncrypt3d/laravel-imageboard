@extends('layouts.app')

@section('content')
    <div class="bg-white shadow-md rounded my-6 p-6">
        @foreach ($boards as $board)
            <div class="mb-4">
                <h2 class="text-xl font-semibold"><a href="{{ route('boards.show', $board) }}" class="text-blue-600 hover:underline">{{ $board->name }}</a></h2>
                <p class="text-gray-700">{{ $board->description }}</p>
            </div>
        @endforeach
    </div>
@endsection
