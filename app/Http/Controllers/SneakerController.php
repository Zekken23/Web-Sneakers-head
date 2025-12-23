<?php

namespace App\Http\Controllers;

use App\Models\Sneaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SneakerController extends Controller
{
    // ... (Function INDEX tetap sama) ...
    public function index(Request $request)
    {
        $query = Sneaker::query();

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        $orderBy = $request->input('orderBy', 'created_at');
        $sortBy = $request->input('sortBy', 'desc');
        $query->orderBy($orderBy, $sortBy);

        $limit = $request->input('limit', 10);
        $sneakers = $query->paginate($limit);

        return response()->json([
            'status' => 'success',
            'message' => 'List Data Sneakers',
            'data' => $sneakers
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'brand' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120' // Konsisten pakai 'image'
        ]);

        if ($request->hasFile('image')) {
            // Simpan gambar, hasilnya misal: "sneakers/asdsad23.jpg"
            $path = $request->file('image')->store('sneakers', 'public');
            $validated['image'] = $path;
        }

        $sneaker = Sneaker::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Sneaker berhasil ditambahkan',
            'data' => $sneaker
        ], 201);
    }

    public function show($id)
    {
        $sneaker = Sneaker::find($id);

        if (!$sneaker) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $sneaker]);
    }

    // [PERBAIKAN UTAMA DI SINI]
    public function update(Request $request, $id)
    {
        $sneaker = Sneaker::find($id);

        if (!$sneaker) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // 1. Validasi ganti jadi 'image' (bukan file_path) biar konsisten
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'brand' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'stock' => 'sometimes|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|file|image|max:5000'
        ]);

        // 2. Cek apakah user upload gambar baru
        if ($request->hasFile('image')) {

            // Hapus gambar lama dulu (biar storage gak penuh)
            if ($sneaker->image && Storage::disk('public')->exists($sneaker->image)) {
                Storage::disk('public')->delete($sneaker->image);
            }

            // Upload gambar baru
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('sneakers', $fileName, 'public');

            // Masukkan path baru ke array validated
            $validated['image'] = $path;
        }

        // 3. Update database
        // Otomatis kolom 'image' di database terisi string path baru
        $sneaker->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diupdate',
            'data' => $sneaker
        ]);
    }

    public function destroy($id)
    {
        $sneaker = Sneaker::find($id);

        if (!$sneaker) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Hapus file fisik
        if ($sneaker->image && Storage::disk('public')->exists($sneaker->image)) {
            Storage::disk('public')->delete($sneaker->image);
        }

        $sneaker->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
