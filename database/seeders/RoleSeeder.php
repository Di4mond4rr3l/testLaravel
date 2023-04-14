<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolesToCreate = ['Direttore', 'Dipendente', 'Tirocinante'];

        foreach($rolesToCreate AS $role) {
            Role::create([
                'name' => $role,
                'created_at' => fake()->dateTimeThisYear()
            ]);
        }
    }
}
