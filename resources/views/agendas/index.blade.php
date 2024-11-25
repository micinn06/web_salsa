@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Agenda</h1>

    <!-- Daftar Agenda dalam Kartu -->
    <div class="row g-4">
        @foreach ($agendas as $agenda)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 agenda-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $agenda->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($agenda->description, 100, '...') }}</p>
                        <p class="card-text"><small class="text-muted">Tanggal: {{ \Carbon\Carbon::parse($agenda->event_date)->format('d M Y') }}</small></p>
                        <a href="{{ route('agenda.show', $agenda->id) }}" class="btn btn-primary">
                            <i class="fas fa-calendar-alt"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

<style>
    .agenda-card {
        transition: transform 0.3s ease;
    }
    .agenda-card:hover {
        transform: scale(1.02);
    }
</style>
