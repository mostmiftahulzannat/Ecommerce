<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
       'role_id'=>1,
       'is_system_admin'=>1,
       'name'=>'admin',
       'phone' => '0130805270',
       'email'=>'admin@gmail.com',
       'email_verified_at'=>now(),
       'password'=>Hash::make(12345678),
       'remember_token'=>Str::random(10),
        ]);
    }
}
