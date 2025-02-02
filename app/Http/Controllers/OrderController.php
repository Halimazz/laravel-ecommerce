<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders/index_orders', compact('orders'));
    }

//     public function checkout(Request $request)
// {

//     $user_id = Auth::user()->id;
//     $checkoutProductIds = $request->input('product_ids'); // Ambil produk yang dipilih dari form

//     // Jika tidak ada barang yang dipilih, kembalikan dengan pesan error
//     if (!$checkoutProductIds) {
//         return redirect()->back()->with('error', 'Pilih barang yang ingin di-checkout!');
//     }

//     // Ambil hanya barang yang dipilih
//     $carts = Cart::where('user_id', $user_id)->whereIn('product_id', $checkoutProductIds)->get();

//     if ($carts->isEmpty()) {
//         return redirect()->back()->with('error', 'Keranjang kosong atau barang tidak ditemukan!');
//     }

//     // Buat order baru
//     $order = Order::create([
//         'user_id' => $user_id,
//     ]);

//     foreach ($carts as $cart) {
//         $product = Product::find($cart->product_id);

//         if ($product->stock >= $cart->amount) {
//             // Kurangi stok produk
//             $product->update([
//                 'stock' => $product->stock - $cart->amount,
//             ]);

//             // Buat transaksi baru
//             Transaction::create([
//                 'invoice_number' => 'INV'.time().$cart->id,
//                 'order_id' => $order->id,
//                 'amount' => $cart->amount,
//                 'total_price' => $cart->product->price * $cart->amount,
//                 'product_id' => $cart->product_id,
//                 'user_id' => $user_id,
//             ]);

//             // Hapus hanya barang yang di-checkout
//             $cart->delete();
//         } else {
//             return redirect()->back()->with('error', 'Stok tidak cukup untuk beberapa produk.');
//         }
//     }

//     return redirect()->back()->with('success', 'Checkout berhasil!');
// }


public function checkout(Request $request)
{
    // Debug data yang diterima dari form
    // dd($request->all());

    // Validasi data yang diterima
    $request->validate([
        'product_ids' => 'required|array',
        'product_ids.*' => 'exists:products,id', // Pastikan semua product_ids ada di tabel products
    ]);

    $user_id = Auth::user()->id;
    $checkoutProductIds = $request->input('product_ids');

    // Jika tidak ada barang yang dipilih, kembalikan dengan pesan error
    if (!$checkoutProductIds) {
        return redirect()->back()->with('error', 'Pilih barang yang ingin di-checkout!');
    }

    // Ambil hanya barang yang dipilih
    $carts = Cart::where('user_id', $user_id)->whereIn('product_id', $checkoutProductIds)->get();

    if ($carts->isEmpty()) {
        return redirect()->back()->with('error', 'Keranjang kosong atau barang tidak ditemukan!');
    }

    // Buat order baru
    $order = Order::create([
        'user_id' => $user_id,
    ]);

    foreach ($carts as $cart) {
        $product = Product::find($cart->product_id);

        if ($product->stock >= $cart->amount) {
            // Kurangi stok produk
            $product->update([
                'stock' => $product->stock - $cart->amount,
            ]);

            // Buat transaksi baru
            Transaction::create([
                'invoice_number' => 'INV'.time().$cart->id,
                'order_id' => $order->id,
                'amount' => $cart->amount,
                'total_price' => $cart->product->price * $cart->amount,
                'product_id' => $cart->product_id,
                'user_id' => $user_id,
            ]);

            // Hapus hanya barang yang di-checkout
            $cart->delete();
        } else {
            return redirect()->back()->with('error', 'Stok tidak cukup untuk produk: ' . $product->name);
        }
    }

    return redirect()->back()->with('success', 'Checkout berhasil!');
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  foreach ($carts as $cart) {
        //       $order->products()->attach($cart->product_id, [
        //         'amount' => $cart->amount,
        //         'total_price' => $cart->product->price * $cart->amount,
        //       ]);
        //       $cart->delete();
        //  }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $transactions = $order->transactions()->get();

    // Periksa apakah ada transaksi
    if ($transactions->isEmpty()) {
        return view('orders/show_orders', compact('order'))->with('error', 'Tidak ada transaksi yang ditemukan.');
    } else {
        return view('orders/show_orders', compact('order'));
    }
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
