<?php

namespace App\Http\Controllers;

// PASTIKAN IMPORTNYA KE MODELS, BUKAN CONTROLLERS
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 3) {
            abort(403, 'Akses Terbatas.');
        }

        // Di sini kita MEMAKAI class User, jadi warning akan hilang
        $users = User::orderBy('role', 'desc')->get(); 
        
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:1,2,3',
        ]);

        // Di sini kita juga MEMAKAI class User
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return back()->with('success', 'Akun karyawan baru berhasil diaktifkan!');
    }
}