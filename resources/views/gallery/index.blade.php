@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4"><i class="fas fa-images"></i> Gallery</h1>
    <div class="row g-4">
        @foreach($galleries as $gallery)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 gallery-card" style="transition: transform 0.3s;">
                    {{-- Cek apakah galeri memiliki foto --}}
                    @if ($gallery->photos->isNotEmpty())
                        <div class="image-container">
                            <img src="{{ $gallery->photos->first()->image_url }}" 
                                 class="card-img-top gallery-img" 
                                 alt="{{ $gallery->title }}">
                        </div>
                    @else
                        <div class="image-container">
                            <img src="https://via.placeholder.com/300x200" 
                                 class="card-img-top gallery-img" 
                                 alt="No Image Available">
                        </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center text-primary">
                            <i class="fas fa-folder"></i> {{ $gallery->title }}
                        </h5>
                        <p class="card-text text-muted">{{ Str::limit($gallery->description, 100, '...') }}</p>
                        {{-- Arahkan ke route show user --}}
                        <a href="{{ route('gallery.show', ['gallery' => $gallery->id]) }}" 
                           class="btn btn-primary mt-auto">
                            <i class="fas fa-eye"></i> View Gallery
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

<style>
    /* Card Hover Effect */
    .gallery-card:hover {
        transform: scale(1.03);
    }

    /* Image Hover Zoom Effect */
    .image-container {
        overflow: hidden;
    }

    .gallery-img {
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
        width: 100%;
    }

    .gallery-img:hover {
        transform: scale(1.1);
    }

    /* Centering Card Title Icon and Text */
    .card-title i {
        margin-right: 5px;
    }

    /* Button Hover for a Smooth Transition */
    .btn-primary {
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: var(--tertiary-color);
        color: #ffffff;
    }
</style>
