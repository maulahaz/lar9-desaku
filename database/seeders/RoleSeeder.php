<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::create(['name' => 'webmaster','description' => 'Webmaster']);
        \App\Models\Role::create(['name' => 'admin','description' => 'Administrator']);
        \App\Models\Role::create(['name' => 'lurah','description' => 'Lurah']);
        \App\Models\Role::create(['name' => 'rw','description' => 'Ketua RW']);
        \App\Models\Role::create(['name' => 'rt','description' => 'Ketua RT']);
        \App\Models\Role::create(['name' => 'sekretaris','description' => 'Sekretaris Desa']);
        \App\Models\Role::create(['name' => 'bendahara','description' => 'Bendahara Desa']);
        \App\Models\Role::create(['name' => 'pengguna','description' => 'Pengguna Umum']);
        \App\Models\Role::create(['name' => 'operator','description' => 'Operator']);

        //--Cara lain:
        // $roles = [
        //     ['name' => 'Kepala Desa', 'description' => 'Kepala desa'],
        //     ['name' => 'Sekretaris Desa', 'description' => 'Sekretaris desa'],
        //     ['name' => 'Bendahara', 'description' => 'Bendahara desa'],
        //     ['name' => 'Pengguna', 'description' => 'Pengguna sistem'],
        //     ['name' => 'Operator', 'description' => 'Operator sistem'],
        // ];

        // foreach ($roles as $role) {
        //     Role::create($role);
        // }
    }
}
