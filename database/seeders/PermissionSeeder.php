<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
        	['name' => 'mengelola master'],
        	['name' => 'mengelola produk'],
        	['name' => 'mengelola unit produk'],
        	['name' => 'mengelola grup produk'],
        	['name' => 'mengelola tipe produk'],
        	['name' => 'mengelola gudang'],
        	['name' => 'mengelola administrator'],
        	['name' => 'mengelola user'],
            ['name' => 'mengelola role'],
        	['name' => 'melihat log aktivitas'],
        ];

        foreach ($permissions as $value) {
            Permission::create(['name' => $value['name']]);
        }
    }
}
