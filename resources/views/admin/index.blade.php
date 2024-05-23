@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Admin Dashboard</h1>
        <form action="{{ route('admin.threads.bulk-delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="form-group">
                <label for="threads">Select Threads to Delete</label>
                <select multiple name="threads[]" id="threads" class="form-control">
                    @foreach ($threads as $thread)
                        <option value="{{ $thread->id }}">{{ $thread->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-danger">Delete Selected Threads</button>
        </form>
    </div>
@endsection
