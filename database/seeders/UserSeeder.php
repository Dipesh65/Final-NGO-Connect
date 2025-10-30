<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@ngo.com',
        ]);

        // $people = User::factory()->people()->count(5)->create();

        User::factory()->people()->create([
            'name' => 'Nepal Education Foundation',
            'email' => 'nepaleducationfoundation@gmail.com',
            'role_id' => '1',
        ]);

        User::factory()->people()->create([
            'name' => 'Healthy Nepal Initiative',
            'email' => 'healthynepal@gmail.com',
            'role_id' => '1',
        ]);

        // $owner = $people->random();

        // // User::factory()->ngo()->create([
        // //     'name' => 'Sample NGO',
        // //     'email' => 'ngo@ngo.com',
        // //     'owner_id' => $owner->id,
        // // ]);
    }
}
