<?php

namespace Database\Seeders;

use App\Models\AppSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppsettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppSettings::create([
            'name' => 'Pengaduan Masyarakat',
            'url' => 'http://127.0.0.1:8000',
            'slogan' => 'Sistem Pengaduan Masyarakat',
            'deskripsi' => 'Sistem Pengaduan Masyarakat',
            'email' => 'pengaduan@mail.com',
            'no_whatsapp' => '081234567890',
        ]);
    }
}
