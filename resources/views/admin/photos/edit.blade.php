@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Photo</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dashboard.photos.update', $photo->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="gallery_id" value="{{ $photo->gallery_id }}"> <!-- Ensure this is included -->
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $photo->title }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control">{{ $photo->description }}</textarea>
    </div>
    <div class="mb-3">
        <label for="image_url" class="form-label">Image URL</label>
        <input type="url" name="image_url" id="image_url" class="form-control" value="{{ $photo->image_url }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Photo</button>
</form>

</div>
@endsection
