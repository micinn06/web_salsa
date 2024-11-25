@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <!-- Judul Halaman -->
    <h1 class="text-center mb-4"><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h1>
    <p class="text-center text-muted">Welcome to your dashboard, admin! Here’s an overview of your site’s activity.</p>

    <!-- Statistik Kartu -->
    <div class="row g-4 mb-5">
        <!-- Users Card -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 text-center p-3">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="fas fa-users fa-2x"></i></h5>
                    <h6 class="card-text mt-2">Manage Users</h6>
                    <p class="card-text text-muted">Total: {{ $userCount ?? 'N/A' }}</p>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-primary mt-2">View Users</a>
                </div>
            </div>
        </div>

        <!-- Galleries Card -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 text-center p-3">
                <div class="card-body">
                    <h5 class="card-title text-success"><i class="fas fa-images fa-2x"></i></h5>
                    <h6 class="card-text mt-2">Manage Galleries</h6>
                    <p class="card-text text-muted">Total: {{ $galleryCount ?? 'N/A' }}</p>
                    <a href="{{ route('dashboard.galleries.index') }}" class="btn btn-outline-success mt-2">View Galleries</a>
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 text-center p-3">
                <div class="card-body">
                    <h5 class="card-title text-warning"><i class="fas fa-info-circle fa-2x"></i></h5>
                    <h6 class="card-text mt-2">Manage Info</h6>
                    <p class="card-text text-muted">Total: {{ $infoCount ?? 'N/A' }}</p>
                    <a href="{{ route('dashboard.infos.index') }}" class="btn btn-outline-warning mt-2">View Info</a>
                </div>
            </div>
        </div>

        <!-- Agenda Card -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 text-center p-3">
                <div class="card-body">
                    <h5 class="card-title text-danger"><i class="fas fa-calendar-alt fa-2x"></i></h5>
                    <h6 class="card-text mt-2">Manage Agendas</h6>
                    <p class="card-text text-muted">Total: {{ $agendaCount ?? 'N/A' }}</p>
                    <a href="{{ route('dashboard.agendas.index') }}" class="btn btn-outline-danger mt-2">View Agendas</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity/History Log -->
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="card-title mb-0"><i class="fas fa-history"></i> Recent Activities</h5>
        </div>
        <div class="card-body">
            @if($activities->isEmpty())
                <p class="text-muted text-center">No recent activities available.</p>
            @else
                <ul class="list-group list-group-flush">
                    @foreach($activities as $activity)
                        <li class="list-group-item">
                            <small class="text-muted">{{ $activity->created_at->format('d M Y, H:i') }}</small><br>
                            <strong>{{ $activity->description }}</strong>
                            <p class="mb-0 text-muted">{{ $activity->user->name ?? 'System' }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection

<style>
    /* Gaya Kartu */
    .card {
        border-radius: 8px;
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: scale(1.03);
    }

    /* Gaya Teks Judul */
    h1 {
        color: #0d6efd;
    }
</style>
