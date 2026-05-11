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
                'foto_lapangan' => 'images/lapanganFutsalA',
                'harga_per_jam' => 100000,
                'status' => 'active',
                'fasilitas' => 'AC, Toilet, Parkir, Kantin',
            ],
            [
                'jenis_olahraga_id' => $futsal->id,
                'nama' => 'Lapangan Futsal B',
                'foto_lapangan' => 'images/lapanganFutsalB',
                'harga_per_jam' => 120000,
                'status' => 'active',
                'fasilitas' => 'AC, Toilet, Parkir, Loker',
            ],
            [
                'jenis_olahraga_id' => $futsal->id,
                'nama' => 'Lapangan Futsal C',
                'foto_lapangan' => 'images/lapanganFutsalC',
                'harga_per_jam' => 90000,
                'status' => 'active',
                'fasilitas' => 'Toilet, Parkir',
            ],
            [
                'jenis_olahraga_id' => $futsal->id,
                'nama' => 'Lapangan Futsal D',
                'foto_lapangan' => 'images/lapanganFutsalD',
                'harga_per_jam' => 110000,
                'status' => 'active',
                'fasilitas' => 'AC, Toilet, Parkir, Tribun',
            ],
            [
                'jenis_olahraga_id' => $futsal->id,
                'nama' => 'Lapangan Futsal E',
                'foto_lapangan' => 'images/lapanganFutsalE',
                'harga_per_jam' => 95000,
                'status' => 'inactive',
                'fasilitas' => 'Toilet, Parkir',
            ],
            // Badminton
            [
                'jenis_olahraga_id' => $badminton->id,
                'nama' => 'Lapangan Badminton A',
                'foto_lapangan' => 'images/lapanganBadmintonA',
                'harga_per_jam' => 75000,
                'status' => 'active',
                'fasilitas' => 'AC, Toilet, Parkir',
            ],
            [
                'jenis_olahraga_id' => $badminton->id,
                'nama' => 'Lapangan Badminton B',
                'foto_lapangan' => 'images/lapanganBadmintonB',
                'harga_per_jam' => 80000,
                'status' => 'active',
                'fasilitas' => 'AC, Toilet, Parkir, Loker',
            ],
            [
                'jenis_olahraga_id' => $badminton->id,
                'nama' => 'Lapangan Badminton C',
                'foto_lapangan' => 'images/lapanganBadmintonC',
                'harga_per_jam' => 70000,
                'status' => 'active',
                'fasilitas' => 'Toilet, Parkir',
            ],
            // Basket
            [
                'jenis_olahraga_id' => $basket->id,
                'nama' => 'Lapangan Basket A',
                'foto_lapangan' => 'images/lapanganBasketA',
                'harga_per_jam' => 150000,
                'status' => 'active',
                'fasilitas' => 'Toilet, Parkir, Tribun',
            ],
            [
                'jenis_olahraga_id' => $basket->id,
                'nama' => 'Lapangan Basket B',
                'foto_lapangan' => 'images/lapanganBasketB',
                'harga_per_jam' => 130000,
                'status' => 'active',
                'fasilitas' => 'Toilet, Parkir',
            ],
            [
                'jenis_olahraga_id' => $basket->id,
                'nama' => 'Lapangan Basket C',
                'foto_lapangan' => 'images/lapanganBasketC',
                'harga_per_jam' => 140000,
                'status' => 'active',
                'fasilitas' => 'Toilet, Parkir, Kantin',
            ],
            // Tennis
            [
                'jenis_olahraga_id' => $tennis->id,
                'nama' => 'Lapangan Tennis A',
                'foto_lapangan' => 'images/lapanganTennisA',
                'harga_per_jam' => 120000,
                'status' => 'active',
                'fasilitas' => 'Toilet, Parkir',
            ],
            [
                'jenis_olahraga_id' => $tennis->id,
                'nama' => 'Lapangan Tennis B',
                'foto_lapangan' => 'images/lapanganTennisB',
                'harga_per_jam' => 130000,
                'status' => 'active',
                'fasilitas' => 'Toilet, Parkir, Kantin',
            ],
            // Voli
            [
                'jenis_olahraga_id' => $voli->id,
                'nama' => 'Lapangan Voli A',
                'foto_lapangan' => 'images/lapanganVoliA',
                'harga_per_jam' => 80000,
                'status' => 'active',
                'fasilitas' => 'Toilet, Parkir',
            ],
            [
                'jenis_olahraga_id' => $voli->id,
                'nama' => 'Lapangan Voli B',
                'foto_lapangan' => 'images/lapanganVoliB',
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