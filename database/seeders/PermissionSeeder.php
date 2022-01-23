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

            ['name' => 'lihat produk'],
            ['name' => 'tambah produk'],
            ['name' => 'edit produk'],
            ['name' => 'hapus produk'],

            ['name' => 'lihat unit produk'],
            ['name' => 'tambah unit produk'],
            ['name' => 'edit unit produk'],
            ['name' => 'hapus unit produk'],

            ['name' => 'lihat grup produk'],
            ['name' => 'tambah grup produk'],
            ['name' => 'edit grup produk'],
            ['name' => 'update grup produk'],


            ['name' => 'lihat tipe produk'],
            ['name' => 'tambah tipe produk'],
            ['name' => 'edit tipe produk'],
            ['name' => 'hapus tipe produk'],

            ['name' => 'lihat gudang'],
            ['name' => 'tambah gudang'],
            ['name' => 'edit gudang'],
            ['name' => 'hapus gudang'],

            ['name' => 'mengelola administrator'],

            ['name' => 'lihat role'],
            ['name' => 'tambah role'],
            ['name' => 'edit role'],
            ['name' => 'hapus role'],

            ['name' => 'lihat user'],
            ['name' => 'tambah user'],
            ['name' => 'edit user'],
            ['name' => 'hapus user'],

            ['name' => 'melihat log aktivitas'],
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission['name']]);
        }

    }
}
