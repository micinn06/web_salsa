@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ $gallery->title }}</h1>

    <h2>Photos</h2>
    <a href="{{ route('dashboard.photos.create', ['gallery_id' => $gallery->id]) }}" class="btn btn-primary mb-3">Add Photo</a>

    @if($gallery->photos->isEmpty())
        <p>No photos available in this gallery.</p>
    @else
        <div class="row">
            @foreach($gallery->photos as $photo)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <img src="{{ $photo->image_url }}" class="card-img-top" alt="{{ $photo->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $photo->title }}</h5>
                            <p class="card-text">{{ $photo->description }}</p>
                            <a href="{{ route('dashboard.photos.edit', $photo->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('dashboard.photos.destroy', $photo->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <a href="{{ route('dashboard.galleries.index') }}" class="btn btn-secondary">Back to Galleries</a>
</div>
@endsection
