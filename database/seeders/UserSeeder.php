<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'secret',
            'password' => Hash::make('secret'),
            'roles' => 'admin',
            'no_telepon' => '01239123',
            'email' => 'secret@gmail.com',
            'is_active' => '1'
        ]);
    }
}
