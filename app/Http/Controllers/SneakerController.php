<?php

namespace App\Http\Controllers; // <--- SUDAH DISESUAIKAN (Tanpa \Api)

use Illuminate\Http\Request;
use App\Models\Sneaker;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SneakerController extends Controller
{
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
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string',
            'brand'    => 'required|string',
            'price'    => 'required|numeric',
            'stock'    => 'required|integer',
            'description' => 'nullable|string',
            'image'    => 'required|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image');
        $image->storeAs('public/sneakers', $image->hashName());

        $sneaker = Sneaker::create([
            'name'        => $request->name,
            'brand'       => $request->brand,
            'size'        => $request->size,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'description' => $request->description,
            'image'       => 'sneakers/' . $image->hashName(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Sneaker berhasil ditambahkan',
            'data' => $sneaker
        ], 201);
    }

    public function show($id)
    {
        $sneaker = Sneaker::find($id);
        if (!$sneaker) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        return response()->json(['status' => 'success', 'data' => $sneaker]);
    }

    public function update(Request $request, $id)
    {
        $sneaker = Sneaker::find($id);
        if (!$sneaker) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        // Debugging: Cek apakah file benar-benar terbaca oleh server
        // Jika kamu upload gambar tapi server bilang "false", berarti file terlalu besar (kena limit PHP)
        // Uncomment baris di bawah ini jika ingin mengecek:
        // dd($request->hasFile('image'), $request->all());

        $validator = Validator::make($request->all(), [
            'name'        => 'sometimes|required',
            'brand'       => 'sometimes|required',
            'size'        => 'sometimes|required',
            'price'       => 'sometimes|required|numeric',
            'stock'       => 'sometimes|required|numeric',
            'description' => 'nullable',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Max 10MB
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update Text
        if ($request->has('name')) $sneaker->name = $request->name;
        if ($request->has('brand')) $sneaker->brand = $request->brand;
        if ($request->has('size')) $sneaker->size = $request->size;
        if ($request->has('price')) $sneaker->price = $request->price;
        if ($request->has('stock')) $sneaker->stock = $request->stock;
        if ($request->has('description')) $sneaker->description = $request->description;

        // --- BAGIAN PENTING: UPDATE GAMBAR ---
        if ($request->hasFile('image')) {

            // 1. Hapus gambar lama jika ada
            if ($sneaker->image && Storage::disk('public')->exists($sneaker->image)) {
                Storage::disk('public')->delete($sneaker->image);
            }

            // 2. Simpan gambar baru DENGAN DISK 'PUBLIC' SECARA EKSPLISIT
            // Ini akan menyimpan file ke: storage/app/public/sneakers
            $path = $request->file('image')->store('sneakers', 'public');

            // 3. Simpan path ke database
            $sneaker->image = $path;
        }

        $sneaker->save();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diupdate!',
            'data'    => $sneaker
        ], 200);
    }

    public function destroy($id)
    {
        $sneaker = Sneaker::find($id);
        if (!$sneaker) return response()->json(['message' => 'Not Found'], 404);

        if ($sneaker->image && Storage::exists('public/' . $sneaker->image)) {
            Storage::delete('public/' . $sneaker->image);
        }

        $sneaker->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
