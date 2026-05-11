<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JenisOlahraga;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasi = Auth::user()->notifications;
        $jenisOlahraga = JenisOlahraga::all();
        return view('notifikasi.index', compact('notifikasi', 'jenisOlahraga'));
    }

    public function read($id)
    {
        $notif = Auth::user()->notifications()->findOrFail($id);
        $notif->markAsRead();
        return back()->with('success', 'Notifikasi ditandai sudah dibaca.');
    }

    public function readAll()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }
}