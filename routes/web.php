<?php

use App\Models\DetailLayanan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Ambil 10 detail layanan terakhir dengan relasi
    $latestServices = DetailLayanan::with(['layanan', 'montir'])
        ->latest()
        ->take(10)
        ->get();

    return view('welcome', compact('latestServices'));
});

// TODO: Registrasi (users crud)  ✅
// TODO: Landing Page menampilkan layanan yang tersedia ✅
// TODO: Flow Layanan dan Detail Layanan ✅
/* 

    TODO: Role Permission ✅
    todo: Manager (montir, layanan)
    todo: Admin (users, montir, layanan, jenis_layanan, kategori_montir)
    todo: Montir (layanan)
*/