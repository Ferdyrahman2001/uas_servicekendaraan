<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// TODO: Registrasi (users crud)  ✅
// TODO: Landing Page menampilkan layanan yang tersedia
// TODO: Flow Layanan dan Detail Layanan
/* 
    TODO: Tambahkan foto pada montir dan layanan (foto_kendaraan) yang di servis ✅
    TODO: layanan (CRUD)
    remove jenis_layanan_id
    add nomor_polisi string
    add foto_kendaraan string
    add jenis_kendaraan enum('motor', 'mobil')
    add status enum('pending', 'proses', 'selesai', 'batal')
    add jumlah_bayar int
*/
/* 

    TODO: Role Permission ✅
    todo: Manager (montir, layanan)
    todo: Admin (users, montir, layanan, jenis_layanan, kategori_montir)
    todo: Montir (layanan)
*/