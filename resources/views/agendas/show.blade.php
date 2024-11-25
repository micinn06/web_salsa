@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">{{ $agenda->title }}</h1>

    <div class="text-muted mb-4">
        <p class="lead">{{ $agenda->description }}</p>
        <p><strong>Tanggal Acara:</strong> {{ \Carbon\Carbon::parse($agenda->event_date)->format('d M Y') }}</p>
    </div>

    <a href="{{ route('agenda.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Agenda
    </a>
</div>
@endsection
