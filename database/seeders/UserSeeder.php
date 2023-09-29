<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{

    public function run()
    {
        User::create([
            'number_id' => '1004521122',
            'name' => 'Camilo',
            'last_name' => 'Rendon',
            'email' => 'juangallego3405@gmail.com',
            'password' => bcrypt(12346789),
            'remember_token' => Str::random(10),
        ]);
    }
}
