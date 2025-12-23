<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sneaker;
use App\Models\Brand; // <--- Import Model Brand
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SneakerController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data sepatu BESERTA data brand-nya (Eager Loading)
        $query = Sneaker::with('brand');

        // 2. Logika Pencarian (Search)
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  // Cari juga kalau user ngetik nama brand (misal: "Nike")
                  ->orWhereHas('brand', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // 3. Sorting
        $orderBy = $request->input('orderBy', 'created_at');
        $sortBy = $request->input('sortBy', 'desc');
        $query->orderBy($orderBy, $sortBy);

        // 4. Pagination
        $limit = $request->input('limit', 10);
        $sneakers = $query->paginate($limit);

        return response()->json([
            'status' => 'success',
            'message' => 'List Data Sneakers',
            'data' => $sneakers
        ]);
    }

    // --- API BARU: AMBIL LIST BRAND (Untuk Dropdown Frontend) ---
    public function getBrands()
    {
        $brands = Brand::orderBy('name', 'asc')->get();
        return response()->json($brands);
    }

    public function store(Request $request)
    {
        // Validasi sekarang cek brand_id, bukan text brand
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string',
            'brand_id'    => 'required|exists:brands,id', // Wajib ada di tabel brands
            'size'        => 'required|integer',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image');
        // Simpan ke storage public secara eksplisit
        $path = $image->store('sneakers', 'public');

        $sneaker = Sneaker::create([
            'name'        => $request->name,
            'brand_id'    => $request->brand_id, // Simpan ID Brand
            'size'        => $request->size,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'description' => $request->description,
            'image'       => $path,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Sneaker berhasil ditambahkan',
            'data' => $sneaker
        ], 201);
    }

    public function show($id)
    {
        // Load juga data brand-nya
        $sneaker = Sneaker::with('brand')->find($id);
        if (!$sneaker) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        return response()->json(['status' => 'success', 'data' => $sneaker]);
    }

    public function update(Request $request, $id)
    {
        $sneaker = Sneaker::find($id);
        if (!$sneaker) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $validator = Validator::make($request->all(), [
            'name'        => 'sometimes|required',
            'brand_id'    => 'sometimes|required|exists:brands,id', // Validasi ID
            'size'        => 'sometimes|required',
            'price'       => 'sometimes|required|numeric',
            'stock'       => 'sometimes|required|numeric',
            'description' => 'nullable',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->has('name')) $sneaker->name = $request->name;
        if ($request->has('brand_id')) $sneaker->brand_id = $request->brand_id; // Update ID
        if ($request->has('size')) $sneaker->size = $request->size;
        if ($request->has('price')) $sneaker->price = $request->price;
        if ($request->has('stock')) $sneaker->stock = $request->stock;
        if ($request->has('description')) $sneaker->description = $request->description;

        if ($request->hasFile('image')) {
            if ($sneaker->image && Storage::disk('public')->exists($sneaker->image)) {
                Storage::disk('public')->delete($sneaker->image);
            }
            $path = $request->file('image')->store('sneakers', 'public');
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
