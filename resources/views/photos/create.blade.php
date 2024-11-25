@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Add Photo</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dashboard.photos.store') }}" method="POST">
        @csrf
        <input type="hidden" name="gallery_id" value="{{ $galleryId }}">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">Image URL</label>
            <input type="url" name="image_url" id="image_url" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Photo</button>
    </form>
</div>
@endsection
