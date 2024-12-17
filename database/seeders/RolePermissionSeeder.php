<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'tambah-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'hapus-user']);
        Permission::create(['name' => 'lihat-user']);
        Permission::create(['name' => 'tambah-donasi']);
        Permission::create(['name' => 'edit-donasi']);
        Permission::create(['name' => 'hapus-donasi']);
        Permission::create(['name' => 'lihat-donasi']);
        Permission::create(['name' => 'tambah-urundana']);
        Permission::create(['name' => 'edit-urundana']);
        Permission::create(['name' => 'hapus-urundana']);
        Permission::create(['name' => 'lihat-urundana']);
        Permission::create(['name' => 'tambah-merchandise']);
        Permission::create(['name' => 'edit-merchandise']);
        Permission::create(['name' => 'hapus-merchandise']);
        Permission::create(['name' => 'lihat-merchandise']);
        
        Permission::create(['name' => 'register-akun']);
        Permission::create(['name' => 'edit-profile']);
        Permission::create(['name' => 'hapus-akun']);
        Permission::create(['name' => 'lihat-profile']);
        Permission::create(['name' => 'buat-pemberian-donasi']);
        Permission::create(['name' => 'update-pemberian-donasi']);
        Permission::create(['name' => 'hapus-pemberian-donasi']);
        Permission::create(['name' => 'lihat-pemberian-donasi']);
        Permission::create(['name' => 'buat-pemberian-urundana']);
        Permission::create(['name' => 'update-pemberian-urundana']);
        Permission::create(['name' => 'hapus-pemberian-urundana']);
        Permission::create(['name' => 'lihat-pemberian-urundana']);
        Permission::create(['name' => 'buat-pembelian-merchandise']);
        Permission::create(['name' => 'edit-pembelian-merchandise']);
        Permission::create(['name' => 'hapus-pembelian-merchandise']);
        Permission::create(['name' => 'lihat-pembelian-merchandise']);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('register-akun');
        $roleAdmin->givePermissionTo('edit-profile');
        $roleAdmin->givePermissionTo('hapus-akun');
        $roleAdmin->givePermissionTo('lihat-profile');
        $roleAdmin->givePermissionTo('tambah-user');
        $roleAdmin->givePermissionTo('edit-user');
        $roleAdmin->givePermissionTo('hapus-user');
        $roleAdmin->givePermissionTo('lihat-user');
        $roleAdmin->givePermissionTo('tambah-donasi');
        $roleAdmin->givePermissionTo('edit-donasi');
        $roleAdmin->givePermissionTo('hapus-donasi');
        $roleAdmin->givePermissionTo('lihat-donasi');
        $roleAdmin->givePermissionTo('tambah-urundana');
        $roleAdmin->givePermissionTo('edit-urundana');
        $roleAdmin->givePermissionTo('hapus-urundana');
        $roleAdmin->givePermissionTo('lihat-urundana');
        $roleAdmin->givePermissionTo('tambah-merchandise');
        $roleAdmin->givePermissionTo('edit-merchandise');
        $roleAdmin->givePermissionTo('hapus-merchandise');
        $roleAdmin->givePermissionTo('lihat-merchandise');
        $roleAdmin->givePermissionTo('buat-pemberian-donasi');
        $roleAdmin->givePermissionTo('lihat-pemberian-donasi');
        $roleAdmin->givePermissionTo('update-pemberian-donasi');
        $roleAdmin->givePermissionTo('hapus-pemberian-donasi');
        $roleAdmin->givePermissionTo('buat-pemberian-urundana');
        $roleAdmin->givePermissionTo('lihat-pemberian-urundana');
        $roleAdmin->givePermissionTo('update-pemberian-urundana');
        $roleAdmin->givePermissionTo('hapus-pemberian-urundana');
        $roleAdmin->givePermissionTo('buat-pembelian-merchandise');
        $roleAdmin->givePermissionTo('lihat-pembelian-merchandise');
        $roleAdmin->givePermissionTo('edit-pembelian-merchandise');
        $roleAdmin->givePermissionTo('hapus-pembelian-merchandise');


        $roleUser = Role::findByName('user');
        $roleUser->givePermissionTo('register-akun');
        $roleUser->givePermissionTo('edit-profile');
        $roleUser->givePermissionTo('hapus-akun');
        $roleUser->givePermissionTo('lihat-profile');
        $roleUser->givePermissionTo('buat-pemberian-donasi');
        $roleUser->givePermissionTo('lihat-pemberian-donasi');
        $roleUser->givePermissionTo('buat-pemberian-urundana');
        $roleUser->givePermissionTo('lihat-pemberian-urundana');
        $roleUser->givePermissionTo('buat-pembelian-merchandise');
        $roleUser->givePermissionTo('lihat-pembelian-merchandise');
    }
}
