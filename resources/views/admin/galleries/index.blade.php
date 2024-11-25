@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Manage Galleries</h1>

    <a href="{{ route('dashboard.galleries.create') }}" class="btn btn-primary mb-3">Tambah Galeri</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Owner</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($galleries as $gallery)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $gallery->title }}</td>
                <td>
                    @if ($gallery->user)
                        {{ $gallery->user->name }}
                    @else
                        <em>No Owner</em>
                    @endif
                </td>
                <td>
                    <a href="{{ route('dashboard.galleries.show', $gallery->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('dashboard.galleries.edit', $gallery->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('dashboard.galleries.destroy', $gallery->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
