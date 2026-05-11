<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        return view('profil.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'no_hp' => 'nullable|string|max:14',
        ]);

        Auth::user()->update([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
        ]);

        return back()->with('success', 'Profil berhasil diupdate!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->password_lama, Auth::user()->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}