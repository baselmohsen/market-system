<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =User::create([
            'first_name'=>'basel',
            'last_name'=>'mohsen',
            'email'=>'basel_mohsen@app.com',
            'password'=>bcrypt('123456'),
        ]);

        $user->attachRole('super_admin');
    }
}
