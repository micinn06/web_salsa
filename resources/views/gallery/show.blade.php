@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4 text-primary">{{ $gallery->title }}</h1>
    <p class="text-center text-muted">{{ $gallery->description }}</p>
    
    <div class="row g-4">
        @foreach($gallery->photos as $photo)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 photo-card" style="transition: transform 0.3s;">
                    <div class="image-container">
                        <img src="{{ $photo->image_url }}" class="card-img-top photo-img" alt="{{ $photo->title }}">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center" style="color: var(--highlight-color);">
                            {{ $photo->title }}
                        </h5>
                        <p class="card-text text-muted">{{ Str::limit($photo->description, 80, '...') }}</p>
                        <a href="{{ route('photos.show', $photo->id) }}" 
                           class="btn btn-primary mt-auto">
                           <i class="fas fa-eye"></i> View Photo
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

<style>
    /* Theme Colors */
    :root {
        --bg-color: #eff0f3;
        --text-color: #0d0d0d;
        --text-muted: #2a2a2a;
        --btn-color: #ff8e3c;
        --btn-text-color: #0d0d0d;
        --highlight-color: #ff8e3c;
        --secondary-color: #fffffe;
        --tertiary-color: #d9376e;
    }

    /* Hover Effect for Photo Card */
    .photo-card:hover {
        transform: scale(1.02);
    }

    /* Image Hover Zoom Effect */
    .image-container {
        overflow: hidden;
        border-radius: 0.25rem;
    }

    .photo-img {
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
        width: 100%;
    }

    .photo-img:hover {
        transform: scale(1.1);
    }

    /* Styling for View Photo Button */
    .btn-primary {
        background-color: var(--btn-color);
        color: var(--btn-text-color);
        border: none;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: var(--tertiary-color);
        color: #ffffff;
    }

    /* Card Title */
    .card-title {
        font-weight: 600;
        color: var(--highlight-color);
    }

    /* Main Title */
    h1.text-primary {
        color: var(--highlight-color);
    }
</style>
