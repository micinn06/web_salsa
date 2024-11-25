@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Manage Infos</h1>
    <a href="{{ route('dashboard.infos.create') }}" class="btn btn-success mb-3">Add New Info</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($infos as $info)
            <tr>
                <td>{{ $info->title }}</td>
                <td>{{ $info->content }}</td>
                <td>
                    <a href="{{ route('dashboard.infos.edit', $info) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('dashboard.infos.destroy', $info) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
