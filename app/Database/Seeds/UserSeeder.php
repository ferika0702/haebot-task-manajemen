<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = new UserModel();
        $users->insert([
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password_hash' => Password::hash('admin'),
            'active' => 1
        ]);

    }
}
