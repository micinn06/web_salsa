<?php

namespace App\Http\Controllers\Api;

use App\Models\Photo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    // Get all photo entries
    public function index()
    {
        $photos = Photo::all();
        return response()->json($photos);
    }

    // Get a single photo entry by ID
    public function show($id)
    {
        $photo = Photo::find($id);
        if (!$photo) {
            return response()->json(['message' => 'Photo not found'], 404);
        }
        return response()->json($photo);
    }

    // Create a new photo entry
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url',  // Assuming 'url' is the path to the image
        ]);

        $photo = Photo::create($validatedData);
        return response()->json($photo, 201);
    }

    // Update an existing photo entry
    public function update(Request $request, $id)
    {
        $photo = Photo::find($id);
        if (!$photo) {
            return response()->json(['message' => 'Photo not found'], 404);
        }

        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'sometimes|required|url',
        ]);

        $photo->update($validatedData);
        return response()->json($photo);
    }

    // Delete a photo entry
    public function destroy($id)
    {
        $photo = Photo::find($id);
        if (!$photo) {
            return response()->json(['message' => 'Photo not found'], 404);
        }

        $photo->delete();
        return response()->json(['message' => 'Photo deleted successfully']);
    }
}
