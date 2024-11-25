<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('user', 'photo')->paginate(10);
        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        return view('comments.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'photo_id' => 'required|exists:photos,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        Comment::create($validatedData);

        return redirect()->route('comments.index')->with('success', 'Comment created successfully.');
    }

    public function edit(Comment $comment)
    {
        if (Auth::id() === $comment->user_id) {
            return view('comments.edit', compact('comment'));
        }
        return back()->with('error', 'Anda tidak diizinkan mengedit komentar ini.');
    }
    
    public function update(Request $request, Comment $comment)
    {
        if (Auth::id() === $comment->user_id) {
            $request->validate(['content' => 'required|string']);
            $comment->update(['content' => $request->content]);
    
            // Arahkan kembali ke halaman foto terkait dengan pesan sukses
            return redirect()->route('photos.show', $comment->photo_id)
                             ->with('success', 'Komentar berhasil diperbarui.');
        }
    
        return redirect()->back()->with('error', 'Anda tidak diizinkan mengedit komentar ini.');
    }
    
    
    public function destroy(Comment $comment)
    {
        // Pastikan hanya pemilik komentar yang bisa menghapus
        if (Auth::id() === $comment->user_id) {
            $comment->delete();
            return back()->with('success', 'Komentar berhasil dihapus.');
        }

        return back()->with('error', 'Anda tidak diizinkan menghapus komentar ini.');
    }
}


