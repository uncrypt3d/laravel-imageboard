@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Users</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            @if (!$user->banned)
                                <form action="{{ route('admin.users.ban', $user) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Ban User</button>
                                </form>
                            @else
                                <span class="text-danger">Banned</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
