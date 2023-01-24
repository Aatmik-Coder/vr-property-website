<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'name' => 'Admin',
            'is_super' => 1,
            'email' => 'jason.franklin404@gmail.com',
            'password' => \Hash::make('12345678'),
        ];
        if(!(Admin::where('email',$admin['email'])->exists())) {
            Admin::create($admin);
        }
    }
}
