<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin' => 'admin',
            'seller' => 'seller',
            'user' => 'user',
        ];

        foreach ($roles as $key => $role) {
            Role::create(
                [
                    'name' => $role,
                ]
            );
        }
    }
}
