<?php

namespace Database\Seeders;

use App\Models\Lapangan;
use App\Models\JenisOlahraga;
use Illuminate\Database\Seeder;

class LapanganSeeder extends Seeder
{
    public function run(): void
    {
        $futsal = JenisOlahraga::where('nama', 'Futsal')->first();
        $badminton = JenisOlahraga::where('nama', 'Badminton')->first();
        $basket = JenisOlahraga::where('nama', 'Basket')->first();
        $tennis = JenisOlahraga::where('nama', 'Tennis')->first();
        $voli = JenisOlahraga::where('nama', 'Voli')->first();

        $lapangan = [
            // Futsal
            [
                'jenis_olahraga_id' => $futsal->id,
                'nama' => 'Lapangan Futsal A',
                'harga_per_jam' => 100000,
                'status' => 'active',
                'fasilitas' => 'AC, Toilet, Parkir, Kantin',
            ],
            [
                'jenis_olahraga_id' => $futsal->id,
                'nama' => 'Lapangan Futsal B',
                'harga_per_jam' => 120000,
                'status' => 'active',
                'fasilitas' => 'AC, Toilet, Parkir, Loker',
            ],
            [
                'jenis_olahraga_id' => $futsal->id,
                'nama' => 'Lapangan Futsal C',
                'harga_per_jam' => 90000,
                'status' => 'active',
                'fasilitas' => 'Toilet, Parkir',
            ],
            [
                'jenis_olahraga_id' => $futsal->id,
                'nama' => 'Lapangan Futsal D',
                'harga_per_jam' => 110000,
                'status' => 'active',
                'fasilitas' => 'AC, Toilet, Parkir, Tribun',
            ],
            [
                'jenis_olahraga_id' => $futsal->id,
                'nama' => 'Lapangan Futsal E',
                'harga_per_jam' => 95000,
                'status' => 'inactive',
                'fasilitas' => 'Toilet, Parkir',
            ],
            // Badminton
            [
                'jenis_olahraga_id' => $badminton->id,
                'nama' => 'Lapangan Badminton A',
                'harga_per_jam' => 75000,
                'status' => 'active',
                'fasilitas' => 'AC, Toilet, Parkir',
            ],
            [
                'jenis_olahraga_id' => $badminton->id,
                'nama' => 'Lapangan Badminton B',
                'harga_per_jam' => 80000,
                'status' => 'active',
                'fasilitas' => 'AC, Toilet, Parkir, Loker',
            ],
            [
                'jenis_olahraga_id' => $badminton->id,
                'nama' => 'Lapangan Badminton C',
                'harga_per_jam' => 70000,
                'status' => 'active',
                'fasilitas' => 'Toilet, Parkir',
            ],
            // Basket
            [
                'jenis_olahraga_id' => $basket->id,
                'nama' => 'Lapangan Basket A',
                'harga_per_jam' => 150000,
                'status' => 'active',
                'fasilitas' => 'Toilet, Parkir, Tribun',
            ],
            [
                'jenis_olahraga_id' => $basket->id,
                'nama' => 'Lapangan Basket B',
                'harga_per_jam' => 130000,
                'status' => 'active',
                'fasilitas' => 'Toilet, Parkir',
            ],
            [
                'jenis_olahraga_id' => $basket->id,
                'nama' => 'Lapangan Basket C',
                'harga_per_jam' => 140000,
                'status' => 'active',
                'fasilitas' => 'Toilet, Parkir, Kantin',
            ],
            // Tennis
            [
                'jenis_olahraga_id' => $tennis->id,
                'nama' => 'Lapangan Tennis A',
                'harga_per_jam' => 120000,
                'status' => 'active',
                'fasilitas' => 'Toilet, Parkir',
            ],
            [
                'jenis_olahraga_id' => $tennis->id,
                'nama' => 'Lapangan Tennis B',
                'harga_per_jam' => 130000,
                'status' => 'active',
                'fasilitas' => 'Toilet, Parkir, Kantin',
            ],
            // Voli
            [
                'jenis_olahraga_id' => $voli->id,
                'nama' => 'Lapangan Voli A',
                'harga_per_jam' => 80000,
                'status' => 'active',
                'fasilitas' => 'Toilet, Parkir',
            ],
            [
                'jenis_olahraga_id' => $voli->id,
                'nama' => 'Lapangan Voli B',
                'harga_per_jam' => 85000,
                'status' => 'active',
                'fasilitas' => 'Toilet, Parkir, Tribun',
            ],
        ];

        foreach ($lapangan as $item) {
            Lapangan::create($item);
        }
    }
}