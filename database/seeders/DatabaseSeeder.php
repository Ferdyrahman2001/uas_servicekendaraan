<?php

namespace Database\Seeders;

use App\Models\KategoriMontir;
use App\Models\Montir;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->delete();
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
        ]);
        User::factory()->create([
            'name' => 'montir',
            'email' => 'montir@gmail.com',
            'password' => bcrypt('montir123'),
        ]);
        User::factory()->create([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('manager123'),
        ]);

        KategoriMontir::query()->delete(); // Clear existing records before seeding
        KategoriMontir::insert([
            ['nama' => 'Umum', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Spesialis Mesin', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Spesialis Kelistrikan', 'created_at' => now(), 'updated_at' => now()],
        ]);

        Montir::query()->delete(); // Clear existing records before seeding
        Montir::insert([
            [
                'nomor' => 'M001',
                'nama' => 'Abdul Rahman',
                'gender' => 'L',
                'tgl_lahir' => '1990-01-01',
                'tmp_lahir' => 'Jakarta',
                'keahlian' => 'Servis Umum',
                'foto' => null,
                'kategori_montir_id' => KategoriMontir::where('nama', 'Umum')->first()->id,
            ],
            [
                'nomor' => 'M002',
                'nama' => 'Siti Aminah',
                'gender' => 'P',
                'tgl_lahir' => '1995-05-05',
                'tmp_lahir' => 'Bandung',
                'keahlian' => 'Servis Spesialis',
                'foto' => null,
                'kategori_montir_id' => KategoriMontir::where('nama', 'Spesialis Mesin')->first()->id,
            ]
        ]);
    }
}
