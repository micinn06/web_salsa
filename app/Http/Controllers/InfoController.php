<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    public function index()
    {
        $infos = Info::all();
        return view('admin.infos.index', compact('infos'));
    }

    public function userIndex()
    {
        $infos = Info::all();
        return view('infos.index', compact('infos'));
    }

    public function show($id)
    {
        $info = Info::findOrFail($id);
        return view('infos.show', compact('info'));
    }

    public function create()
    {
        return view('admin.infos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $info = Info::create($request->all());

        // Simpan ke ActivityLog
        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => "Created new info: {$info->title}",
        ]);

        return redirect()->route('infos.index')->with('success', 'Info posted successfully');
    }

    public function edit(Info $info)
    {
        return view('admin.infos.edit', compact('info'));
    }

    public function update(Request $request, Info $info)
    {
        $info->update($request->all());

        // Simpan ke ActivityLog
        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => "Updated info: {$info->title}",
        ]);

        return redirect()->route('infos.index')->with('success', 'Info updated successfully');
    }

    public function destroy(Info $info)
    {
        $infoTitle = $info->title; // Simpan judul sebelum dihapus
        $info->delete();

        // Simpan ke ActivityLog
        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => "Deleted info: {$infoTitle}",
        ]);

        return redirect()->route('infos.index')->with('success', 'Info deleted successfully');
    }
}
