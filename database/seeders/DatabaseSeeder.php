<?php

namespace Database\Seeders;

use App\Models\JenisLayanan;
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
    }
}
