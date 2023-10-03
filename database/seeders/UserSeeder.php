<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'id'         => 1,
            'name'       => 'Ahmed Nabil',
            'email'      => 'ahmednassag@gmail.com',
            'mobile'     => '01016856433',
            'password'   => bcrypt('12345678'),
        ]);
    }
}
