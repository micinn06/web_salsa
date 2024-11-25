@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Informasi</h1>

    <!-- Menampilkan daftar informasi dalam kartu -->
    <div class="row g-4">
        @foreach ($infos as $info)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 info-card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $info->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($info->content, 100, '...') }}</p>
                        <a href="{{ route('info.show', $info->id) }}" class="btn btn-primary">
                            <i class="fas fa-info-circle"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

<style>
    .info-card {
        transition: transform 0.3s ease;
    }
    .info-card:hover {
        transform: scale(1.02);
    }
</style>
