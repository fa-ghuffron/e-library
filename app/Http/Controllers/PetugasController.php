<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {

        $user = User::all();
        $admin = User::where('role', 'admin')->get();
        $petugas = User::where('role', 'petugas')->get();
        $anggota = User::where('role', 'user')->get();
        return view('admin.petugas', compact('user', 'admin', 'petugas', 'anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'role' => 'required',
        ]);

        $petugas = User::findOrFail($id);
        $petugas->update($request->all());

        return redirect()->back();
    }

    public function destroy($id)
    {
        $petugas = User::findOrFail($id);
        $petugas->delete();

        return redirect()->back();
    }
}
