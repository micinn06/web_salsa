@extends('layouts.admin')

@section('title', 'Tambah Galeri Baru')

@section('content')
<div class="container">
    <h1>Tambah Galeri Baru</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dashboard.galleries.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Judul Galeri:</label>
            <input type="text" name="title" class="form-control" placeholder="Masukkan judul galeri" value="{{ old('title') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('dashboard.galleries.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
