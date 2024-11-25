<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Get all comments
    public function index()
    {
        $comments = Comment::with(['photo', 'user'])->get(); // Eager load related Photo and User
        return response()->json($comments);
    }

    // Get a specific comment by ID
    public function show($id)
    {
        $comment = Comment::with(['photo', 'user'])->find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
        return response()->json($comment);
    }

    // Create a new comment
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'photo_id' => 'required|exists:photos,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::create($validatedData);
        return response()->json($comment, 201);
    }

    // Update an existing comment
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $validatedData = $request->validate([
            'content' => 'sometimes|required|string|max:1000',
        ]);

        $comment->update($validatedData);
        return response()->json($comment);
    }

    // Delete a comment
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
