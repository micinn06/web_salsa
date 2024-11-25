<?php

namespace App\Http\Controllers\Api;

use App\Models\Agenda;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    // Mendapatkan semua agenda
    public function index()
    {
        $agendas = Agenda::all();
        return response()->json($agendas);
    }

    // Mendapatkan satu agenda berdasarkan ID
    public function show($id)
    {
        $agenda = Agenda::find($id);
        if (!$agenda) {
            return response()->json(['message' => 'Agenda not found'], 404);
        }
        return response()->json($agenda);
    }

    // Membuat agenda baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
        ]);

        $agenda = Agenda::create($validatedData);
        return response()->json($agenda, 201);
    }

    // Mengupdate agenda yang ada
    public function update(Request $request, $id)
    {
        $agenda = Agenda::find($id);
        if (!$agenda) {
            return response()->json(['message' => 'Agenda not found'], 404);
        }

        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'sometimes|required|date',
        ]);

        $agenda->update($validatedData);
        return response()->json($agenda);
    }

    // Menghapus agenda
    public function destroy($id)
    {
        $agenda = Agenda::find($id);
        if (!$agenda) {
            return response()->json(['message' => 'Agenda not found'], 404);
        }

        $agenda->delete();
        return response()->json(['message' => 'Agenda deleted successfully']);
}
}