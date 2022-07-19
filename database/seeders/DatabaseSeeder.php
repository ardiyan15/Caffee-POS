<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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
