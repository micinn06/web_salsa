@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">{{ $info->title }}</h1>

    <div class="text-muted mb-4">
        <p class="lead">{{ $info->content }}</p>
    </div>

    <a href="{{ route('info.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Informasi
    </a>
</div>
@endsection
