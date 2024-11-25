@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Manage Agendas</h1>
    <a href="{{ route('dashboard.agendas.create') }}" class="btn btn-success mb-3">Add New Agenda</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Event Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agendas as $agenda)
            <tr>
                <td>{{ $agenda->title }}</td>
                <td>{{ $agenda->description }}</td>
                <td>{{ $agenda->event_date }}</td>
                <td>
                    <a href="{{ route('dashboard.agendas.edit', $agenda) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('dashboard.agendas.destroy', $agenda) }}" method="POST" style="display: inline-block;">
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
