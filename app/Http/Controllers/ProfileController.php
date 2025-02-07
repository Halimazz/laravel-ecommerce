<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
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
        $user = Auth::user();
        // dd($user);
        return view('profile/index_profile', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show()
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'nullable|min:6|confirmed', // Bisa dikosongkan, minimal 6 karakter, harus dikonfirmasi
    ]);

    $user = Auth::user();
    $user->name = $request->name;

    // Cek apakah password diubah atau tidak
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return Redirect::back()->with('success', 'Profil berhasil diperbarui!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
