<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'adminzalfa@gmail.com',
            'password' => Hash::make('zalfa2601'),
            'role' => 'admin',
        ]);
        
        $user = User::create([
            'name' => 'Reguler User',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        Mahasiswa::create([
            'user_id' => $user->id,
            'nim' => '2201010001',
            'nama' => 'Reguler User',
            'email' => 'user@gmail.com',
            'jurusan' => 'Teknik Informatika'
        ]);
    }
}
