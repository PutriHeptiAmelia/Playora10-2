<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\JenisOlahraga;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    public function index(Request $request)
    {
        $jenisOlahraga = JenisOlahraga::all();
        $query = Lapangan::with('jenisOlahraga');

        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('jenis_olahraga_id', $request->jenis);
        }

        $lapangan = $query->get();
        return view('lapangan.index', compact('lapangan', 'jenisOlahraga'));
    }

    public function show($id)
    {
        $lapangan = Lapangan::with('jenisOlahraga')->findOrFail($id);
        return view('lapangan.show', compact('lapangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_olahraga_id' => 'required|exists:jenis_olahraga,id',
            'nama' => 'required|string|max:100',
            'harga_per_jam' => 'required|numeric',
            'status' => 'in:active,inactive',
            'fasilitas' => 'nullable|string',
        ]);

        $data = Lapangan::create($request->all());

        return response()->json([
            'message' => 'Lapangan berhasil ditambahkan',
            'data' => $data,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = Lapangan::findOrFail($id);

        $request->validate([
            'jenis_olahraga_id' => 'sometimes|exists:jenis_olahraga,id',
            'nama' => 'sometimes|string|max:100',
            'harga_per_jam' => 'sometimes|numeric',
            'status' => 'in:active,inactive',
            'fasilitas' => 'nullable|string',
        ]);

        $data->update($request->all());

        return response()->json([
            'message' => 'Lapangan berhasil diupdate',
            'data' => $data,
        ]);
    }

    public function destroy($id)
    {
        $data = Lapangan::findOrFail($id);
        $data->delete();

        return response()->json([
            'message' => 'Lapangan berhasil dihapus',
        ]);
    }
}