<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('photos')->get();
        return view('admin.galleries.index', compact('galleries'));
    }

    public function userIndex()
    {
        $galleries = Gallery::all();
        return view('gallery.index', compact('galleries'));
    }

    public function show($id)
    {
        $gallery = Gallery::with('photos')->findOrFail($id);
        return view('admin.galleries.show', compact('gallery'));
    }

    public function userShow(Gallery $gallery)
    {
        return view('gallery.show', compact('gallery'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
        ]);

        $validatedData['user_id'] = Auth::id();
        $gallery = Gallery::create($validatedData);

        // Simpan ke ActivityLog
        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => "Created gallery: {$gallery->title}",
        ]);

        return redirect()->route('dashboard.galleries.index')->with('success', 'Galeri berhasil dibuat.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
        ]);

        $gallery->update($validatedData);

        // Simpan ke ActivityLog
        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => "Updated gallery: {$gallery->title}",
        ]);

        return redirect()->route('dashboard.galleries.index')->with('success', 'Gallery updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        $galleryTitle = $gallery->title; // Simpan judul sebelum dihapus
        $gallery->delete();

        // Simpan ke ActivityLog
        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => "Deleted gallery: {$galleryTitle}",
        ]);

        return redirect()->route('dashboard.galleries.index')->with('success', 'Gallery deleted successfully.');
    }
}
