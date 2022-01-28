<?php

namespace Database\Seeders;
use App\Models\Admin;
use App\Models\Anggota;
use Illuminate\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'username'=>'Admin',
            'email'=>'admin@book.com',
            'password'=>bcrypt('12345678')
        ]);
    }
}
