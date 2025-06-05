<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Carousel;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Product::factory(50)->create();

        // Crear roles
        $rootRole = Role::create(['name' => 'root']);
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        

        // Crear permisos
        $permissions = ['view_product', 'create_product', 'update_product', 'delete_product', 'restore_product', 'forceDelete_product'];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Asignar permisos al Roles
        $rootRole->permissions()->attach(Permission::whereIn('name', ['view_product', 'create_product', 'update_product', 'delete_product', 'restore_product', 'forceDelete_product'])->pluck('id'));
        $adminRole->permissions()->attach(Permission::whereIn('name', ['view_product', 'create_product', 'update_product', 'delete_product'])->pluck('id'));
        $userRole->permissions()->attach(Permission::whereIn('name', ['view_product'])->pluck('id'));


        // create User
        User::factory()->create([
            'role_id' => 1,
            'first_name' => 'root',
            'last_name' => 'root',
            'username' => 'root',
            'phone' => '1234567890',
            'address' => '123 Root St',
            'city' => 'Root City',
            'state' => 'Root State',
            'country' => 'Root Country',
            'zip_code' => '12345',
            'company' => 'Root Company',
            'email' => 'root@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'profile_photo_path' => null
        ]);
        User::factory()->create([
            'role_id' => 2,
            'first_name' => 'admin',
            'last_name' => 'admin',
            'username' => 'admin',
            'phone' => '1234567890',
            'address' => '123 admin St',
            'city' => 'admin City',
            'state' => 'admin State',
            'country' => 'admin Country',
            'zip_code' => '12345',
            'company' => 'admin Company',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'profile_photo_path' => null
        ]);
        User::factory()->create([
            'role_id' => 3,
            'first_name' => 'fito',
            'last_name' => 'fito',
            'username' => 'fito',
            'phone' => '1234567890',
            'address' => '123 fito St',
            'city' => 'fito City',
            'state' => 'fito State',
            'country' => 'fito Country',
            'zip_code' => '12345',
            'company' => 'fito Company',
            'email' => 'fito@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'profile_photo_path' => null
        ]);
        

        // Crear carousels
        Carousel::factory(10)->create();
    }
}
