<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Carousel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Product::factory(50)->create();

        // Crear roles
        $userRole = Role::create(['name' => 'user']);
        $userAdminRole = Role::create(['name' => 'admin_user']);
        $userRootRole = Role::create(['name' => 'adminRoot_user']);
        $adminRole = Role::create(['name' => 'admin_product']);
        $adminRootRole = Role::create(['name' => 'adminRoot_product']);
        $rootRole = Role::create(['name' => 'root']);
        $superRootRole = Role::create(['name' => 'super_root']);

        // Crear permisos
        $permissions = ['viewAny_product', 'view_product', 'create_product', 'update_product', 'delete_product', 'restore_product', 'forceDelete_product',
                        'viewAny_user', 'view_user', 'create_user', 'update_user', 'delete_user', 'restore_user', 'forceDelete_user',
                        'viewAny_role', 'view_role', 'create_role', 'update_role', 'delete_role', 'restore_role', 'forceDelete_role',
                        'viewAny_carousel', 'view_carousel', 'create_carousel', 'update_carousel', 'delete_carousel', 'restore_carousel', 'forceDelete_carousel',
                        'view_permission', 'superRoot_permission'
                    ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Asignar permisos al Roles
        $userRole->permissions()->attach(Permission::whereIn('name', ['viewAny_product', 'view_product'])->pluck('id'));
        $userAdminRole->permissions()->attach(Permission::whereIn('name', ['viewAny_product', 'view_product', 'create_product', 'update_product', 'delete_product'])->pluck('id'));
        $userRootRole->permissions()->attach(Permission::whereIn('name', ['viewAny_product', 'view_product', 'create_product', 'update_product', 'delete_product', 'restore_product', 'forceDelete_product'])->pluck('id'));
        $adminRole->permissions()->attach(Permission::whereIn('name', ['viewAny_product', 'view_product', 'create_product', 'update_product', 'delete_product', 'restore_product', 'forceDelete_product', 'viewAny_user', 'view_user', 'create_user', 'update_user', 'delete_user'])->pluck('id'));
        $adminRootRole->permissions()->attach(Permission::whereIn('name', ['viewAny_product', 'view_product', 'create_product', 'update_product', 'delete_product', 'restore_product', 'forceDelete_product', 'viewAny_user', 'view_user', 'create_user', 'update_user', 'delete_user', 'restore_user', 'forceDelete_user'])->pluck('id'));
        $rootRole->permissions()->attach(Permission::whereIn('name', ['viewAny_product', 'view_product', 'create_product', 'update_product', 'delete_product', 'restore_product', 'forceDelete_product', 'view_user', 'create_user', 'update_user', 'delete_user', 'restore_user', 'forceDelete_user', 'view_permission'])->pluck('id'));
        $superRootRole->permissions()->attach(Permission::all()->pluck('id'));
        

        // create User
        User::factory()->create([
            'role_id' => 7,
            'role_name' => 'super_root',
            'first_name' => 'super_root',
            'last_name' => 'super_root',
            'username' => 'super_root',
            'phone' => '1234567890',
            'address' => '123 super_root St',
            'city' => 'super_root City',
            'state' => 'super_root State',
            'country' => 'super_root Country',
            'zip_code' => '12345',
            'company' => 'super_root Company',
            'email' => 'super_root@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'profile_photo_path' => 'storage/users/images/photo_'. random_int(1,3) . '.jpg',
            'remember_token' => Str::random(10)
        ]);
        User::factory()->create([
            'role_id' => 6,
            'role_name' => 'root',
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
            'password' => Hash::make('12345678'),
            'profile_photo_path' => 'storage/users/images/photo_'. random_int(1,3) . '.jpg',
            'remember_token' => Str::random(10)
        ]);
        User::factory()->create([
            'role_id' => 2,
            'role_name' => 'admin_product',
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
            'password' => Hash::make('12345678'),
            'profile_photo_path' => 'storage/users/images/photo_'. random_int(1, 3) . '.jpg',
            'remember_token' => Str::random(10)
        ]);
        User::factory()->create([
            'role_id' => 1,
            'role_name' => 'user',
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
            'password' => Hash::make('12345678'),
            'profile_photo_path' => 'storage/users/images/photo_'. random_int(1, 3) . '.jpg',
            'remember_token' => Str::random(10)
        ]);
        User::factory(5)->create();

        // Crear carousels
        Carousel::factory(10)->create();
    }
}
