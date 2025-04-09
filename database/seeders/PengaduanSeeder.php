<?php

namespace Database\Seeders;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $adminUsers = User::get();

        for ($i = 0; $i < 20; $i++) {
            $status = $faker->randomElement(['menunggu', 'diproses', 'selesai', 'ditolak']);
            $buktiFileName = 'bukti_' . $faker->randomNumber(5) . '_' . 'jpg';
            $pengaduan = Pengaduan::create([
                'tracking_id' => 'TRK-' . $faker->unique()->randomNumber(5),
                'nik' => $faker->numerify('################'),
                'nama' => $faker->name,
                'telp' => $faker->numerify('08###########'),
                'email' => $faker->email,
                'alamat' => $faker->address,
                'judul' => $faker->sentence(rand(4, 8)),
                'deskripsi' => $faker->paragraph(rand(3, 5)),
                'bukti_file' => $buktiFileName,
                'status' => $status,
            ]);

            if ($status !== 'menunggu' && $adminUsers->count() > 0) {
                $adminUser = $adminUsers->random();
                Tanggapan::create([
                    'pengaduans_id' => $pengaduan->id,
                    'users_id' => $adminUser->id,
                    'tanggapan' => $faker->sentence(rand(4, 8)),
                ]);
            }
        }
    }
}
