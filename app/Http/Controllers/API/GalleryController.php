<?php

namespace App\Http\Controllers\Api;

use App\Models\Gallery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    // Get all gallery items
    public function index()
    {
        $galleries = Gallery::all();
        return response()->json($galleries);
    }

    // Get a specific gallery item by ID
    public function show($id)
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json(['message' => 'Gallery item not found'], 404);
        }
        return response()->json($gallery);
    }

    // Create a new gallery item
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'required|url',
        ]);

        $gallery = Gallery::create($validatedData);
        return response()->json($gallery, 201);
    }

    // Update an existing gallery item
    public function update(Request $request, $id)
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json(['message' => 'Gallery item not found'], 404);
        }

        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'sometimes|required|url',
        ]);

        $gallery->update($validatedData);
        return response()->json($gallery);
    }

    // Delete a gallery item
    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json(['message' => 'Gallery item not found'], 404);
        }

        $gallery->delete();
        return response()->json(['message' => 'Gallery item deleted successfully']);
    }
}
