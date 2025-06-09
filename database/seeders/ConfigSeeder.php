<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Config;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configs = [
            ['key' => 'nama', 'value' => 'Desa Kotabumi', 'type' => 'text', 'description' => 'Nama Desa'],
            ['key' => 'logo', 'value' => 'logo.png', 'type' => 'file', 'description' => 'Logo Desa'],
            ['key' => 'icon', 'value' => 'icon.png', 'type' => 'file', 'description' => 'Icon Desa'],
            ['key' => 'email', 'value' => 'info@desa-kotabumi.com', 'type' => 'text', 'description' => 'Email Kantor Desa'],
            ['key' => 'telepon', 'value' => '0123456789', 'type' => 'text', 'description' => 'Nomor Telepon Desa'],
            ['key' => 'facebook', 'value' => 'https://facebook.com/desacontoh', 'type' => 'text', 'description' => 'Facebook Desa'],
            ['key' => 'twitter', 'value' => 'https://twitter.com/desacontoh', 'type' => 'text', 'description' => 'Twitter Desa'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/desacontoh', 'type' => 'text', 'description' => 'Instagram Desa'],
            ['key' => 'alamat', 'value' => 'Jl. Contoh No. 123, Kecamatan Contoh, Kabupaten Contoh', 'type' => 'text', 'description' => 'Alamat Desa'],
            ['key' => 'kodepos', 'value' => '12345', 'type' => 'text', 'description' => 'Kode Pos Desa'],
        ];

        foreach ($configs as $config) {
            Config::create($config);
        }

        //--Add some random configs
        // Config::factory()->count(5)->create();
    }
}
