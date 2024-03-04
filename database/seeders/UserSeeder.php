<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
            'cost' => 10, // El costo que mencionamos anteriormente
        ];
        // Default credentials
        DB::table('users')->insert([
            [
                'name' => 'Martin Valle',
                'email' => 'martin@consultor.com',
                'email_verified_at' => now(),
                'password' => password_hash('Carolina123.', PASSWORD_BCRYPT, $options), // password
                'gender' => 'male',
                'active' => 1,
                'remember_token' => Str::random(10)
            ]
        ]);

        // Fake users
        //User::factory()->times(9)->create();
    }
}
