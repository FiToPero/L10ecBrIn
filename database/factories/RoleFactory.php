<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            Role::factory()->create(['name' => 'welcome_product']),
            Role::factory()->create(['name' => 'admin_product']),
            Role::factory()->create(['name' => 'root_product']),
            Role::factory()->create(['name' => 'admin_user']),
            Role::factory()->create(['name' => 'root_user']),
            Role::factory()->create(['name' => 'admin_role']),
            Role::factory()->create(['name' => 'super_root'])
        ];
    }
}
