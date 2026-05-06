<?php

namespace App\Http\Controllers;

use App\Models\JenisOlahraga;
use Illuminate\Http\Request;

class JenisOlahragaController extends Controller
{
    public function index()
    {
        $data = JenisOlahraga::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        $data = JenisOlahraga::create($request->all());

        return response()->json([
            'message' => 'Jenis olahraga berhasil ditambahkan',
            'data' => $data,
        ], 201);
    }

    public function show($id)
    {
        $data = JenisOlahraga::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $data = JenisOlahraga::findOrFail($id);

        $request->validate([
            'nama' => 'sometimes|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        $data->update($request->all());

        return response()->json([
            'message' => 'Jenis olahraga berhasil diupdate',
            'data' => $data,
        ]);
    }

    public function destroy($id)
    {
        $data = JenisOlahraga::findOrFail($id);
        $data->delete();

        return response()->json([
            'message' => 'Jenis olahraga berhasil dihapus',
        ]);
    }
}