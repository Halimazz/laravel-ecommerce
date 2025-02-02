<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function addToCart(Product $product, Request $request)
{
    // Validasi input
    $request->validate([
        'amount' => 'required|integer|gte:1|lte:' . $product->stock, // Gunakan $product->stock
    ]);

    try {
        // Ambil ID user yang sedang login
        $user_id = Auth::user()->id;

        // Cek apakah produk sudah ada di keranjang user
        $existingCart = Cart::where('user_id', $user_id)
                            ->where('product_id', $product->id)
                            ->first();

        if ($existingCart) {
            // Jika produk sudah ada di keranjang, update jumlahnya
            $request->validate([
                'amount' => 'required|gte:1|lte:' . ($product->stock - $existingCart->amount),
            ]);
            $existingCart->update([
                'amount' => $existingCart->amount + $request->amount,
            ]);
        } else {
            // Jika produk belum ada di keranjang, buat entri baru
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product->id,
                'amount' => $request->amount,
            ]);
        }

        // Redirect ke halaman produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    } catch (\Exception $e) {
        // Redirect kembali dengan pesan error jika terjadi masalah
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showCart()
    {
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', $user_id)->get();
        return view('carts/show_carts', compact('carts'));
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
    public function updateCart(Cart $cart, Request $request)
    {
        // Validasi input

        $request->validate([
            'amount' => 'required|gte:1|lte:' . $cart->product->stock,
        ]);

        try {
            // Validasi input
            $request->validate([
                'amount' => 'required|integer|min:1',
            ]);
    
            // Cek stok barang
            $product = $cart->product; // Asumsikan relasi `product` ada di model Cart
            if ($request->amount > $product->stock) {
                return redirect()->back()->with('error', 'Jumlah yang diminta melebihi stok barang.');
            }
    
            // Update jumlah di cart
            $cart->update(['amount' => $request->amount]);
    
            return redirect()->route('cart.show')->with('success', 'Keranjang berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroyCart(Cart $cart)
    {
        try {
            $cart->delete();
            return redirect()->route('cart.show')->with('success', 'Produk berhasil dihapus dari keranjang!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    
        //
    }
}
