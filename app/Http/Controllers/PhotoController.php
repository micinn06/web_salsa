<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::all();
        return view('photos.index', compact('photos'));
    }

    public function create(Request $request)
    {
        $galleryId = $request->query('gallery_id'); // Ambil gallery_id dari query parameter
        return view('photos.create', compact('galleryId')); // Arahkan ke folder admin
    }
    

    public function show($id)
    {
        // Ambil foto berdasarkan ID beserta komentar dan user yang berkomentar
       $photo = Photo::with(['comments.user'])->findOrFail($id);

        // Tampilkan view dengan detail foto dan komentar
        return view('photos.show', compact('photo'));
    }

    public function storeComment(Request $request, $photoId)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment = $request->user()->comments()->create([
            'photo_id' => $photoId,
            'content' => $validatedData['content'],
        ]);

        return redirect()->route('photos.show', $photoId)->with('success', 'Comment added successfully!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'required|url',
            'gallery_id' => 'required|exists:galleries,id',
        ]);
    
        Photo::create($validated);
    
        return redirect()->route('dashboard.galleries.show', $validated['gallery_id'])
                         ->with('success', 'Photo added successfully.');
    }
    public function edit(Photo $photo)
    {
        // Make sure the path matches the location of your Blade file within the "views/admin/photos" directory
        return view('admin.photos.edit', compact('photo'));
    }
    
    public function update(Request $request, Photo $photo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'required|url',
        ]);
    
        $photo->update($validated);
    
        // Redirect to the gallery show page
        return redirect()->route('dashboard.galleries.show', $photo->gallery_id)
                         ->with('success', 'Photo updated successfully.');
    }
    

    public function destroy(Photo $photo)
    {
        $galleryId = $photo->gallery_id;  // Ensure this attribute is retrievable
        $photo->delete();
        return redirect()->route('dashboard.galleries.show', $galleryId)
                         ->with('success', 'Photo deleted successfully.');
    }
    
}
