<?php

namespace Database\Seeders;

use App\Models\JenisOlahraga;
use Illuminate\Database\Seeder;

class JenisOlahragaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama' => 'Futsal', 'deskripsi' => 'Lapangan futsal indoor'],
            ['nama' => 'Badminton', 'deskripsi' => 'Lapangan badminton indoor'],
            ['nama' => 'Basket', 'deskripsi' => 'Lapangan basket outdoor'],
            ['nama' => 'Tennis', 'deskripsi' => 'Lapangan tennis outdoor'],
            ['nama' => 'Voli', 'deskripsi' => 'Lapangan voli outdoor'],
        ];

        foreach ($data as $item) {
            JenisOlahraga::create($item);
        }
    }
}