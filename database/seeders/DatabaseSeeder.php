<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Permission;
use App\Models\Role;
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
        $userRole->permissions()->attach(Permission::where('name', 'view_product')->pluck('id'));

        // create User
        User::factory()->create([
            'name' => 'root',
            'email' => 'root@gmail.com',
            'role_id' => 1
        ]);
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role_id' => 2
        ]);
        User::factory()->create([
            'name' => 'usuario',
            'email' => 'usuario@gmail.com',
            'role_id' => 3
        ]);
        


    }
}
