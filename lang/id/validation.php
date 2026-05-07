<?php

return [
    'required' => 'Kolom :attribute wajib diisi.',
    'email' => 'Kolom :attribute harus berupa alamat email yang valid.',
    'min' => [
        'string' => 'Kolom :attribute minimal :min karakter.',
        'numeric' => 'Kolom :attribute minimal :min.',
    ],
    'max' => [
        'string' => 'Kolom :attribute maksimal :max karakter.',
        'numeric' => 'Kolom :attribute maksimal :max.',
    ],
    'unique' => 'Kolom :attribute sudah digunakan.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
    'integer' => 'Kolom :attribute harus berupa angka.',
    'numeric' => 'Kolom :attribute harus berupa angka.',
    'after_or_equal' => 'Kolom :attribute harus berupa tanggal setelah atau sama dengan :date.',
    'in' => 'Kolom :attribute tidak valid.',
    'exists' => 'Kolom :attribute tidak ditemukan.',
    'image' => 'Kolom :attribute harus berupa gambar.',
    'mimes' => 'Kolom :attribute harus berupa file bertipe: :values.',
    'uploaded' => 'Kolom :attribute gagal diunggah.',

    'attributes' => [
        'name' => 'nama',
        'email' => 'email',
        'password' => 'password',
        'no_hp' => 'nomor HP',
        'tanggal' => 'tanggal',
        'jam_mulai' => 'jam mulai',
        'jam_selesai' => 'jam selesai',
        'durasi_jam' => 'durasi jam',
        'lapangan_id' => 'lapangan',
        'booking_id' => 'booking',
        'jumlah' => 'jumlah',
        'bukti_bayar' => 'bukti bayar',
        'status' => 'status',
    ],
];