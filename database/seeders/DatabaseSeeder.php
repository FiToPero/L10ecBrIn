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
        $welcomeRole = Role::create(['name' => 'welcome_product']);
        $productAdminRole = Role::create(['name' => 'admin_product']);
        $productRootRole = Role::create(['name' => 'root_product']);
        $userAdminRole = Role::create(['name' => 'admin_user']);
        $userRootRole = Role::create(['name' => 'root_user']);
        $roleAdminRole = Role::create(['name' => 'admin_role']);
        $superRootRole = Role::create(['name' => 'super_root']);

        // Crear permisos
        $permissions = ['viewAny_product', 'view_product', 'create_product', 'update_product', 'delete_product', 'restore_product', 'forceDelete_product',
                        'viewAny_user', 'view_user', 'create_user', 'update_user', 'delete_user', 'restore_user', 'forceDelete_user',
                        'viewAny_role', 'view_role', 'create_role', 'update_role', 'delete_role', 'restore_role', 'forceDelete_role',
                        'viewAny_carousel', 'view_carousel', 'create_carousel', 'update_carousel', 'delete_carousel', 'restore_carousel', 'forceDelete_carousel',
                        'view_role', 'create_role', 'edit_role', 'delete_role',
                        'superRoot_permission'
                    ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Asignar permisos al Roles
        $welcomeRole->permissions()->attach(Permission::whereIn('name', ['viewAny_product', 'viewAny_carousel'])->pluck('id'));
        $productAdminRole->permissions()->attach(Permission::whereIn('name', ['viewAny_product', 'view_product', 'create_product', 'update_product', 'delete_product', 'viewAny_carousel'])->pluck('id'));
        $productRootRole->permissions()->attach(Permission::whereIn('name', ['viewAny_product', 'view_product', 'create_product', 'update_product', 'delete_product', 'restore_product', 'forceDelete_product', 'viewAny_carousel'])->pluck('id'));
        $userAdminRole->permissions()->attach(Permission::whereIn('name', ['viewAny_product', 'view_product', 'create_product', 'update_product', 'delete_product', 'restore_product', 'forceDelete_product', 'viewAny_user', 'view_user', 'create_user', 'update_user', 'delete_user', 'viewAny_carousel'])->pluck('id'));
        $userRootRole->permissions()->attach(Permission::whereIn('name', ['viewAny_product', 'view_product', 'create_product', 'update_product', 'delete_product', 'restore_product', 'forceDelete_product', 'viewAny_user', 'view_user', 'create_user', 'update_user', 'delete_user', 'restore_user', 'forceDelete_user', 'viewAny_carousel'])->pluck('id'));
        $roleAdminRole->permissions()->attach(Permission::whereIn('name', ['viewAny_product', 'view_product', 'create_product', 'update_product', 'delete_product', 'restore_product', 'forceDelete_product', 'viewAny_user', 'view_user', 'create_user', 'update_user', 'delete_user', 'restore_user', 'forceDelete_user', 'viewAny_carousel', 'view_role', 'create_role', 'edit_role', 'delete_role'])->pluck('id'));
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
            'role_name' => 'admin_role',
            'first_name' => 'admin_role',
            'last_name' => 'admin_role',
            'username' => 'admin_role',
            'phone' => '1234567890',
            'address' => '123 admin_role St',
            'city' => 'admin_role City',
            'state' => 'admin_role State',
            'country' => 'admin_role Country',
            'zip_code' => '12345',
            'company' => 'admin_role Company',
            'email' => 'admin_role@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'profile_photo_path' => 'storage/users/images/photo_'. random_int(1,3) . '.jpg',
            'remember_token' => Str::random(10)
        ]);
        User::factory()->create([
            'role_id' => 5,
            'role_name' => 'root_user',
            'first_name' => 'root_user',
            'last_name' => 'root_user',
            'username' => 'root_user',
            'phone' => '1234567890',
            'address' => '123 root_user St',
            'city' => 'root_user City',
            'state' => 'root_user State',
            'country' => 'root_user Country',
            'zip_code' => '12345',
            'company' => 'root_user Company',
            'email' => 'root_user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'profile_photo_path' => 'storage/users/images/photo_'. random_int(1, 3) . '.jpg',
            'remember_token' => Str::random(10)
        ]);
        User::factory()->create([
            'role_id' => 4,
            'role_name' => 'admin_user',
            'first_name' => 'admin_user',
            'last_name' => 'admin_user',
            'username' => 'admin_user',
            'phone' => '1234567890',
            'address' => '123 admin_user St',
            'city' => 'admin_user City',
            'state' => 'admin_user State',
            'country' => 'admin_user Country',
            'zip_code' => '12345',
            'company' => 'admin_user Company',
            'email' => 'admin_user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'profile_photo_path' => 'storage/users/images/photo_'. random_int(1,3) . '.jpg',
            'remember_token' => Str::random(10)
        ]);
        User::factory()->create([
            'role_id' => 3,
            'role_name' => 'root_product',
            'first_name' => 'root_product',
            'last_name' => 'root_product',
            'username' => 'root_product',
            'phone' => '1234567890',
            'address' => '123 root_product St',
            'city' => 'root_product City',
            'state' => 'root_product State',
            'country' => 'root_product Country',
            'zip_code' => '12345',
            'company' => 'root_product Company',
            'email' => 'root_product@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'profile_photo_path' => 'storage/users/images/photo_'. random_int(1,3) . '.jpg',
            'remember_token' => Str::random(10)
        ]);
        User::factory()->create([
            'role_id' => 2,
            'role_name' => 'admin_product',
            'first_name' => 'admin_product',
            'last_name' => 'admin_product',
            'username' => 'admin_product',
            'phone' => '1234567890',
            'address' => '123 admin_product St',
            'city' => 'admin_product City',
            'state' => 'admin_product State',
            'country' => 'admin_product Country',
            'zip_code' => '12345',
            'company' => 'admin_product Company',
            'email' => 'admin_product@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'profile_photo_path' => 'storage/users/images/photo_'. random_int(1, 3) . '.jpg',
            'remember_token' => Str::random(10)
        ]);
        User::factory()->create([
            'role_id' => 1,
            'role_name' => 'welcome_product',
            'first_name' => 'welcome_product',
            'last_name' => 'welcome_product',
            'username' => 'welcome_product',
            'phone' => '1234567890',
            'address' => '123 welcome_product St',
            'city' => 'welcome_product City',
            'state' => 'welcome_product State',
            'country' => 'welcome_product Country',
            'zip_code' => '12345',
            'company' => 'welcome_product Company',
            'email' => 'welcome_product@gmail.com',
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
