<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// TODO: Registrasi (users crud)  ✅
// TODO: Landing Page menampilkan layanan yang tersedia
// TODO: Flow Layanan dan Detail Layanan ✅
/* 

    TODO: Role Permission ✅
    todo: Manager (montir, layanan)
    todo: Admin (users, montir, layanan, jenis_layanan, kategori_montir)
    todo: Montir (layanan)
*/