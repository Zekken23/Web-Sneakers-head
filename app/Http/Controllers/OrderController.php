<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        // Validasi: Pastikan ada item yang dibeli
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:sneakers,id',
            'items.*.quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric'
        ]);

        // Gunakan Transaction biar aman (kalau error, data tidak masuk setengah-setengah)
        try {
            DB::beginTransaction();

            // 1. Simpan Data Order Utama
            $order = Order::create([
                'user_id' => auth()->id(), // Ambil ID user dari Token JWT
                'total_price' => $request->total_price,
                'status' => 'pending'
            ]);

            // 2. Simpan Detail Item
            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'sneaker_id' => $item['id'],
                    'sneaker_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Pesanan berhasil dibuat!',
                'order_id' => $order->id
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Gagal checkout: ' . $e->getMessage()], 500);
        }
    }
}
