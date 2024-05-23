@extends('layouts.app')

@section('content')
    <form action="{{ route('boards.store') }}" method="POST" class="bg-white shadow-md rounded my-6 p-6">
        @csrf
        <input type="text" name="name" placeholder="Board name" class="border rounded w-full py-2 px-3 text-gray-700 mb-3" required>
        <textarea name="description" placeholder="Board description" class="border rounded w-full py-2 px-3 text-gray-700 mb-3" required></textarea>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Board</button>
    </form>
@endsection
