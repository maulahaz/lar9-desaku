<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Pastikan akun demo tersedia dan dapat digunakan untuk login.
     * Password semua akun demo: pass123
     *
     * @return void
     */
    public function run()
    {
        $accounts = [
            [
                'nik' => '',
                'nama_pengguna' => 'admindesa',
                'nama' => 'Ujang Saepuloh',
                'no_telepon' => '',
                'role' => 'Administrator',
                'role_id' => 88,
            ],
            [
                'nik' => '16363575',
                'nama_pengguna' => 'pengelola',
                'nama' => 'Obet',
                'no_telepon' => '086452',
                'role' => 'Supervisor',
                'role_id' => 2,
            ],
            [
                'nik' => '0000000000000001',
                'nama_pengguna' => 'user_1',
                'nama' => 'Pengguna Satu',
                'no_telepon' => '',
                'role' => 'Warga',
                'role_id' => 3,
            ],
            [
                'nik' => '0000000000000002',
                'nama_pengguna' => 'staff_1',
                'nama' => 'Staf Satu',
                'no_telepon' => '',
                'role' => 'Staf',
                'role_id' => 1,
            ],
        ];

        foreach ($accounts as $account) {
            $user = User::where('nama_pengguna', $account['nama_pengguna'])->first();

            $data = $account + [
                'password' => Hash::make('pass123'),
                'is_delete' => 'N',
            ];

            if ($user) {
                $user->update($data);
            } else {
                $data['foto'] = '';
                User::create($data);
            }
        }
    }
}
